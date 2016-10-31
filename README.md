# Sample Web Application based on gelembjuk/webapp



## Installation

### Create a config file

Copy app/config.inc_template.php to app/config.inc.php . Set our settings.

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


