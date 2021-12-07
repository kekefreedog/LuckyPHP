# ***Class*** **Arrays**

## Info

```php
namespace  LuckyPHP\Kit\Structure;  # Name Space
public class Structure{}            # Class name
```

## Description
This class contains constant for structure folder

## Constants

### 1. public ***const*** **APP**
- Default structure of the app
```php
[
    "/" =>  [
        'folders'=>  [
            'www'   =>  [
                'files'      =>  [
                    '.htaccess' =>  [
                        'source'    =>  null,
                        'function'  =>  [
                            'name'      =>  'htaccessWrite',
                            'arguments'=>  [
                                true,
                            ],
                        ],
                    ],
                    'index.php' =>  [
                    ]

                ]

            ],
            'resources' =>  [
                'folders'   =>  [
                    'css'       =>  [
                    ],
                    'js'        =>  [
                    ],
                    'hbs'       =>  [
                    ],
                    'md'        =>  [
                    ],
                ],
            ],
            'config'    =>  [
                'files'      =>  [
                    'app.yml' =>  [
                        'function'  =>  [
                            'name'      =>  'configWrite',
                        ],
                    ],
                ]
            ],
            'logs'      =>  [

            ],
            'storage'   =>  [

            ],
        ],
    ],

];
```