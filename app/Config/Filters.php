<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'adminAuth' => [
            \App\Filters\AdminAuthFilter::class,
        ],
        'providerAuth' => [
            \App\Filters\ProviderAuthFilter::class,
        ],
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'csrf' => [
                'except' => [
                    'admin/book/getAuthorDropdownData',
                ],
            ],
            'adminAuth' => [
                'except' => [
                    '',
                    'admin/forgot-password',
                    'admin/reset-password',
                    'service-providers',
                    'admin',
                    'service-providers/*',
                ],
            ],
            'providerAuth' => [
                'except' => [
                    '',
                    'admin',
                    'admin/*',
                    'service-providers',
                    'service-providers/sign-up',
                    'service-providers/activate-account',
                    'service-providers/forgot-password',
                    'service-providers/reset-password',
                ],
            ],
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        // 'adminAuth' => [
        //     'before' => [
        //         'admin/*'
        //     ],
        //     'except' => [
        //         'admin/forgot-password',
        //     ],
        // ],
    ];
}
