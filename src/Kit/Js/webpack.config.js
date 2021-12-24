/*******************************************************
 * Copyright (C) 2019-2021 Kévin Zarshenas
 * kevin.zarshenas@gmail.com
 * 
 * This file is part of LuckyPHP.
 * 
 * This code can not be copied and/or distributed without the express
 * permission of Kévin Zarshenas @kekefreedog
 *******************************************************/
const path = require('path');
const RemovePlugin = require('remove-files-webpack-plugin');
module.exports = {
    /* Main js file */
    entry: {
        "app":'./resources/js/app.js',
    },
    /* Output for www */
    output: {
        filename: 'index.js',
        path: path.resolve(__dirname, 'www/js'),
    },
    module: {
        rules: [
            /* Css */
            {
                test: /\.css$/i,
                use: ['style-loader', 'css-loader'],
            },    
            /* Fonts */  
            {
                test: /\.(woff|woff2)$/,
                type: 'asset/resource',
                generator: {
                    filename: './../fonts/[name][ext]',
                },
            },
        ],
    },
    plugins: [
        /* Clean js with hash */
        new RemovePlugin({
            before: { 
                include: [
                    './www/js',
                ],
            },
            watch: { 
                include: [
                    './www/js',
                ],
            },
            after: { }
        })
    ]
};