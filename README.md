Allanah Johnson
===

> A bespoke Wordpress theme based on the [Underscores](https://underscores.me/) starter theme. 

Built for a professional psychotherapist and counselor who specialises in working with children and adolescense.

Installation
---------------

### Requirements

This theme requires the following dependencies:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)

### Setup

To start using all the tools that come with this theme you need to install the necessary Node.js and Composer dependencies :

```sh
$ composer install
$ npm install
```

Usage
---------------

### Available CLI commands

This theme comes packed with CLI commands tailored for WordPress theme development :

- `composer lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer lint:php` : checks all PHP files for syntax errors.
- `composer make-pot` : generates a .pot file in the `languages/` directory.
- `npm run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
- `npm run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
- `npm run bundle` : generates a .zip archive for distribution, excluding development and system files.
- `npm run dev` : compiles all SASS files to css and bundles all JavaScript.
- `npm run watch` : watches all SASS and JavaScript files and compiles/bundles them when they change.
- `npm run production` : compiles/bundles and minifies all SASS and JavaScript files for production.

Credits
---------------

Based on Underscores https://underscores.me/, (C) 2012-2020 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2018 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)