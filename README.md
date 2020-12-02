# user-service
The service works over the HTTP protocol, supports a basic set of commands, stores data about the user and gives them on request


INSTALLATION
------------

### Install

[Install composer](http://getcomposer.org/)

### Download sources

[https://git@github.com:YevheniiGorg/user-service.git](/YevheniiGorg/user-service/archive/master.zip)

### Or clone repository manually
~~~
git clone https://github.com/YevheniiGorg/user-service.git
~~~

### Install composer dependencies
~~~
composer install
~~~

### Database

Create a database and edit the file `config.php` with real data, for example:

```php
define("HOST", "localhost");
define("DATABASE", "test_user_data");
define("USER", "root");
define("PASSWORD", "");
```
Import data from file user.sql

### Request

The command name is passed in the request headers
~~~
COMMAND: COMMAND_NAME
~~~

Parameters for the command are passed in the request body; format - JSON.

Command List
~~~
1.CREATE
2.UPDATE
3.GET
4.DELETE
5.LIST
~~~
User data
~~~
● nick
● password
● role:
    ○ admin
    ○ moderator
    ○ user
● additional_data 
~~~