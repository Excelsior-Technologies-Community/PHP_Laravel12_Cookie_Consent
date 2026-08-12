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
     */
    public function history()
    {
        $consents = CookieConsent::latest()->paginate(10);

        return view('cookie.history', compact('consents'));
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
    protected function storeConsentInDatabase(Request $request, bool $consent, array $categories, string $action): void 
    {
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