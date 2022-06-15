<?php

class DB_Display_LP {
    private $conn;
    function __construct() {

    }    // destructor
    function __destruct() {
    }

//display all Leads info in the leads table 
function Leads_Display($LPID){
    require_once 'db_manage.php';
    $db1 = new DB_manage();
    $LP=$db1->get_LPbyID($LPID);
    $LPTable=$LP[10];
    $DomainID=$LP[3];
    require_once 'db_connect_lp.php';
    $db = new Db_Connect_LP();
    $this->conn = $db->connect_LP($DomainID);
            $stmt = $this->conn->prepare('SELECT * FROM '.$LPTable.' WHERE LandingpageID='.$LPID.'');
            $result = $stmt->execute();
            if ($result) {                
                $users = $stmt->get_result()->fetch_all();
                $json_data=json_encode($users);    
                file_put_contents('../assets/js/leadsresult.json', $json_data);  
                    $stmt->close(); 
            } else {     
                die("fetch failed: " .$stmt->error); 
                $stmt->close();
                 }
                }
            }

                ?>