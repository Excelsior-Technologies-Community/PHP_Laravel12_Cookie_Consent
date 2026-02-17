<?php

return [
    /*
     * Use this setting to enable the cookie consent dialog.
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /*
     * The name of the cookie in which we store if the user
     * has agreed to accept the conditions.
     */
    'cookie_key' => 'cookie_consent',

    /*
     * Set the cookie duration in days. Default is 365 * 20.
     */
    'cookie_lifetime' => 365 * 20,

    /*
     * Define the cookie consent categories and their cookies.
     */
    'categories' => [
        'necessary' => [
            'enabled' => true,
            'required' => true,
            'cookies' => [
                [
                    'name' => 'laravel_session',
                    'description' => 'Laravel session cookie',
                    'duration' => '2 hours'
                ],
                [
                    'name' => 'XSRF-TOKEN',
                    'description' => 'CSRF protection cookie',
                    'duration' => '2 hours'
                ],
            ],
        ],
        'analytics' => [
            'enabled' => true,
            'required' => false,
            'cookies' => [
                [
                    'name' => '_ga',
                    'description' => 'Google Analytics cookie',
                    'duration' => '2 years'
                ],
                [
                    'name' => '_gid',
                    'description' => 'Google Analytics cookie',
                    'duration' => '24 hours'
                ],
            ],
        ],
        'marketing' => [
            'enabled' => true,
            'required' => false,
            'cookies' => [
                [
                    'name' => '_fbp',
                    'description' => 'Facebook Pixel cookie',
                    'duration' => '3 months'
                ],
            ],
        ],
    ],

    /*
     * The dialog's content texts.
     */
    'translations' => [
        'default' => [
            'title' => 'Cookies consent',
            'description' => 'We use cookies to improve your experience on our website.',
            'necessary' => [
                'title' => 'Necessary cookies',
                'description' => 'These cookies are required for the website to function properly.',
            ],
            'analytics' => [
                'title' => 'Analytics cookies',
                'description' => 'These cookies help us understand how visitors interact with our website.',
            ],
            'marketing' => [
                'title' => 'Marketing cookies',
                'description' => 'These cookies are used to deliver relevant advertisements.',
            ],
            'accept_all' => 'Accept all',
            'accept_selected' => 'Accept selected',
            'reject_all' => 'Reject all',
            'save' => 'Save settings',
            'details' => 'Details',
        ],
    ],
];