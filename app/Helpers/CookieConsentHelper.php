<?php

if (!function_exists('cookieConsent')) {
    /**
     * Get the cookie consent service instance
     *
     * @return \App\Services\CookieConsentService
     */
    function cookieConsent()
    {
        return app(\App\Services\CookieConsentService::class);
    }
}

if (!function_exists('hasCookieConsent')) {
    /**
     * Check if user has consent for a specific category
     *
     * @param string $category
     * @return bool
     */
    function hasCookieConsent(string $category)
    {
        return cookieConsent()->hasConsent(request(), $category);
    }
}