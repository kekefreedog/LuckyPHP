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
                'default'   =>  '',
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
                'default'   =>  '',
            ],
            # Admin
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
                [
                    'name'      =>  'app_css_framework',
                    'type'      =>  'VARCHAR',
                    'admit'     =>  ['Kmaterialize'],
                    'default'   =>  'Kmaterialize',
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