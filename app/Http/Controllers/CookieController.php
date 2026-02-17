<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CookieConsent;

use Whitecube\LaravelCookieConsent\CookiesManager;

class CookieController extends Controller
{
    /**
     * Show cookie consent page
     */
    public function consent()
    {
        return view('cookie.consent');
    }

    /**
     * Handle cookie consent form submission
     */
    public function accept(Request $request)
    {
        $request->validate([
            'cookie_consent' => 'required|in:accept,reject',
            'categories' => 'array',
            'categories.*' => 'in:necessary,analytics,marketing'
        ]);

        // Store consent in cookie
        $consent = $request->input('cookie_consent') === 'accept';
        $categories = $request->input('categories', []);

        // Set cookie with consent preferences
        return redirect('/')
            ->withCookie(cookie('cookie_consent', json_encode([
                'consent' => $consent,
                'categories' => $categories,
                'timestamp' => now()->timestamp
            ]), 60 * 24 * 365))
            ->with('success', 'Cookie preferences saved successfully!');
    }

    /**
     * Update cookie preferences
     */
    public function update(Request $request)
    {
        $request->validate([
            'categories' => 'array',
            'categories.*' => 'in:necessary,analytics,marketing'
        ]);

        $currentConsent = json_decode($request->cookie('cookie_consent'), true) ?? [];

        $updatedConsent = array_merge($currentConsent, [
            'categories' => $request->input('categories', []),
            'updated_at' => now()->timestamp
        ]);

        return back()
            ->withCookie(cookie('cookie_consent', json_encode($updatedConsent), 60 * 24 * 365))
            ->with('success', 'Cookie preferences updated!');
    }

    /**
     * Revoke cookie consent
     */
    public function revoke()
    {
        return redirect('/')
            ->withCookie(cookie()->forget('cookie_consent'))
            ->with('success', 'Cookie consent revoked. You will be asked again on your next visit.');
    }


    // Add this method
    protected function storeConsentInDatabase(Request $request, $consent, $categories)
    {
        CookieConsent::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'consent_given' => $consent,
            'categories' => $categories,
            'consent_id' => CookieConsent::generateConsentId()
        ]);
    }
}