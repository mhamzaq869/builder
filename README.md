# Laravel Pagebuilder

This provides you to design or develop your page without writing any code and also you can save your page design HTML code in your database.

You can create templates and assign them to a specific page and ofcourse, there is an option to create pages.


## Demo
![demo 2](https://i.ibb.co/pRn8V4Y/Fire-Shot-Capture-017-Free-Open-Source-Website-Page-Builder-laravelbuilder-dev.png)
![demo 2](https://i.ibb.co/ypckJND/Fire-Shot-Capture-019-Lara-Builder-Page-laravelbuilder-dev.png)


![demo 1](https://i.ibb.co/xY7fk5v/Fire-Shot-Capture-013-Lara-Builder-Page-laravelbuilder-dev.png)
![demo 2](https://i.ibb.co/5R3y1NR/Fire-Shot-Capture-015-Lara-Builder-Page-laravelbuilder-dev.png)
![demo 3](https://i.ibb.co/JrJp7dY/Fire-Shot-Capture-015-Lara-Builder-Page-laravelbuilder-dev1.png)



## Installation

Use the Composer package manager [composer](https://getcomposer.org/) to install.

```bash
composer require mhamzaq869/builder
```

## Usage

Publish Service Provider
```php
php artisan vendor:publish --provider="Code\Builder\BuilderServiceProvider"
```
Migrate your migration 
```php
php artisan migrate
```

Go to the index page
```php
/builder/page
```
Create or design Templates
```php
/templates
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
