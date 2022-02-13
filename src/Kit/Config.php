<?php declare(strict_types=1);
/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 * 
 * This file is part of LuckyPHP.
 * 
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/

/** Namespace
 * 
 */
namespace  LuckyPHP\Kit;

/** Class Setup
 * 
 */
class Config{

    /** Default input
     * 
     */
    public const CONFIG = [
        # App
            # Name
            [
                'name'      =>  'app_name',
                'type'      =>  'VARCHAR',
                'default'   =>  'LuckyApp',
            ],
            # Description
            [
                'name'      =>  'app_description',
                'type'      =>  'VARCHAR',
                'default'   =>  'Application created with LuckyPHP',
            ],
            # Website
            [
                'name'      =>  'app_website',
                'type'      =>  'VARCHAR',
                'process'   =>  'url',
                'default'   =>  '',
            ],
            # Website alt (exemple Github...)
            [
                'name'      =>  'app_websiteAlt',
                'type'      =>  'VARCHAR',
                'process'   =>  'url',
                'default'   =>  'https://github.com/kekefreedog/LuckyPHP',
            ],
            # Charset
            [
                'name'      =>  'app_charset',
                'type'      =>  'VARCHAR',
                'default'   =>  'utf-8',
            ],
            # Indexing
            [
                'name'      =>  'app_indexing',
                'type'      =>  'VARCHAR',
                'default'   =>  'noindex, nofollow',
            ],
            # Darkmode
                # Theme
                [
                    'name'      =>  'app_darkmode_theme',
                    'type'      =>  'ARRAY',
                    'default'   =>  ['light', 'dark'],
                ],
                # Cookie
                    # Mode
                    [
                        'name'      =>  'app_darkmode_mode',
                        'type'      =>  'VARCHAR',
                        'default'   =>  'THEME_MODE',
                    ],
            # Admin
                # Fullname
                [
                    'name'      =>  'app_admin_fullname',
                    'type'      =>  'VARCHAR',
                    'default'   =>  '',
                ],
                # Email
                [
                    'name'      =>  'app_admin_email',
                    'type'      =>  'VARCHAR',
                    'process'   =>  'email',
                    'default'   =>  '',
                ],
            # Hosts
                # Allowed
                [
                    'name'      =>  'app_hosts_allowed',
                    'type'      =>  'ARRAY',
                    'default'   =>  ['*'],
                ],
                # Excluded
                [
                    'name'      =>  'app_hosts_excluded',
                    'type'      =>  'ARRAY',
                    'default'   =>  [],
                ],
            # Css
                # Framework
                    # Source
                    [
                        'name'      =>  'app_css_framework_source',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Author
                    [
                        'name'      =>  'app_css_framework_author',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Package
                    [
                        'name'      =>  'app_css_framework_package',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Branch
                    [
                        'name'      =>  'app_css_framework_branch',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Theme
                    [
                        'name'      =>  'app_css_framework_theme',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Dev
                    [
                        'name'      =>  'app_css_framework_dev',
                        'type'      =>  'BOOLEAN',
                        'default'   =>  false,
                    ],
            # Js
                # Framework
                    # Source
                    [
                        'name'      =>  'app_js_framework_source',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Author
                    [
                        'name'      =>  'app_js_framework_author',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Package
                    [
                        'name'      =>  'app_js_framework_package',
                        'type'      =>  'VARCHAR',
                        'default'   =>  null,
                    ],
                    # Dev
                    [
                        'name'      =>  'app_js_framework_dev',
                        'type'      =>  'BOOLEAN',
                        'default'   =>  false,
                    ],
            # Templates
                # Engine
                    # php
                        # Source
                        [
                            'name'      =>  'app_template_engine_php_source',
                            'type'      =>  'VARCHAR',
                            'default'   =>  'github',
                        ],
                        # Author
                        [
                            'name'      =>  'app_template_engine_php_author',
                            'type'      =>  'VARCHAR',
                            'default'   =>  'zordius',
                        ],
                        # Package
                        [
                            'name'      =>  'app_template_engine_php_package',
                            'type'      =>  'VARCHAR',
                            'default'   =>  'lightncandy',
                        ],
                    # js
                        # Package
                        [
                            'name'      =>  'app_template_engine_js_package',
                            'type'      =>  'VARCHAR',
                            'default'   =>  'handlebars',
                        ],
                # ressources
                [
                    'name'      =>  'app_template_root',
                    'type'      =>  'VARCHAR',
                    'default'   =>  'resources/hbs',
                ],
                # ressources
                [
                    'name'      =>  'app_template_extension',
                    'type'      =>  'VARCHAR',
                    'default'   =>  'hbs',
                ],
            # Auth
                # Type
                [
                    'name'      =>  'app_auth_type',
                    'type'      =>  'VARCHAR',
                    'admit'     =>  ['Kauth'],
                    'default'   =>  'Kauth',
                ],
            # Database
                # Engine
                [
                    'name'      =>  'app_database_engine',
                    'type'      =>  'VARCHAR',
                    'admit'     =>  ['pdo'],
                    'default'   =>  'pdo'
                ],
                # Type
                [
                    'name'      =>  'app_database_name',
                    'type'      =>  'VARCHAR',
                    'default'   =>  'kevinzar_{{app_name}}',
                ],
                # User
                [
                    'name'      =>  'app_database_user',
                    'type'      =>  'VARCHAR',
                ],
                # Password
                [
                    'name'      =>  'app_database_password',
                    'type'      =>  'VARCHAR',
                ],
                # Password
                [
                    'name'      =>  'app_database_host',
                    'type'      =>  'VARCHAR',
                    'default'   =>  '127.0.0.1'
                ],
                # Password
                [
                    'name'      =>  'app_database_port',
                    'type'      =>  'INT',
                    'default'   =>  '5432'
                ],
    ];

}