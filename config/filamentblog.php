<?php

/**
 * |--------------------------------------------------------------------------
 * | Set up your blog configuration
 * |--------------------------------------------------------------------------
 * |
 * | The route configuration is for setting up the route prefix and middleware.
 * | The user configuration is for setting up the user model and columns.
 * | The seo configuration is for setting up the default meta tags for the blog.
 * | The recaptcha configuration is for setting up the recaptcha for the blog.
 */

use Firefly\FilamentBlog\Models\User;

return [
    'tables' => [
        'prefix' => 'fblog_', // prefix for all blog tables
    ],
    'route' => [
        'prefix' => 'blogs',
        'middleware' => ['web'],
        //        'home' => [
        //            'name' => 'filamentblog.home',
        //            'url' => env('APP_URL'),
        //        ],
        'login' => [
            'name' => 'filamentblog.post.login',
        ],
    ],
    'user' => [
        'model' => User::class,
        'foreign_key' => 'user_id',
        'columns' => [
            'name' => 'name',
            'avatar' => 'profile_photo_path', // column name for avatar
            'author_title' => 'author_title', // column name for author title
        ],
        'select_author_callback' => function () {
            // Default callback logic to get all users
            return \App\Models\User::query();
        },
        'media_library' => [
            'avatar' => function ($user) {
                return \App\Models\User::avatar($user);
            },
        ],
    ],
    'seo' => [
        'meta' => [
            'title' => 'Filament Blog',
            'description' => 'This is filament blog seo meta description',
            'keywords' => [],
        ],
    ],

    'recaptcha' => [
        'enabled' => false, // true or false
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'secret_key' => env('RECAPTCHA_SECRET_KEY'),
    ],

    'post' => [
        'comments' => [
            'enabled' => false,
        ],
        'mobile' => [
            'footer' => [
                'enabled' => true,
            ],
        ],
        'related' => [
            'enabled' => true
        ]
    ],

    'header' => [
        'search' => [
            'enabled' => false,
        ],
    ],

    'disk' => [
        'base_path' => ''
    ],

    'tiptap' => [
        'disk' => 'public',
        'disk_directory' => 'blog-posts',
    ],

    'newsletter' => [
        'enabled' => false,
    ],

    'pages' => [
        'overview' => [
            'title' => 'Blog',
            'description' => 'Welcome to our Blog',
        ],
    ]
];
