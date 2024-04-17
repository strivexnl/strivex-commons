# Strivex\Commons\String\StringHelper.php

## How to use StringHelper?
1. __Make sure Strivex\Commons is installed__
   ```php
   $ composer require strivexnl/strivex-commons
   ```
   
2. __Create an instance of the StringHelper__
   ```php
   // For example: the string helper.
   $scsh = new Strivex\Commons\String\StringHelper();
   ```

3. __Use one of the available custom methods in the helper__
   ```php
   $result = $scsh->toCamelCase('This is some text');
   // The result will be thisIsSomeText.
   ```
## Available Custom Methods

| Method                        | Input             | Result                  |
|-------------------------------|-------------------|-------------------------| 
| [toLowerCase](#tolowercase)   | This is some text | ```this is some text``` |
| [toUpperCase](#touppercase)   | This is some text | ```THIS IS SOME TEXT``` |
| [toPascalCase](#topascalcase) | This is some text | ```ThisIsSomeText```    |
| [toCamelCase](#tocamelcase)   | This is some text | ```thisIsSomeText```    |
| [toSnakeCase](#tosnakecase)   | This is some text | ```this_is_some_text``` |
| [toKebabCase](#tokebabcase)   | This is some text | ```this-is-some-text``` |

### toLowerCase
The toLowerCase function will simply convert the input to a ```lowercase``` string.

| Parameter | Type   | Description     | Default | Required |
|-----------|--------|-----------------|:--------|:--------:|
| string    | String | The text to use | n/a     |   yes    |

Example:
  ```php
  // This will return "this is an example"
  $scsh->toLowerCase('This is an example');
  ```

### toUpperCase
The toLowerCase function will simply convert the input to an ```UPPERCASE``` string.

| Parameter | Type   | Description     | Default | Required |
|-----------|--------|-----------------|:--------|:--------:|
| string    | String | The text to use | n/a     |   yes    |

Example:
  ```php
  // This will return "THIS IS AN EXAMPLE"
  $scsh->toUpperCase('This is an example');
  ```

### toPascalCase
The toPascalCase function will convert the input to a ```PascalCased``` string.

| Parameter    | Type    | Description                    | Default | Required |
|--------------|---------|--------------------------------|:--------|:--------:|
| string       | String  | The text to use                | n/a     |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched        | false   |    no    |
| delimiter    | String  | Delimiter used in leaveSlashes | "/"     |    no    |
__When using leaveSlashes the ```PascalCase``` will be used on all parts individually!_

Example:
  ```php
  // This will return "ThisIsAnExample"
  $scsh->toPascalCase('This is an example');
  
  // This will return "We/Have/Something/LikeThis"
  $scsh->toPascalCase('We/have/something/like-this', true, "/");
  ```

### toCamelCase
The toCamelCase function will convert the input to a ```camelCased``` string.

| Parameter    | Type    | Description                    | Default | Required |
|--------------|---------|--------------------------------|:--------|:--------:|
| string       | String  | The text to use                | n/a     |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched        | false   |    no    |
| delimiter    | String  | Delimiter used in leaveSlashes | "/"     |    no    |
_When using leaveSlashes the ```camelCase``` will be used on all parts individually!_

Example:
  ```php
  // This will return "thisIsAnExample"
  $scsh->toCamelCase('This is an example');

  // This will return "we/have/something/likeThis"
  $scsh->toCamelCase('We/have/something/like-this', true, "/");
  ```

### toSnakeCase
The toSnakeCase function will convert the input to a ```snake_cased``` string.

| Parameter    | Type    | Description                    | Default | Required |
|--------------|---------|--------------------------------|:--------|:--------:|
| string       | String  | The text to use                | n/a     |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched        | false   |    no    |
| delimiter    | String  | Delimiter used in leaveSlashes | "/"     |    no    |
__When using leaveSlashes the ```snake_case``` will be used on all parts individually!_

Example:
```php
// This will return "this_is_an_example"
$scsh->toSnakeCase('This is an example');

// This will return "we/have/something/like_this"
$scsh->toSnakeCase('We/have/something/like-this', true, "/");
```

### toKebabCase
The toKebabCase function will convert the input to a ```kebab-cased``` string.

| Parameter    | Type    | Description                    | Default | Required |
|--------------|---------|--------------------------------|:--------|:--------:|
| string       | String  | The text to use                | n/a     |   yes    |
| leaveSlashes | Boolean | Leave slashes untouched        | false   |    no    |
| delimiter    | String  | Delimiter used in leaveSlashes | "/"     |    no    |
__When using leaveSlashes the ```kebab-case``` will be used on all parts individually!_

Example:
```php
// This will return "this-is-an-example"
$scsh->toKebabCase('This is an example');

// This will return "we/have/something/like-this"
$scsh->toKebabCase('we/have/something/likeThis', true, "/");
```
