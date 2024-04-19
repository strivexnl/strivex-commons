# Strivex\Commons\Json\JsonEditor.php

## How to use JsonEditor?
1. __Make sure Strivex\Commons is installed__
   ```php
   $ composer require strivexnl/strivex-commons
   ```
   
2. __Create an instance of the JsonEditor__
   ```php
   // For example: the string helper.
   $jsonEditor = new Strivex\Commons\Json\JsonEditor("path-to-file.json");
   ```

2. __Use the functions in the JsonEditor__
         
   We use this JSON file as an example:
   ```json 
   {
     "name": "Some Name",
     "version": "0.0.1",
     "extra": {
       "label1": "Label One",
       "label2": "Label Two",
       "label10": "Label Ten"
     },
     "nested": {
       "item1": "Item1",
       "item2": "Item2",
       "item3": "Item3",
       "item4": "Item4",
       "item5": "Item5",
       "item6": "Item6"
     }
   }
   ```   
 
   Then we use the methods in the Json Editor.
   ```php
   // Add an "label" in "extra".
   $jsonEditor->add('extra.label3', 'Label Three');
   
   // Add an array to "options" (=new item in json)
   $jsonEditor->add('options', ['opt1' => 'blabla', 'opt2' => ['name' => 'Option 1', 'Description' => 'Some label']]);
   
   // Delete "label10" in "extra".
   $jsonEditor->delete('extra.label10');
   
   // Bump version to a new major pre release.
   $jsonEditor->bumpVersion('version', 'major', true);
    ```
   
   This will result in the following JSON:
   ```json
   {
     "name": "Some Name",
     "version": "1.0.0-alpha.1",
     "extra": {
       "label1": "Label One",
       "label2": "Label Two",
       "label3": "Label Three"
     },
     "options": {
       "opt1": "blabla",
       "opt2": {
         "name": "Option 1",
         "Description": "Some label"
       }
     }
   }
   ```
 
## Available Methods

