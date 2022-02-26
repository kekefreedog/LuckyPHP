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
| app | `__DIR__.'/../'` | Root of the app |
| html | `__DIR__.'/../html/'` | Root of the html |
| www | `__DIR__.'/../html/'` | Root of the html (alternative) |
| luckyphp | `__DIR__.'/../vendor/kekefreedog/luckyphp/'` | Root of the framework |


### 3. Validation Sanity Check

### 4. Set context of the current action

### 5. Initialize Controller

### 6. Initialize View