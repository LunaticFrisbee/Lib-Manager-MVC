# Library Management System

## About
This is a Library Management System built on PHP, based on the MVC web-architecture.

## Dependencies
* This application is built on PHP(version 7.4.3). It is built on the [ToroPHP web framework](https://github.com/anandkunal/ToroPHP) and [Twig](https://twig.symfony.com/) is the templating engine used. Composer(version 2.3.10) is used for the management of the dependencies.
* For this application, you will need a PHP interpreter, composer installed and a mySQL server.
For installing composer, follow the following steps:
```
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
```

## Setup/Installation
* Clone this repository using `git clone <SSH Key of this repo>` and cd into it.
* Run the setup script using 
```
$ chmod +x script.sh
$ ./script.sh
```
After this script runs, a server has been automatically started on the `PORT:5000`. Go to your browser and search `localhost:5000` to start the development server.
If you want to change the port, you can follow the following steps:
```
$ cd public
$ php -S localhost:PORT
``` 
where PORT is the port number you want to use.

## VHost
* Make a new file in `/etc/apache2/sites-available` by the name of `{Domain Name}.com.conf`.
* Then paste the contents of the given `/config/sample.vhost.conf` to the file you ust created.
* Run the following command
```
$ sudo nano /etc/hosts/
```
You will need to add `127.0.0.1 {Domain Name}` to this file.
* Run the following commands now:-
```Bash
$ sudo a2ensite {Domain Name}.conf
$ sudo a2dissite 000-default.conf
$ sudo systemctl restart apache2
```
Your server should be up and running now.

## Usage
This app is split on the usage for two kinds of users, default users(referred to as 'User' from now on) and users with admin priviliges(referres to as 'Admin' henceforth)
1. User
    - You will land at the default login page for user. Existing users sign in and new users can register themselves and then login in to land to the User Dashboard.
    - At the dashboard, you will find
        - All the available books along with their quantity with an option to request any of the books for checkout.
        - You can also see all of the books checked out in your name and you have an option to hand in the checked-out books to the library.
        - The option to logout.
2. Admin
    - You will land at the default login page for users. You will see an option `Continue as Admin`. Click on that and login with the admin credentials to go to the Admin Dashboard.
    - At the Admin Dashboard, you will find
        - All of the available books.
        - Options to either add new or remove existing books.
        - View existing checkout requests and the option of denying/accepting the request.
        - The option to logout.