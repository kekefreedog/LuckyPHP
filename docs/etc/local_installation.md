# Local installation of LuckyPHP

## Edit `composer.json`

You have to define a repository inside you `composer.json` by adding the bellow code :
```json
{ 
    ["..."]
    "repositories": [
        {
            "type": "path",
            // Path of the luckyPHP folder
            "url": "../LuckyPHP",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "kekefreedog/luckyphp": "@dev"
    },
    ["..."]
}
```

## Update composer

Then in your app route folder execute the bellow command :
```sh
composer update
```