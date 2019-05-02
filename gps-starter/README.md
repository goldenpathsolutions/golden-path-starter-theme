# Golden Path Solutions Starter Theme

This is a child theme of the Understrap starter theme.  We used a child theme so it would be easier to integrate Understrap updates with each new project.

## SASS, CSS, and JS

Although we start off using best practices, and minifiying our CSS and JS, we understand this can be cumbersome for developers trying to make small changes after launch.  Therefore, we provide for ways to stop using or override the minified files as discussed below.

We use SASS in this theme, but the style.css file is loaded after main.css, so if you don't want to deal with compiling SASS, you can just add CSS there.

We will usually use minified CSS, but the theme will automatically fall back to using the unminified main.css file if the minified version is missing, so you can delete the minified version if you don't want to use it.

More importantly, the same is true of the main.js, so if you need to edit the JavaScript included in the theme, and don't want to deal with using gulp to re-minify, you can just delete the minified version, and edit the unminified file.

## Theme functions and includes directory

The most fundamental setup functions are in the files beginning with setup-.  These include enqueue functions, text domain definition, etc.

If you want to add your own custom code for the theme, this is the place to do it.

One of our goals is to keep the functions.php file clean, and only add the include statements for the other supporting php scripts there.  We also try to keep each php file short. This should help to make the code more modular, reusable, and arguably easier to navigate.

## 3rd party libraries and the lib directory

We use the lib directory to store 3rd party libraries.  It helps keep our custom code separate from vendor code.

***

# understrap-child
Basic Child Theme for UnderStrap Theme Framework: https://github.com/understrap/understrap

## How it works
Understrap Child Theme shares with the parent theme all PHP files and adds its own functions.php on top of the UnderStrap parent theme's functions.php.

**IT DOES NOT LOAD THE PARENT THEMES CSS FILE(S)!** Instead it uses the UnderStrap Parent Theme as a dependency via npm and compiles its own CSS file from it.

Understrap Child Theme uses the Enqueue method to load and sort the CSS file the right way instead of the old @import method.

## Installation
1. Install the parent theme UnderStrap first: `https://github.com/understrap/understrap`
   - IMPORTANT: If you download UnderStrap from GitHub make sure you rename the "understrap-master.zip" file to "understrap.zip" or you might have problems using this child theme!
1. Upload the understrap-child folder to your wp-content/themes directory
1. Go into your WP admin backend 
1. Go to "Appearance -> Themes"
1. Activate the UnderStrap Child theme

## Editing
Add your own CSS styles to `/sass/theme/_child_theme.scss`
or import you own files into `/sass/theme/understrap-child.scss`

To overwrite Bootstrap's or UnderStrap's base variables just add your own value to:
`/sass/theme/_child_theme_variables.scss`

For example, the "$brand-primary" variable is used by both Bootstrap and UnderStrap.

Add your own color like: `$brand-primary: #ff6600;` in `/sass/theme/_child_theme_variables.scss` to overwrite it. This change will automatically apply to all elements that use the $brand-primary variable.

It will be outputted into:
`/css/understrap-child.min.css` and `/css/understrap-child.css`

So you have one clean CSS file at the end and just one request.

## Developing With NPM, Gulp, SASS and Browser Sync

### Installing Dependencies
- Make sure you have installed Node.js, Gulp, and Browser-Sync [1] on your computer globally
- Open your terminal and browse to the location of your UnderStrap copy
- Run: `$ npm install` then: `$ gulp copy-assets`

### Running
To work and compile your Sass files on the fly start:

- `$ gulp watch`

Or, to run with Browser-Sync:

- First change the browser-sync options to reflect your environment in the file `/gulpconfig.json` in the beginning of the file:
```javascript
  "browserSyncOptions" : {
    "proxy": "localhost/wordpress/",
    "notify": false
  }
};
```
- then run: `$ gulp watch-bs`

[1] Visit [https://browsersync.io/](https://browsersync.io/) for more information on Browser Sync
