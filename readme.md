# Text color calculator

A simple collection of effective functions to determine whether to use black or white as text color for a given background.

Examples:
```php
<?php
require __DIR__ . '/vendor/autoload.php';

use function TextColorCalculator\fromColorCode;
use function TextColorCalculator\fromHtmlCode;
use function TextColorCalculator\toHtmlCode;

var_dump(fromHtmlCode('#fff'));
var_dump(fromHtmlCode('#000'));
var_dump(fromHtmlCode('#FFFFFF'));
var_dump(fromHtmlCode('#000000'));

list($red, $green, $blue) = fromHtmlCode('00ADD8');

var_dump(compact('red', 'green', 'blue'));

var_dump(toHtmlCode(fromHtmlCode('#fff')));

```