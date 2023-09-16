# Simple Captcha

Simple package to generate and validate captcha in php

## Installation

just add Captcha.php to your project

```php
require 'Captcha.php';
```

## Usage

```php
use Academy01\Captcha\Captcha;
```
generate new captcha in html code.
```php
<img src="<?php echo Captcha::generate(); ?>">
```

validate captcha
```php
$captcha = $_POST['captcha'];
Captcha::validate($captcha); // TRUE or FALSE
```
## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)