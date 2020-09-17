<h4 align="center">Perfectly simple flat-file, markdown-based blog engine for busy people</h4>

<p align="center">
	<img width="68" src="assets/logo.png">
</p>

<p align="center">
  	<a href="#requirements">Requirements</a> •
  	<a href="#installation">Installation</a> •
	<a href="#usage">Usage</a> •
  	<a href="#license">License</a>
</p>

## Requirements

* PHP >= 5.6
* Composer

## Installation

Dependencies are handled using [Composer](https://getcomposer.org/download/):
```bash
$ composer install
```

If you want to develop Fiblog use the built-in PHP development server: 
```bash
$ php -S localhost:8000
```

## Usage

* Open the `config.php` file and fill out the necessary fields.
* Place your `.md` files inside the `posts` directory. Fiblog supports Markdown and Markdown Extra.
* Replace the `favicon.png` and `logo.png` files in the `assets` folder to change the logo and site favicon.
* All files must contain the following markup:
```
---
title: Hello World
author: EXLER
date: 01-01-1970
tags: hello, world
---
```
Whitepaces after colons and commas are important.  
Use any date format you want (parsed as a normal string).

## License

Copyright (c) 2018-2020 by ***Kamil Marut***.

`Fiblog` is under the terms of the [MIT License](https://www.tldrlegal.com/l/mit), following all clarifications stated in the [license file](LICENSE).
