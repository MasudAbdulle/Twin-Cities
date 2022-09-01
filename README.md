# Twin-Cities
This project is a web page that pulls API data from two twin cities (London and New York). The data pulled include weather(open weather map),map(google maps)
,twitter and flikr api's.
The web page is also has a database integrated that allows a user to comment and this comment will be stored in a database.
The google map API also contains several points of interest markers which if clicked on will take the user to a web page on the POI they clicked on. The data( the POI's 
and URLs) are both retrived from the database.
The web page also contains a RSS feed of the POI's in the database, including extra data such as capacity and annual visitors.


This web page was built using:
PHP
html5
XML
javascript
CSS
RSS
MySQL

File breakdown
index.php purpose main application file
config.php purpose configuration file
style.css purpose holds required CSS
composer.json purpose removes dependency issues
composer.lock purpose removes dependency issues
autoload.php purpose Use to autoload needed classes without Composer
Abraham/twitter OAuth purpose PHP library for Twitter's OAuth REST API (this contains several files)



