# Install and use Webpack

## Description
Webpack will help us to compile of the css and js file to une bundle wich be easily and securely loaded in the app.

## Install Webpack in yout computer
> Please noticed that Webpack is depending of Node & NPM
- The bellow code will be used for your global installation of webpack
    ```
    npm install --global webpack 
    ```
- You have to install modules for webpack
    ```
    npm install --save-dev css-loader file-loader style-loader url-loader remove-files-webpack-plugin
    ```

## Compile des fichiers CSS / JS
### Pour le dev
On the root folder, execute this command :
```
npm run webpack-dev
```
### Pour un build
On the root folder, execute this command :
```
npm run webpack-build
```
### Pour un dev continu
On the root folder, execute this command :
```
npm run webpack-watch
```