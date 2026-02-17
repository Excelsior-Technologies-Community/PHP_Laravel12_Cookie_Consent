<?php

namespace App\Services;

use Illuminate\Http\Request;

class CookieConsentService
{
    /**
     * Check if user has given consent for specific category
     *
     * @param Request $request
     * @param string $category
     * @return bool
     */
    public function hasConsent(Request $request, string $category): bool
    {
        $consent = $this->getConsent($request);
        
        if (!$consent) {
            return false;
        }
        
        // Necessary cookies are always allowed
        if ($category === 'necessary') {
            return true;
        }
        
        return in_array($category, $consent['categories'] ?? []);
    }
    
    /**
     * Get user's consent preferences
     *
     * @param Request $request
     * @return array|null
     */
    public function getConsent(Request $request): ?array
    {
        $cookie = $request->cookie('cookie_consent');
        
        if (!$cookie) {
            return null;
        }
        
        return json_decode($cookie, true);
    }
    
    /**
     * Check if user has given any consent
     *
     * @param Request $request
     * @return bool
     */
    public function hasAnyConsent(Request $request): bool
    {
        return !is_null($this->getConsent($request));
    }
    
    /**
     * Get all enabled categories
     *
     * @param Request $request
     * @return array
     */
    public function getEnabledCategories(Request $request): array
    {
        $consent = $this->getConsent($request);
        
        if (!$consent) {
            return [];
        }
        
        // Always include necessary
        $categories = ['necessary'];
        
        if (isset($consent['categories'])) {
            $categories = array_merge($categories, $consent['categories']);
        }
        
        return array_unique($categories);
    }
}