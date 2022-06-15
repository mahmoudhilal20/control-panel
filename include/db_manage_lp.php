<?php
class DB_manage_LP {
    private $conn;
    function __construct($DomainID) {
        require_once 'db_connect_lp.php';
        $db = new DB_Connect_LP();
        $this->conn = $db->connect_LP($DomainID);
    }   
    function Create_LeadTable($DBTable){
        $stmt = $this->conn->prepare('CREATE TABLE '.$DBTable.' ( LeadID INT NOT NULL AUTO_INCREMENT , FullName VARCHAR(30) NOT NULL , Email VARCHAR(100) , Countrycode INT NOT NULL , Country VARCHAR(50) NOT NULL , phoneNumber INT NOT NULL , Age INT NOT NULL , DateCreated DATE NOT NULL , Status VARCHAR(30) NOT NULL , LandingpageID INT NOT NULL, PRIMARY KEY (LeadID));');
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function Add_Lead($LeadName,$Email,$Code,$PhoneNumber,$Country,$Age,$LPID){

        $db = new DB_manage();
        $LP=$db->get_LPbyID($LPID);
    
        $stmt = $this->conn->prepare("INSERT INTO ".$LP[10]."(FullName, Email, Countrycode, Country,phoneNumber,Age,DateCreated,Status,LandingpageID) VALUES (?,?,?,?,?,?,Now(),'Pending',?)");
        $stmt->bind_param("ssisiii",$LeadName,$Email,$Code,$Country,$PhoneNumber,$Age,$LPID);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }

    }
    function RemoveLead($LeadID,$DBTable){

        $stmt = $this->conn->prepare("DELETE FROM ".$DBTable." WHERE LeadID=? ");
        $stmt->bind_param("i", $LeadID);
        $result = $stmt->execute();
        $stmt->close();   
             if ($result) {
            return true;
        } else {
            return false;
        }

    }
    function ChangeStatus($LeadID,$DBTable,$Status){

        $stmt = $this->conn->prepare("Update ".$DBTable." set Status=? WHERE LeadID=? ");
        $stmt->bind_param("si", $Status,$LeadID);
        $result = $stmt->execute();
        $stmt->close();   
             if ($result) {
            return true;
        } else {
            return false;
        }

    }
    function getDonwloadedData($LP,$From,$To,$DBTable){
        $stmt = $this->conn->prepare("SELECT * FROM ".$DBTable." WHERE DateCreated BETWEEN '".$From."' AND '".$To."';");
        $result = $stmt->execute();
        $Data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();   
             if ($result) {
            return $Data;
        } else {
            return NULL;
        }

    }
}