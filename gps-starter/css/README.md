# main.css

`main.css` is the compiled output of the SASS, and `main.min.css` is the minified version of it.

Avoid editing `main.css`.  **If you want to add custom css in the theme without compiling sass, add it to `style.css`.** If the SASS is recompiled, any changes to main.css will be overwritten.

**DO** deploy `main.css.map` and/or `main.min.css.map` along with the non-map files.  This helps with troubleshooting because when you look at styles in the development console of a browser, it will show on which sass file and line number the styles are found rather than the compiled css.

# SASS directory

The SASS directory at the theme root is where SASS code is located that is compiled to CSS.  The main.scss file is the starting point, and imports the other major components.  In some cases, the vendor sass files import other SASS code located in the src/SASS directory.

You may edit the files in the root SASS directory, and add your own SASS files as needed.  Avoid editing SASS files in the src directory.