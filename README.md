# Strivex String

This package contains some easy-to-use string functions.

## How to install?

Follow these steps to install and use the custom string functions.

1. __Install Strivex String__

   Install Strives String using composer.
```shell
$ composer require strivexnl/strivex-string
```

## How to use Strivex String?
1. __Create an instance of Strivex\String__
```php
$sst = new Strivex\String();
```

2. __Use one of the available custom functions__
```php
$result = $sst->toCamelCase('This is some text');
// The result will be thisIsSomeText.
```

## Available custom functions.
We have created some custom functions that can be used on string.

### toLowerCase($string)
The toLowerCase function will simply convert the input to a ```lowercase``` string.

| Parameter | Type   | Description     | Default | Required |
|-----------|--------|-----------------|:----|:--------:|
| string    | String | The text to use | n/a |   yes    |

Example:
```php
// This will return "this is an example"
$sst->toLowerCase('This is an example');
```

### toUpperCase($string)
The toLowerCase function will simply convert the input to an ```UPPERCASE``` string.

| Parameter | Type   | Description     | Default | Required |
|-----------|--------|-----------------|:----|:--------:|
| string    | String | The text to use | n/a |   yes    |

Example:
```php
// This will return "THIS IS AN EXAMPLE"
$sst->toUpperCase('This is an example');
```

### toCamelCase($string, $leaveSlashes, $delimiter="/")
The toCamelCase function will convert the input to a ```camelCased``` string.

| Name         | Type    | Description     | Default | Required |
|--------------|---------|-----------------|:----|:--------:|
| string       | String  | The text to use | n/a |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched | false | no |
| delimiter    | String  | Delimiter used in leaveSlashes | "/" | no |
_When using leaveSlashes the ```camelCase``` will be used on all parts individually!_

Example:
```php
// This will return "thisIsAnExample"
$sst->toCamelCase('This is an example');

// This will return "we/have/something/likeThis"
$sst->toCamelCase('We/have/something/like-this', true, "/");
```

### toPascalCase($string, $leaveSlashes, $delimiter="/")

| Name         | Type    | Description     | Default | Required |
|--------------|---------|-----------------|:----|:--------:|
| string       | String  | The text to use | n/a |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched | false | no |
| delimiter    | String  | Delimiter used in leaveSlashes | "/" | no |
__When using leaveSlashes the ```PascalCase``` will be used on all parts individually!_

Example:
```php
// This will return "ThisIsAnExample"
$sst->toPascalCase('This is an example');

// This will return "We/Have/Something/LikeThis"
$sst->toPascalCase('We/have/something/like-this', true, "/");
```

### toSnakeCase($string, $leaveSlashes, $delimiter="/")

| Name         | Type    | Description     | Default | Required |
|--------------|---------|-----------------|:----|:--------:|
| string       | String  | The text to use | n/a |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched | false | no |
| delimiter    | String  | Delimiter used in leaveSlashes | "/" | no |
__When using leaveSlashes the ```snake_case``` will be used on all parts individually!_

Example:
```php
// This will return "this_is_an_example"
$sst->toSnakeCase('This is an example');

// This will return "we/have/something/like_this"
$sst->toSnakeCase('We/have/something/like-this', true, "/");
```

### toKebabCase($string, $leaveSlashes, $delimiter="/")

| Name         | Type    | Description     | Default | Required |
|--------------|---------|-----------------|:----|:--------:|
| string       | String  | The text to use | n/a |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched | false | no |
| delimiter    | String  | Delimiter used in leaveSlashes | "/" | no |
__When using leaveSlashes the ```kebab-case``` will be used on all parts individually!_

Example:
```php
// This will return "this-is-an-example"
$sst->toKebabCase('This is an example');

// This will return "we/have/something/like-this"
$sst->toKebabCase('we/have/something/likeThis', true, "/");
```
