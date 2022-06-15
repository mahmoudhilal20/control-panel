
<?php
require_once dirname(__FILE__,3).'/pages/include/db_display.php';
//get the file path to know the id of the landing page
$lp=trim(basename(__DIR__));    

//get id of LP



$db = new DB_Display();
$LP=$db->ViewLandingPage($lp);
