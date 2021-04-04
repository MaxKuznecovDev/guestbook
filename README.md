<h1 align="center">The Guestbook</h1>

<h2 align="center"><a  href="http://b99250uk.beget.tech/">Live Demo</a></h2>


## Description

**The classic guestbook**


Guestbook for leaving comments. After registration or authorization, the user can add, edit and delete comments.

## How to install

### 1.Create a new database for your new users and their comments:
You can use guestbook_db.sql from repository and add new database to your database.
Or you can create your own database with custom table names, but you have to edit the file "project \ config \ connection_db.php".

### 2.Connection to your database:

```php
// project\config\connection_db.php
<?php
define('DB_HOST', 'localhost');//the location of your database
define('DB_USER', 'root');// the username to connect to your database
define('DB_PASS', 'root');//the password to connect to your database
define('DB_NAME', 'guestbook_db');//the name of the database where the user and comment tables are located
....
```

## Technology stack

HTML, CSS, PHP , MySQL, MVC pattern
