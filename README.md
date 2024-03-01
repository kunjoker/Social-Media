<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# About project

 In this project, we focused on servers for a social media site.We created this project using Laravel as described in the introduction,And also used MongoDB to save information in JSON format.
 
 ## About install MongoDB
 
 ### Download MongoDB:

-Visit the official MongoDB website: https://www.mongodb.com/try/download/community
-Choose your operating system and download the appropriate MongoDB version.

### Install MongoDB:

- **Follow the installation instructions provided for your operating system.**
- **For Windows, it usually involves running the downloaded installer and following the setup wizard.**
- **For macOS, you can install MongoDB using Homebrew or by downloading the .tgz file and extracting it.**
- **For Linux, you can use your package manager to install MongoDB.**

### Configure MongoDB:

- **MongoDB configuration is often minimal for development purposes.**
- **You might need to configure the data directory, log directory, and other settings based on your requirements.**
- **Refer to the MongoDB documentation for detailed configuration options: https://docs.mongodb.com/manual/reference/configuration-options/**
### Start MongoDB:

- **After installation, start the MongoDB server.**
- **On Windows, you might start MongoDB using the Services tool or the Command Prompt.**
- **On macOS or Linux, you can start MongoDB using the terminal.**


### Verify Installation:

- **Open a terminal or command prompt and run mongo to start the MongoDB shell. If MongoDB is running properly, the shell will connect to the MongoDB server.**

### Integration with XAMPP (Optional):
 - **you can't directly integrate it like you would with MySQL or Apache. Instead, you can run MongoDB alongside XAMPP as a separate service.
Alternatively, you can consider using a PHP MongoDB library like mongodb or MongoDB PHP Library. These libraries allow you to interact with MongoDB from your PHP code without the need for XAMPP integration.**

### Final Notes:
- **Make sure to refer to the MongoDB documentation for detailed installation and configuration instructions: https://docs.mongodb.com/manual/installation/**
- **Be aware of the system requirements and compatibility issues while installing MongoDB.**
- **Always use the official MongoDB installer from the MongoDB website to ensure a reliable installation.**
## Laravel framework:
- **In the Laravel framework, MVC (Model-View-Controller) architecture is used to structure applications.**

### Controller:

- **Controllers in Laravel are responsible for handling HTTP requests and executing the appropriate logic to generate a response.**
- **They serve as an intermediary between routes (URLs) and views (templates).**
- **Controllers contain methods (or actions) that correspond to different HTTP verbs (GET, POST, PUT, DELETE, etc.) and are responsible for processing incoming requests.**
- **Controllers typically interact with models to retrieve or manipulate data and pass that data to views.**
- **Controllers are stored in the app/Http/Controllers directory.**

### Route:

- **Routes in Laravel define the endpoints of your application and map them to specific controller actions or closures.**
- **Routes determine how incoming HTTP requests are handled and which controller method or closure should be invoked.**
- **Laravel provides a variety of route types, including basic routes, resource routes, and named routes, among others.**
- **Routes are defined in the routes/web.php file for web routes or routes/api.php for API routes.**
- **You can also define routes in a service provider or within route files in subdirectories for better organization.**

### View:

- **Views in Laravel are responsible for presenting data to the user in a structured format.**
- **Views typically consist of HTML markup mixed with Blade templating syntax, which allows for dynamic content rendering, conditionals, loops, and more.**
- **Views can be included, extended, or nested within other views to promote code reusability and maintainability.**
- **Laravel provides a clean separation between application logic (controllers) and presentation logic (views), allowing for easier maintenance and testing.**
- **Views are stored in the resources/views directory.**

  ### If we go to this path "app\Http\Controllers" in the project files, will find all the controllers, which are:
- **AdminController**
- **UserController**
- **PostController**
- **CommentController**
- We will find all the function that were used in the servers
