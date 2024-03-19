## About

Zenbu Kaemasu Online Shop is an e-commerce established in 2024 by its founder, Mr. Vannes Theo Sudarsono, S.Si, during his learning in web application development. This web application is a place where people can do online shopping with various of products and their categories available. It has features such as creating new account and logging in using the new account, see all products and their categories, searching for some product using keywords, viewing product details, and adding products to cart and/or wishlist. The user is also can be a seller where they are will be able to add new products, modify their products, or even remove their products from their shop. We hope that this web application can be developed further to make its usage and contribution to society will become bigger and better. Happy shopping!

## Installation and Setup

This web application hasn't been hosted yet so first you can download the whole project from [Zenbu Kaemasu Online Shop GitHub repository](https://github.com/vtsMwlyn/zenbu-kaemasu-olshop).

This web application project is using Laravel PHP framework. So the next step is to make sure Laravel is running in your device. If it's not, then you will need to install Laravel. Find the installation guide [here](https://laravel.com/docs/11.x/installation).

This project is also using MySQL to run, so make sure if your device has XAMPP or other application installed and works properly. You can download XAMPP [here](https://www.apachefriends.org/index.html). Then if you decided to use XAMPP, it's recommended to put the project in htdocs folder.

Don't forget to add PHP and Composer to PATH environment variables too.

Then to test if the project could be opened and run properly then you can type start local server on your device by typing this in command prompt:
```bash
php artisan serve
```

Then you can enter "128.0.0.1:8000/" or IP address shown on the command prompt on your browser. Or if you are using XAMPP and put the project in htdocs, you can enter "localhost/zenbu-kaemasu-olshop/public/".

## Available User Roles and Privilleges

This web application is currently having only three roles which are listed below:
- Guests (those who are not logged in)
- Buyers (those who are logged in with normal account)
- Sellers (those who are logged in with seller account).

These roles are defined with middlewares and the authentication and authorization system. Each role has some specific characteristics as shown below:
- Guests are authorized to only view and search products and categories. They're required to create and log in to their account if they want to use more features. In this web application their middleware is known as "guest".
- Buyers are authorized to view and search products and categories also adding products to their cart or wishlist. They can't modify products in the web application. In this web application their middleware is known as "auth".
- Sellers are similar to buyers but they are authorized to modify their products including add, update, and remove products. In this web application their middleware is known as "seller".

## Contributing

This project is using Laravel PHP framework, kindly visit [Laravel website](https://laravel.com/).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
