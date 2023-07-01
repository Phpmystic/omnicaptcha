## OmniCaptcha Laravel Package
OmniCaptcha is a Laravel package that simplifies the integration of multiple captcha services into your web applications. It provides a unified and consistent interface to interact with various captcha service providers, allowing you to enhance security and differentiate between human users and automated bots effectively.

## Features
- Seamless integration with popular captcha service providers.
- Support for multiple captcha types, including text-based challenges, image recognition puzzles, interactive games, and more. 
- Easy configuration and switching between captcha services.
- Consistent methods for generating captchas, validating user responses, and handling errors.
- Clean and maintainable code following Laravel's best practices.
- Comprehensive documentation and examples for quick integration.
- Compatibility with the latest versions of supported captcha service APIs.

## Installation
You can install OmniCaptcha using Composer. Simply run the following command:

```bash
composer require phpmystic/omnicaptcha
```

Once installed, the package will be ready for use in your Laravel application.

## Configuration
Publish the package configuration file:
```bash
php artisan vendor:publish --tag=omnicaptcha
```

Open the published configuration file config/omnicaptcha.php and specify your preferred captcha service provider(s) and their corresponding credentials or API keys.
Usage
OmniCaptcha provides a set of intuitive methods to interact with captcha services. Here's an example of validating a captcha using OmniCaptcha:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Phpmystic\OmniCaptcha\Facades\OmniCaptcha;

class TestController extends Controller
{
    public function __invoke(Request $request)
    {
        OmniCaptcha::verifyIlluminateRequest($request); // returns boolean
    }
}
```


## Contributing
We welcome contributions to enhance OmniCaptcha and make it even more versatile and robust. If you encounter any issues, have suggestions, or would like to contribute, please submit a pull request or open an issue on the GitHub repository.

[!["Buy Me A Coffee"](https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png)](https://bmc.link/phpmystic)

## License
OmniCaptcha is open-source software released under the MIT License. Feel free to use, modify, and distribute the package according to the terms of the license.

## Acknowledgments
We would like to express our gratitude to the Laravel community and the developers of the captcha service providers supported by OmniCaptcha. Their excellent work and contributions have made this package possible.

Thank you for choosing OmniCaptcha to enhance the security and user experience of your Laravel applications. If you have any questions or need assistance, please don't hesitate to reach out.