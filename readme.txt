
Simple Bootstrap is a basic Wordpress theme using Boostrap.

It is build to very clean, responsive and easy to modify. It supports customizable background and both
left and right sidebars (the sidebars only appear if you put widgets in them).

Although it's not absolutely necessary it's recommended to edit the LESS files instead of directly editing
the style.css . It will then be necessary to re-compile these files with the Gruntfile.js. Here are the lines
you will have to type to do so (assuming you already have installed nodejs, bower and grunt-cli):

npm install
bower install
grunt

This theme was inspired by wp-bootstrap: https://github.com/320press/wordpress-bootstrap
