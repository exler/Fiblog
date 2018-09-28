<h4 align="center">Dead simple flat-file blogging for busy people. </h4>

<p align="center">
	<img width="200" src="banner.png">
</p>

<p align="center">
	<a href="#features">Features</a> •
  	<a href="#requirements">Requirements</a> •
  	<a href="#installation">Installation</a> •
  	<a href="#license">License</a>
</p>


## Features
* No Database - all of your posts are easily accessible in separate files.
* Barebones - easily extend your blog and change layout!
* Markdown Support - style your posts with Markdown syntax.
* Lightweight - only 37kB gzipped!
* One Configuration File - start writing as soon as possible!
* One Dependency - Fiblog uses [Parsedown](https://github.com/erusev/parsedown) for parsing Markdown files.

## Requirements

* PHP >= 7.0 (untested on older versions)

## Installation

```bash
# Download the project files
/var/www/html >>> git clone https://github.com/exler/Fiblog .

# Fill the configuration file with your blog details
/var/www/html >>> nano config.php
```

If your web server is working, that's it!
If you want to modify Fiblog use the built-in PHP development server: 
```bash
/var/www/html >>> php -S localhost:8000
```


## License

Copyright (c) 2018 by ***Kamil Marut***.

*Fiblog* is under the terms of the [MIT License](https://www.tldrlegal.com/l/mit), following all clarifications stated in the [license file](LICENSE).
