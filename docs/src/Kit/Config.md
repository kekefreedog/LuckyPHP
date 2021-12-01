# ***Class*** **Arrays**

## Info

```php
namespace  LuckyPHP\Kit\Config; # Name Space
public class Config{}           # Class name
```

## Description
This class contains constants for config

## Constants

### 1. public ***const*** **CONFIG**
- Config of the project by default
```php
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
        # Type
        [
            'name'      =>  'app_database_type',
            'type'      =>  'VARCHAR',
            'admit'     =>  ['pdo'],
            'default'   =>  'pdo'
            
        ],
        # Type
        [
            'name'      =>  'app_database_dbname',
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
];
```