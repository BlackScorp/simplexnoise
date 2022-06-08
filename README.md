# PHP SimplexNoise

this is just a php version of the original code at 

https://weber.itn.liu.se/~stegu/simplexnoise/simplexnoise.pdf

## Installation

```
composer require blackscorp/simplexnoise
```

## Usage

```php
$noise2D = new \BlackScorp\SimplexNoise\Noise2D();
$greyValue = $noise2D->getGreyValue($locationX, $locationY);
var_dump($greyValue); //a value between 0 and 255
```
## Examples

for more examples and details please take a look at examples folder.
just copy more png images into exampels/gradients in order to create cool effects

currently only 2D is implemented