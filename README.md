![image](http://www.spottr-fotolocations.de/wp-content/uploads/2015/12/spottr-screens.png)

# spottr-locationmanager
Spottr is a locationmanager build for photographers and urbexer. Find out more at [www.spottr-fotolocations.de](http://www.spottr-fotolocations.de)

# Demo

[Have a look at our Demo](http://dev.art-ifact.de/spottr-demo/)

# Requirements

- PHP >5.5
- MySQL

# download 

[v1.0 Alpha](https://github.com/artifactdev/spottr-locationmanager/archive/v1.1a.zip)

# Install instructions

- first you need to create a mysql table with the name "spottr" 
- import "mysql_install.sql" from "/rest-api/docu/"
- upload the files to your server

- create folder "org" and "thumb" in "/rest-api/media/locations"

- edit "/rest-api/app/config/configure.php"
  - define("CONF_DATABASE_SERVER", "Your databaseserverURL (localhost)");
  - define("CONF_DATABASE_USERNAME", "Your Database User");
  - define("CONF_DATABASE_PASSWORD", "Your Database Users password");
  - define("CONF_DATABASE_SCHEMA", "spottr");

- edit "/rest-api/app/config/rest-configure.xml"
  <host>Your URL where the application is accessed</host>
  <application_path>/rest-api/</application_path>
  
# First Login
  - The login-data for the first login is:
    - E-Mail: spottr@spottr-fotolocations.de
    - Password: firstlogin

# Add your user and delete the first login user

- go to administration in the top right corner
- click on the user icon in the top
- add your account which fits your e-mail address
  - it's very important that you set this user to the role user and administrator
- logout and login with your created user
- now it's important that you delete the firstloginuser in the user administration where you created your user

- You're ready to go.


Please create an [issue](https://github.com/artifactdev/spottr-locationmanager/issues) if you have any problems or connect us in the
[G+ Community](https://plus.google.com/communities/108057769811540833945).
