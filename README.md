# Follow-Up-Tracker
A follow-up tracker for all employees of an organization through which employees can assign tasks for fellow employees.

This project is made using HTML+CSS, PHP and SQL languages and the Database Server used for holding the records is MySQL.

# Pre-Requisite
1. Apache Server
2. MySQL Server
3. phpMyAdmin

**You can install XAMPP Control Panel and select these options while installing**

# Steps
1. Install the pre-requisites
2. Copy the Project files in the directory **"C:/xampp/htdocs/MyProject"** folder
3. Edit the files **"CONNECTION.php"** and **"PHP/Necessary Initially.php"** to change the MySQL user and password (root:123456 by default).
4. Open XAMPP and Start "Apache" and "MySQL".
5. Open up any Browser and go to **"http://localhost/MyProject/PHP/Necessary%20Initially.php"** for the initial Database Setup.
6. Now, go to **"http://localhost/MyProject/phpmyadmin"** (and login if asks) and select database "myproject".
7. Open table **"empmaster"** and insert the values of the employees of the organization (DON'T INSERT THE EMPCODE VALUE AS IT IS AUTOMATICALLY UPDATED)
8. With everything set up, you can now open **"http://localhost/MyProject/"**.
