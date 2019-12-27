<h4 align="center">Dead simple flat-file blogging for busy people.</h4>

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

* PHP >= 7.0 (untested on older versions)
* Composer

## Installation

```bash
# Download the project files
$ git clone https://github.com/exler/Fiblog .

# Install dependencies
$ composer install

# Fill the configuration file with your blog details
$ nano config.php
```

If you want to modify Fiblog use the built-in PHP development server: 

```bash
$ php -S localhost:8000
```

## Usage

Place files inside the `posts` directory. Fiblog currently supports Markdown and Markdown Extra.  
Filenames can only contain lowercase & uppercase letters separated by dashes.


## License

Copyright (c) 2018-2019 by ***Kamil Marut***.

*Fiblog* is under the terms of the [MIT License](https://www.tldrlegal.com/l/mit), following all clarifications stated in the [license file](LICENSE).
