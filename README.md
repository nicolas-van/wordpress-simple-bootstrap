# Wordress Simple Bootstrap

Simple Bootstrap is a basic Wordpress theme using Boostrap 3, mostly aimed as a starting point for developers to build their own themes using Bootstrap.

It is build to very clean, responsive and easy to modify. It supports customizable background, image header and both left and right sidebars (the sidebars only appear if you put widgets in them).

<p align="center">
  <img src="./screenshot.png" width="500px">
</p>

## Links

* [Theme page on Wordpress.org](https://wordpress.org/themes/simple-bootstrap/)
* [Test this theme](https://wp-themes.com/simple-bootstrap/)

## Extension guide

Let's state it clearly once and for all: trying to put some CSS above a pre-compiled Bootstrap is a very bad practice. The proper way to extend Bootstrap is to alter its behavior using [LESS](http://lesscss.org/) and to re-compile it. Here is how to do so.

### Requirements

* [node.js](https://nodejs.org/en/)

### Install dependencies

```bash
npm install
```

### Modify LESS files

They are located in the `less` folder.

### Compile LESS files

```
npm run build
```

## Supported browsers

- IE up to IE8
- Latest version of all other major browsers
