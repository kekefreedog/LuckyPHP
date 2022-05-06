# ***App*** **Folder Structure**

## Description
- Full details and good practice about how is organized your app.

## Structure
```yml
root:
    # Stored all cached items (server side only)
    cache:
        routers:
            {timestamp}_routers_cache.php
    # Stored all config data (yml format recommanded)
    config:
        app.yml # App settings
        media.yml # List of medias (logos, favicons...)
        page.yml # All setting for head of html pages (meta, script...)
        routes.yml # List of all the routes of the app (html, json, data, api...)
    # (optionnal) Stored all documentation about your app
    docs:
        api:
            # Doc about api of your api
        app:
            # Doc about api of your app
        src:
            # Doc about api of your php, js scripts
    # (Don't touch) Stored compilated code for front side
    html:
        css:
            # Compilated css files
        fonts:
            # Comilated fonts files
        js:
            # Compilated js files
        .htaccess # Allow to redirect subpage to root
        index.php # Index of the page
        manifest.json # Informations for browsers
    # Stored all logs about the framework / app...
    logs:
        app.log # Logs of your app
        luckyphp.log # Logs about the framework
        vendor.log # Logs for some php vendor
    # All js vendors
    node_modules:
    # Differents assets organized by language of format 
    ressources:
            # Css files
        css:
            # Handlebarjs files
        hbs:
            # Js files
        js:
            # Json files
        json:
            # Markdown files
        md:
            # Scss files
        scss:
            # Yaml files
        yml:
    # Storage placed for compilated media with differents size or format...
    storage:
    # Stored all php script files; and js files which be compilated
    src:
        # Environnement src of your app
        environment:
            # App script
            app:
                app.php # Workflow of your app
                controller.php # Workflow of controllers
                model.php # Workflow of models
                viewer.php # Workflow of viewers
            # Component scr (for popup, module...)
            components:
                login:
                    config.yml # Config which defined the dependances, specific information about the current component..
                    template.hbs # Template of html for front side
                    styles.scss # Template of css for front side
                    styles.css # Template of css for front side
                    services.php # Controlleur defining specific service for back end link to current component
                    events.js # List of events of component
                    extra:
                        placeholder.hbs # Placeholder when loading for front side
                        error.hbs # Error template response for front side
            # Page scr
            page:
                home:
                    config.yml
                    template.hbs
                    styles.scss
                    styles.css
                    services.php
                    events.js
                    extra:
                        placeholder.hbs
                        error.hbs
            # Common structure of the page
            structure:
                header:
                    config.yml
                    template.hbs
                    styles.scss
                    styles.css
                    services.php
                    events.js
                    extra:
                        placeholder.hbs
                        error.hbs
                main:
                    [...]
                sidenav:
                    [...]
                footer:
                    [...]
        # Custom libraries for your app
        library:
            # Core of your app
            kernel.php
    # All php vendor
    vendor:
    # All files / folders ignore for git pull & push 
    .gitignore
    # Composer config file
    composer.json
    # Npm config file
    package.json
    # Webpack dev config file
    webpack.dev.js
    # Webpack prod config file
    webpack.prod.js


    
```
