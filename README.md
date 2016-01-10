# MVC Lite

[![Build Status](https://travis-ci.org/mvc-lite/mvc-lite.svg?branch=master)](https://travis-ci.org/mvc-lite/mvc-lite)
[![Latest Stable Version](https://poser.pugx.org/mvc-lite/mvc-lite/v/stable)](https://packagist.org/packages/mvc-lite/mvc-lite)
[![Total Downloads](https://poser.pugx.org/mvc-lite/mvc-lite/downloads)](https://packagist.org/packages/mvc-lite/mvc-lite)
[![Latest Unstable Version](https://poser.pugx.org/mvc-lite/mvc-lite/v/unstable)](https://packagist.org/packages/mvc-lite/mvc-lite)
[![License](https://poser.pugx.org/mvc-lite/mvc-lite/license)](https://packagist.org/packages/mvc-lite/mvc-lite)
[![Coverage Status](https://coveralls.io/repos/mvc-lite/mvc-lite/badge.svg?branch=master&service=github)](https://coveralls.io/github/mvc-lite/mvc-lite?branch=master)


## Introduction
mvc-lite is a lightweight MVC Framework aimed at accomplishing common MVC
goals in a much lighter package. The bulk of this work is inspired by the
Zend Framework (http://framework.zend.com)

## Usage
This library should be used to create a simple MVC application. If you need
sophisticated application handling, consider a more robust framework, like
Zend Framework, Laravel, or Symfony.

## Quick Start
The `mvc` script can be used to help start an application quickly. It's usage is:
```
./bin/mvc setup --target=/local/path/to/app
```

Once created, adding an entire resources (i.e. Users) can be done like this:
```
./bin/mvc resource:create --target=/local/path/to/app --name=users
```

## Full Documentation
Full documentation can be found on our [GitHub Pages site](http://mvc-lite.github.io/mvc-lite)
