Please follow the following steps to get Gaman up and running... (best run on an XAMP(LAMP, MAMP, WAMP, XAMPP) stack with phpMyAdmin support)

1. create a database called "gaman" and import the sql file into it.
2. change the values of the "/includes/config_[mac, server, windows].php" files to the appropriate values depending on which OS you are running.
3. change the value of the "SITE_ROOT" constant in the "/includes/initialize.php" file to the appropriate folder depending on which OS you are running.
4. create a virtual host in apache and point it to the "gaman" folder.
5. run the system by entering the virtual host name or "http://localhost/whateverFolderName"
6. success! you should now have a working copy of the "Gaman" prototype system.

If you have any difficulties, please email me at aftha.jaldin88@gmail.com for assistance.

For a working demo of the site, please visit http://gaman.byethost4.com/