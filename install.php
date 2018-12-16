<?php
require "config/db.php";

/*
 * Creates connection with mysql database and if connection is successful
 *  creates new database for quiz app
 * */
$db = new Database();
$connection = $db->getConnection(true);
$sql = file_get_contents("data/init.sql");
$connection->exec($sql);
echo "Successfully created database \"quiz\"!<br>";

/*
 * Creates connection with previously created database and inserts all
 *  necessary tables and data
 * */
$connection = $db->getConnection();
$sql = file_get_contents("data/quiz.sql");
$connection->exec($sql);
echo "Successfully created all tables and inserted the data!<br>";