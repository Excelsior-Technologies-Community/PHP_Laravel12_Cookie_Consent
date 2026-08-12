<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CookieConsent;

class CookieController extends Controller
{
    /**
     * Show cookie consent page.
     */
    public function consent(Request $request)
    {
        $currentConsent = json_decode(
            $request->cookie('cookie_consent'),
            true
        );

        return view('cookie.consent', compact('currentConsent'));
    }

    /**
     * Show cookie policy.
     */
    public function policy()
    {
        return view('cookie.policy');
    }

    /**
     * Show cookie consent audit history.
     *
     * Features:
     * - Search
     * - Action filter
     * - Category filter
     * - Pagination
     */
    public function history(Request $request)
    {
        $query = CookieConsent::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        | Search by:
        | - Consent ID
        | - IP Address
        | - User Agent
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('consent_id', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Action Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        | MySQL JSON_CONTAINS is used because categories
        | are stored as JSON.
        */
        if ($request->filled('category')) {
            $query->whereJsonContains(
                'categories',
                $request->category
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $consents = $query
            ->oldest()
            ->paginate(5)
            ->withQueryString();

        return view('cookie.history', compact('consents'));
    }

    /**
     * Export filtered consent history as CSV.
     */
    public function exportHistory(Request $request)
    {
        $query = CookieConsent::query();

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('consent_id', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhere('user_agent', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Action Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category')) {
            $query->whereJsonContains(
                'categories',
                $request->category
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Get All Matching Records
        |--------------------------------------------------------------------------
        | Export should NOT use pagination.
        */
        $consents = $query
            ->latest()
            ->get();

        $filename = 'cookie-consent-history-' . now()->format('Y-m-d-H-i-s') . '.csv';

        return response()->streamDownload(function () use ($consents) {

            $handle = fopen('php://output', 'w');

            /*
            |--------------------------------------------------------------------------
            | CSV Header
            |--------------------------------------------------------------------------
            */
            fputcsv($handle, [
                'ID',
                'Date',
                'Time',
                'Action',
                'Consent Given',
                'Necessary',
                'Analytics',
                'Marketing',
                'IP Address',
                'User Agent',
                'Consent ID',
            ]);

            /*
            |--------------------------------------------------------------------------
            | CSV Rows
            |--------------------------------------------------------------------------
            */
            foreach ($consents as $consent) {

                $categories = $consent->categories ?? [];

                fputcsv($handle, [
                    $consent->id,

                    $consent->created_at
                        ? $consent->created_at->format('d M Y')
                        : '',

                    $consent->created_at
                        ? $consent->created_at->format('h:i A')
                        : '',

                    $consent->action_label,

                    $consent->consent_given ? 'Yes' : 'No',

                    in_array('necessary', $categories)
                        ? 'Yes'
                        : 'No',

                    in_array('analytics', $categories)
                        ? 'Yes'
                        : 'No',

                    in_array('marketing', $categories)
                        ? 'Yes'
                        : 'No',

                    $consent->ip_address ?? '',

                    $consent->user_agent ?? '',

                    $consent->consent_id,
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * Handle cookie consent form submission.
     */
    public function accept(Request $request)
    {
        $request->validate([
            'cookie_consent' => 'required|in:accept,reject',
            'categories' => 'nullable|array',
            'categories.*' => 'in:necessary,analytics,marketing',
        ]);

        $consent = $request->input('cookie_consent') === 'accept';

        $categories = $request->input('categories', []);

        // Necessary cookies are always enabled.
        if (!in_array('necessary', $categories)) {
            $categories[] = 'necessary';
        }

        // Reject All means only necessary cookies.
        if (!$consent) {
            $categories = ['necessary'];
        }

        $categories = array_values(array_unique($categories));

        $this->storeConsentInDatabase(
            $request,
            $consent,
            $categories,
            'accepted'
        );

        $cookieData = [
            'consent' => $consent,
            'categories' => $categories,
            'timestamp' => now()->timestamp,
        ];

        return redirect('/')
            ->withCookie(
                cookie(
                    'cookie_consent',
                    json_encode($cookieData),
                    60 * 24 * 365
                )
            )
            ->with(
                'success',
                'Cookie preferences saved successfully!'
            );
    }

    /**
     * Update cookie preferences.
     */
    public function update(Request $request)
    {
        $request->validate([
            'categories' => 'nullable|array',
            'categories.*' => 'in:necessary,analytics,marketing',
        ]);

        $currentConsent = json_decode(
            $request->cookie('cookie_consent'),
            true
        ) ?? [];

        $categories = $request->input('categories', []);

        // Necessary cookies are always enabled.
        if (!in_array('necessary', $categories)) {
            $categories[] = 'necessary';
        }

        $categories = array_values(array_unique($categories));

        $updatedConsent = array_merge(
            $currentConsent,
            [
                'consent' => true,
                'categories' => $categories,
                'updated_at' => now()->timestamp,
            ]
        );

        $this->storeConsentInDatabase(
            $request,
            true,
            $categories,
            'updated'
        );

        return back()
            ->withCookie(
                cookie(
                    'cookie_consent',
                    json_encode($updatedConsent),
                    60 * 24 * 365
                )
            )
            ->with(
                'success',
                'Cookie preferences updated successfully!'
            );
    }

    /**
     * Revoke cookie consent.
     */
    public function revoke(Request $request)
    {
        $this->storeConsentInDatabase(
            $request,
            false,
            ['necessary'],
            'revoked'
        );

        return redirect('/')
            ->withCookie(
                cookie()->forget('cookie_consent')
            )
            ->with(
                'success',
                'Cookie consent revoked. You will be asked again on your next visit.'
            );
    }

    /**
     * Store consent action in database.
     */
    protected function storeConsentInDatabase(
        Request $request,
        bool $consent,
        array $categories,
        string $action
    ): void {
        CookieConsent::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'consent_given' => $consent,
            'categories' => $categories,
            'consent_id' => CookieConsent::generateConsentId(),
            'action' => $action,
        ]);
    }
}
