# Application Workflow

## A. App_.php_

Index of html folder redirect to `App.php`. Bellow listing of its actions :

### 1. Start chrono

- Start chrono that display on view the time of execution in server side.
- Chrono will be display in viewer if `app.viewer.display = true` in `config > app` 

### 2. Define Routs Path

- Define global values bellow :

| Name | Path | Description |
|-|-|-|
| \_\_ROOT_APP\_\_ | `__DIR__.'/../'` | Root of the app |
| \_\_ROOT_HTML\_\_ | `__DIR__.'/../html/'` | Root of the html |
| \_\_ROOT_WWW\_\_ | `__DIR__.'/../html/'` | Root of the html (alternative) |
| \_\_ROOT_LUCKYPHP\_\_ | `__DIR__.'/../vendor/kekefreedog/luckyphp/'` | Root of the framework |

> We supposed \_\_DIR\_\_ is pointing the html folder

### 3. Validation Sanity Check

#### **Check Hosts**

Using hosts defined in `config.app.allowed` and `config.app.excluded`, the app checked the current hosts calling the script is allowed or exluded.

- By default `config.app.allowed` is set with `*`
- By default `config.app.excluded` is empty `{}`

> This check can be disabled with `config.app.sanity.hosts`

#### **Check Assets**

The app check that html folder contains `*.js` and `*.css` files necessary for validation the app.

> This check can be disabled with `config.app.sanity.assets`

### 4. Set context of the current action

Here the data include in the context by default.
```php
[
    "route" => [
        "current"       =>  "/app/page/index/",
        "parents"       =>  [
            "/app/page/",
            "/app/"
        ],
        "method"        =>  "get",
        "name"          =>  "Home",
        "patterns"      => [
            "/index/"
            "/app/index/"
        ],
        "methods"       => [
            "get"
        ],
        "response"      => "html",
        "ContentType"   => "text/html"
    ],
    "script"=>  [
        "chrono"    =>  [
            "start"     =>  1645961289.3741
        ]
    ]
]
```

### 5. Controller

Return a package which contains :
- Data
- Info for viewer

### 6. Initialize View

Display the result of package as :
- Json
- Html Page
- Media file
- Etc... 