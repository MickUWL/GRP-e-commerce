# GRP-e-commerce
University Project of an e-commerce website.  Using PHP to connect the website front end to the mysql/mariaDB backend

This system has been built on a Centos 7 server utilising Apache to provide the front end website with a mariadb backend.

The PHP version required for this is version 7.

There are 2 main folders:
1 - Database files
  - Contains the ERD for the database and a sql dump of the database with the products table filled out, along with some dummy data when initially testing the system.
  
2 - html folder
  - this can be directly copied across to the /var/www/html directory within an apache envirnment.
  
  Please take note of the config.php file and adjust the database username and password accordingly, you'll also need to create a user with the required permissions on your mysql/mariadb database as well as configure apache appropriately, all other files are present in order to setup the website.
  
  A future update will be to remove the product items info and images from the hard-coded html files and replace it with PHP code to obtain the information from the database instead.
  
  Any comments or questions are welcomed, this project was completed as a level 5 project at university, feel free to fork the code if you wish to use it.
