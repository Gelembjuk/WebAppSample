# Sample Web Application based on gelembjuk/webapp

This is the demo of the PHP web application created with the gelembjuk/webapp component.

The idea of the gelembjuk/webapp is to use simple and light PHP class as a core of an app, instead of frameworks. This component implements MVC model. 
It helps to build PHP web applications fast with a focus only on a business logic.

## Demo

Find the demo of this application on http://webapp.gelembjuk.com/

## Installation

### Create a config file

Copy app/config.inc_template.php to app/config.inc.php . Set our settings. For beginning, important are $basehost (your app hostname) and DB settings (for a DB see below)

### Create a DB

Create a database on your MySQL server. Set a DB credentials in a config file (app/config.inc.php)

Execute the database/database.sql in your database to create table(s)

### Configure a Web Root

The folder public/ is a web root of your site. Point a settings of your web site (virtual host) to this folder.

### Create a temp files directory

Create a directory storage/ and 3 subdirectoried in it.

storage/logs   - for an app logs files
storage/template_compile - to keep templates compilation files (Smarty needs this)
storage/tmp - for temporary files

All 3 subdirectoried must be writable by your web server user

### Build a front-end

Go to the directory front-dev/ with a command line and execute ./build . This will copy actual versions of front-end components to public/firectory



