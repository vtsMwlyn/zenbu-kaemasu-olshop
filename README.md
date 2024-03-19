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


## Available User Roles

This web application is currently having only three roles which are listed below:
- Guests (those who are not logged in)
- Buyers (those who are logged in with normal account)
- Sellers (those who are logged in with seller account).

These roles are defined with middlewares and the authentication and authorization system. Each role has some specific characteristics as shown below:
- Guests are authorized to only view and search products and categories. They're required to create and log in to their account if they want to use more features. In this web application their middleware is known as "guest".
- Buyers are authorized to view and search products and categories also adding products to their cart or wishlist. They can't modify products in the web application. In this web application their middleware is known as "auth".
- Sellers are similar to buyers but they are authorized to modify their products including add, update, and remove products. In this web application their middleware is known as "seller".


## Available Pages

This web application is divided into several web pages. They can be categorized as account pages, main shop pages, and manage products pages.

Account pages is working with something related to user accounts. This page category includes:
- Login page, where guests can logged in to their previously created account. (".../login")
- Register page, where guests can create a new account if they don't have one. (".../register")
- Profile page, where buyers/sellers can edit some of their account data (".../profile")

Main shop pages is working with displaying products and categories to guests or buyers. It also has searching and filtering function. This page category includes:
- All products page, where users can see all available products. This is also the main landing page or home page. (".../products")
- All categories page, where users can see all available product categories. It shows category list on the top and some products shown in each category section, allows users to explore more specific products. (".../categories")
- Products by category page, where users can see all available products that are having the selected category. This allows user to focus their searching of a product in a category. (".../categories/...")
- Product details page, where users can see the details of the selected product. It helps users to decide whether they want to buy the product or not. (".../products/...")

Manage products pages is working with product management when sellers want to add new product to their shop, modify existing product in their shop, or even remove a product from their shop. This page category includes:
- My products page, where sellers can see all products existing in their shop. This is the dashboard page for sellers to decide what action will be taken to their products. Removal of a product can be done here. (".../manage-products")
- Add new product page, where sellers can specify the data of a new product to be created and added. (".../manage-products/add")
- Edit product page, where sellers can modify the data of an existing product. (".../manage-products/.../edit")

The routes to each page and also the authorization can be found in file web.php, here are two as examples:
```php
Route::get("/login", [LoginController::class, "index"])->name("login")->middleware("guest");
Route::get("/profile", [ProfileController::class, "index"])->name("profile")->middleware("auth");
```
This means that the route to link ".../login" (named "login") is controlled by LoginController.php file and can only be accessed by guests. Then the route to link ".../profile" (named "profile") is controlled by ProfileController.php file and can only be accessed by those who are already logged in (which are buyers and sellers).

The authorization for seller is a bit different because it uses a Gate that can be found in AppServiceProvider.php file and the authorization is defined like in ProductController.php file:
```php
public function index(){
    $this->authorize("seller");

    return view("seller.myproducts", [
        "products" => Product::where("seller_id", auth()->user()->id)->get()
    ]);
}
```


## Database

This web application uses database to store and retrieve its data. This database is developed using MySQL and Laravel Eloquent Model. Here below are the tables used in this web application:
- roles table, to store roles available in this web application which are buyer and seller.
- users table, to store user credential that will be used to log in.
- categories table, to to store product categories available in this web application which currently are fashion, electronics, tools, healthcares, food & beverages, gadget, and kitchen.
- products table, to store a product's detail data.
- user_details table, to store other user's detail data.
- product_category table, to connect products and categories as implementation of many-to-many relationship.
- carts table, to connect users and products where the products are added to the users cart. This is also an implementation of many-to-many relationship between them.
- wishlists table, to connect users and products where the products are added to the users wishlist. This is also an implementation of many-to-many relationship between them.

Rows of a certain table can be retrieved by calling their object relational model class and their methods. As examples, you can retrieve all or some data from users and user_details table with:
```php
$allUserData = User::all();
$allUserDetailData = UserDetail::all();
$userDataWithCertainName = UserDetail::where("user_name", "A Name")->get();
```

Some tables are related to other table such as users and user_details table where user_details table stores foreign key from users table. This can be used to access other table's data if given a table with relation to the table. This relationship is implemented using methods in the object relational model class like this:
```php
class UserDetail extends Model {
    use HasFactory;

    protected $guarded = ["id"];

    public function appUser(){
        return $this->belongsTo(User::class);
    }
}
```

You can find a sql file from this repository. Use it to import the database in your device. Or you can use database seeder in the project to generate data by enter this in command prompt:
```bash
php artisan migrate --seed
```

Adding, updating, or removing data in the database is controlled with Controllers in this web application. It also can validate input forms like in login page, register page, profile page, manage products page, add new product page, and edit product page.
- Login page will read data from users table.
- Register page will store new data to users and user_details table.
- Profile page will read and update user_details table.
- Manage products page will read data from products table also delete data in products, product_category, cart, and wishlist table.
- Add new product page will store new data to products and product_category table.
- Edit new product page will read and update data from/in products and product_category table.



## Contributing

This project frontend is using HTML, CSS, and JavaScript, especially Bootstrap CSS framework, kindly visit [Bootstrap website](https://getbootstrap.com) This project backend is using Laravel PHP framework, kindly visit [Laravel website](https://laravel.com/).


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
