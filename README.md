## Setup
1. **Localhost**<br>
  Clone (or download) this repository into your local server's web-accessible directory 
2. **Database**<br>
  First of all you have to change database configuration according to your MySQL databse configuration in ```config/db.php```.<br>
  After that you can run **localhost/install.php** from your browser to generate all necessary tables and initial data.<br>
  <br>**Note!**<br>
  If you already have a database named **quiz** stored in your MySQL database, then change ```$dbname``` in ```config/db.php``` and
  use the same database name in ```data/init.sql```.<br>
  Otherwise **localhost/install.php** will drop your current quiz database and replace it with data from ```data/quiz.sql```.<br>
  <br>**Example:**<br>
  config/db.php
      ```php
      private $host = "hostname";
      private $dbname = "YOUR_DB_NAME";
      private $username = "username";
      private $password = "password";
      ```
    data/init.sql
      ```sql
      DROP DATABASE IF EXISTS `YOUR_DB_NAME`;
      CREATE DATABASE IF NOT EXISTS  `YOUR_DB_NAME`;
      ```
3. **Last step**<br>
  If you have done previous 2 steps then from your browser go to the **localhost/public/index.php** and you should be able to
  choose between 2 tests as in screenshot.
  ![Alt text](https://github.com/RolandsRuja/quiz/blob/master/Screenshot.png "Optional title")
