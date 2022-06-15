<?php
/**
 * Database config variables
 */


require_once 'db_manage.php';


$db = new DB_manage();
$domain_details=$db->get_domainbyid($DomainID);
$username=$domain_details['UserName'];
$password=$domain_details['Password'];
$DB_name=$domain_details['DBName'];
$host=$domain_details['host'];
define("DB_HOST1", $host);
define("DB_USER1", $username);
define("DB_PASSWORD1", $password);
define("DB_DATABASE1", $DB_name);

?>