| Method                            | Description             |
|-----------------------------------|-------------------------|
| [__constructor](#__constructor)   | The constructor.        |
| [add](#add)                       | Add a key to the json.  |
| [addMultiple](#addmultiple)       | Add key/value (array).  |
| [delete](#delete)                 | Delete a key.           | 
| [deleteMultiple](#deleteMultiple) | Delete multiple keys.   | 
| [get](#get)                       | Get a key.              |
| [reload](#reload)                 | Reload the JSON file.   |  
| [save](#save)                     | Save the JSON file.     |
| [bumpVersion](#bumpversion)       | Bump the version.       |
| [toString](#tostring)             | Returns a string (JSON) |             
| [toArray](#toarray)               | Returns an array        | 


### __constructor
The ___constructor_ method will initialize the JsonEditor.

| Parameter | Type   | Description                 | Default | Required |
|-----------|--------|-----------------------------|:--------|:--------:|
| filePath  | String | File path to the JSON file. | n/a     |   yes    |

Example:
```php
$editor = new JsonEditor($pathToFile);
```

### add
The _add_ method will add the key (with value) to the JSON.

| Parameter  | Type             | Description                                          | Default | Required |
|------------|------------------|------------------------------------------------------|:--------|:--------:|
| $key       | String           | The key for the value.                               | n/a     |   yes    |
| $value     | String<br/>Array | The value as a string or an array.                   | n/a     |   yes    |
| $overwrite | Boolean          | Whether to overwrite the key when it already exists. | false   |    no    |

Example:
```php
// Simple with key and value.
$jsonEditor->add('note', 'This is a little note I wrote.', true);

// You can even use . notation here!
$jsonEditor->add('some.thing', 'wow');

// Members.
$members = [["name" => 'Jon Doe', "age" => 48],[ "name" => "Jane Doe", "age" => 47]];

// Add an array.
$jsonEditor->add('members', $members);
```

### addMultiple
The _addMultiple_ method will add multiple key/value pairs (array) to the JSON.

| Parameter  | Type             | Description                                          | Default | Required |
|------------|------------------|------------------------------------------------------|:--------|:--------:|
| $keyValues | Array            | An array with key/value pairs.                       | n/a     |   yes    |
| $overwrite | Boolean          | Whether to overwrite the key when it already exists. | false   |    no    |

Example:
```php
// Add an array.
$brands = ["BMW", "KIA", "TESLA", "VOLVO"];
$jsonEditor->add('cars.popular', $cars);
```

### delete
The _delete_ method will delete the key from the JSON.

| Parameter | Type    | Description                                          | Default | Required |
|----------|---------|------------------------------------------------------|:--------|:--------:|
| $key     | String  | Key to delete.                                       | n/a     |   yes    |

Example:
```php
// Delete key.
$jsonEditor->delete('nested.item4');
```

### deleteMultiple
The _deleteMultiple_ method will delete multiple keys from the JSON.

| Parameter | Type  | Description                | Default | Required |
|-----------|-------|----------------------------|:--------|:--------:|
| $keys     | Array | Array with keys to delete. | n/a     |   yes    |

Example:
```php
// Delete key.
$jsonEditor->deleteMultiple([
    'nested.item1',
    'nested.item2'
]);
```

### get
The _get_ method will get the key from the JSON.

| Parameter | Type   | Description              | Default | Required |
|-----------|--------|--------------------------|:--------|:--------:|
| $key      | String | Key for the item to get. | n/a     |   yes    |

Example:
```php
// Delete key.
$popularCars = $jsonEditor->get('cars.popular');
```

### reload
The _reload_ method will reload the JSON file. All changes will be gone.

| Parameter | Type   | Description                 | Default | Required |
|-----------|--------|-----------------------------|:--------|:--------:|
| filePath  | String | File path to the JSON file. | n/a     |   yes    |

Example:
```php
$jsonEditor->reload($pathToJsonFile);
```

### save
The _save_ method will save the editted JSON file.

| Parameter | Type | Description | Default | Required |
|-----------|------|-------------|:--------|:--------:|
| n/a       | n/a  | n/a         | n/a     |   n/a    |

Example:
```php
$jsonEditor->save();
```

### bumpVersion
The _bunmpVersion_ method will bump the given version in the JSON file.

| Parameter       | Type    | Description                                                                                                                                                          | Default | Required |
|-----------------|---------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------|:--------|:--------:|
| path            | String  | The path in the json to the "version"<br/>The "version" should be in [semantic versioning](https://semver.org/) format                                               | n/a     |   yes    |
| type            | String  | Type to bump, using constants:<br/>- _BUMPTYPE_MAJOR_<br/>- _BUMPTYPE_MINOR_<br/>- _BUMPTYPE_PATCH_<br/>- _BUMPTYPE_ALPHA_<br/>- _BUMPTYPE_BETA_<br/>- _BUMPTYPE_RC_ | n/a     |   yes    | 
| startPreRelease | Boolean | Whether or not start a prerelease (alhpa) when bumping.                                                                                                              | false   |    no    |
| overwrite       | Boolean | Whether or not to overwrite when the version already exists in the JSON.                                                                                             | true    |    no    |
   
Example:
```php
// Set version to new major prerelease version (eg 2.0.0-alpha.1).
$jsonEditor->bumpVersion('version', 'major', true);
```


### toString
The _toString_ method will return the JSON file as a string.

| Parameter | Type | Description | Default | Required |
|-----------|------|-------------|:--------|:--------:|
| n/a       | n/a  | n/a         | n/a     |   n/a    |

Example:
```php
$jsonAsString = $jsonEditor->toString();
```

### toArray
The _toString_ method will return the JSON file as a string.

| Parameter | Type | Description | Default | Required |
|-----------|------|-------------|:--------|:--------:|
| n/a       | n/a  | n/a         | n/a     |   n/a    |

Example:
```php
$jsonAsArray = $jsonEditor->toArray();
```

