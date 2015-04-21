<?php
/*
 Name: new_client.php
 Description: creates a new client based off the user-entered information
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client name (string), start date (date), first name (string), last name (string), phone (string), email (string), address (string), city (string), state (dropdown)
 Output: text stating that the new client was created
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated client reports
*/

require_once(__DIR__.'/../include.php');

session_start();

open_html("New Client");

echo '<h1>New Client</h1>';

newClientForm($_SESSION['Developer']);

close_html();
?>