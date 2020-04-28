# Laravel Utilities

[![Latest Stable Version](https://poser.pugx.org/aposoftworks/stub-helper/version)](https://packagist.org/packages/aposoftworks/stub-helper) [![Total Downloads](https://poser.pugx.org/aposoftworks/stub-helper/downloads)](https://packagist.org/packages/aposoftworks/stub-helper) [![License](https://poser.pugx.org/aposoftworks/stub-helper/license)](https://packagist.org/packages/aposoftworks/stub-helper) [![Support](https://img.shields.io/badge/Patreon-Support-orange.svg?logo=Patreon)](https://www.patreon.com/rafaelcorrea)

A class to help you create, manage and populate stubs

## Installation

This project supports PSR-4 autoload and can be used standalone.

``` bash
composer require aposoftworks/stub-helper
```

## Usage
You have two options, one with a default that searches for variables like: `{{ variable }}` and another one that you can customize the search pattern. But all in all, it's pretty simple.

``` PHP
use Aposoftworks\StubHelper\Classes\StubHelper;

$stub = new StubHelper;
$stub->getFile("./path/to/your/file.stub");
//Or you can only load in the file
$file = file_get_contents("./path/to/your/file.stub");
$stub->setFile($file);
$stub->addVariables(["className" => "AwesomeClass", "path" => "App\Classes"]);
//Here you can get your file so you can save it
$result = $stub->print();
file_set_contents("./path/to/your/file.stub", $result);

```

## Customization
As I said before, you can even customize the patterns used

``` PHP
//You can place a pattern
StubHelper::setVariablePattern("/(<<|>>)/");
//Or an array including the open and close
StubHelper::setVariablePattern(["<<", ">>"]);

//And now you can start editing

```
