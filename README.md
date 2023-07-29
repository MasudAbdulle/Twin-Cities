# Twin-Cities
Overview
This project is a web page that leverages various API data to provide information about two twin cities, London and New York. The web page integrates weather data from Open Weather Map, map functionality from Google Maps, and social media data from Twitter and Flickr APIs. Additionally, the web page features a commenting system where users can leave comments, which are then stored in a database.

Features
Weather Information: The web page pulls real-time weather data using the Open Weather Map API to display the current weather conditions in both London and New York.

Interactive Map: The Google Maps API is utilized to showcase an interactive map of the two cities. It features markers indicating various points of interest (POI) that users can explore. When a user clicks on a marker, they are directed to a web page with more detailed information about the specific POI. The POI data, along with associated URLs, are retrieved from the integrated database.

Social Media Integration: The web page integrates with Twitter and Flickr APIs to display social media posts and images relevant to the twin cities.

Commenting System: Users have the option to leave comments on the web page. These comments are securely stored in a MySQL database for future reference.

RSS Feed: The web page provides an RSS feed that includes information about the POIs stored in the database, such as capacity and annual visitors.

Technologies Used
PHP: The main programming language used for the web page's server-side logic.
HTML5: Used to structure the content and layout of the web page.
XML: Utilized for handling and parsing data in XML format.
JavaScript: Implemented to add interactivity and dynamic behavior to the web page.
CSS: Responsible for styling and formatting the web page's appearance.
MySQL: The database management system used to store and retrieve comments and POI data.
Composer: The project uses Composer to manage dependencies and ensure smooth integration of required libraries.
Abraham/twitter OAuth: A PHP library for Twitter's OAuth REST API, used for seamless integration with Twitter.
File Breakdown
index.php: The main application file that serves as the entry point to the web page.
config.php: The configuration file containing essential settings for the web page.
style.css: Holds the required CSS styles to visually enhance the web page.
composer.json: Ensures the project does not encounter dependency issues.
composer.lock: Prevents dependency conflicts by locking the versions of required libraries.
autoload.php: Used to autoload necessary classes without relying on Composer.
Abraham/twitter OAuth: A directory containing files related to the PHP library for Twitter's OAuth REST API.
Installation
To deploy and run the web page on your local environment, follow these steps:

Clone the repository from GitHub Repo URL.
Set up a web server environment (such as XAMPP or WAMP) on your local machine.
Import the included SQL database file to set up the required database structure.
Ensure you have the necessary API keys for Open Weather Map, Google Maps, Twitter, and Flickr APIs, and update them in the configuration file (config.php).
Access the web page using your preferred web browser by launching the web server.
Acknowledgments
This project was made possible by leveraging various open-source libraries and APIs. We extend our gratitude to the developers and communities behind the following technologies:

Open Weather Map API
Google Maps API
Twitter API
Flickr API
Thank you for using our web page, and we hope you find it informative and engaging!

