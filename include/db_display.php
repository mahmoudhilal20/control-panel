<?php
class DB_Display {
    private $conn;
    function __construct() {
        require_once 'db_connect.php';
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }  
    
    // destructor
    function __destruct() {
    }


    //get all APIs
    function API_Display(){
    $stmt = $this->conn->prepare("SELECT * FROM api");
        $result = $stmt->execute();
if ($result) {     
    $APIs = $stmt->get_result()->fetch_all();
    $json_data=json_encode($APIs);    
    file_put_contents('../assets/js/apisresult.json', $json_data);  
        $stmt->close();
} else {
    die("fetch failed: " .$stmt->error); 
    $stmt->close();
}
}


//get all Backurls
function BackUrl_Display(){
$stmt = $this->conn->prepare("SELECT * FROM backurl");
$result = $stmt->execute();
if ($result) {            
    $backurls = $stmt->get_result()->fetch_all();
    $json_data=json_encode($backurls);    
    file_put_contents('../assets/js/backurlsresult.json', $json_data);  
        $stmt->close();
} else {
    die("fetch failed: " .$stmt->error); 
    $stmt->close();

}}


//get all Domains
function Domain_Display(){
$stmt = $this->conn->prepare("SELECT * FROM domains");
$result = $stmt->execute();
if ($result) {      
    $Domains = $stmt->get_result()->fetch_all();
    $json_data=json_encode($Domains);    
    file_put_contents('../assets/js/domainsresult.json', $json_data);  
        $stmt->close();
} else {
    die("fetch failed: " .$stmt->error); 
    $stmt->close();
 }}



    //get all landing pages (in the domain)
    function LandingPage_Display($DomainID){       
$stmt = $this->conn->prepare("SELECT landingpages.LPID, landingpages.LPName,landingpages.LPTitle, landingpages.DomainID, api.APIName, backurl.BackUrl_Name, landingpages.LP_Tags, landingpages.LP_Content, landingpages.LP_Template, landingpages.LP_Link, landingpages.db_table, domains.DomainURl from landingpages LEFT JOIN api ON landingpages.APID=api.APIID LEFT JOIN backurl on landingpages.BackUrl_ID=backurl.BackUrl_ID Left JOIN domains on landingpages.DomainID=domains.DomainID WHERE landingpages.DomainID=".$DomainID." ORDER BY landingpages.LPID DESC;");
$result = $stmt->execute();
if ($result) {            
    $landingpages = $stmt->get_result()->fetch_all();
    $json_data=json_encode($landingpages);    
    file_put_contents('../assets/js/landingpagesresult.json', $json_data);  
        $stmt->close();
} else {
    die("fetch failed: " .$stmt->error); 
    $stmt->close();
}}



// get all users
    function User_Display(){
            $stmt = $this->conn->prepare("SELECT UserID,UserName,FirstName,LastName,UserType,CreationDate FROM users");
            $result = $stmt->execute();
            if ($result) {                
                $users = $stmt->get_result()->fetch_all();
                $json_data=json_encode($users);    
                file_put_contents('../assets/js/usersresult.json', $json_data);  
                    $stmt->close(); 
            } else {     
                die("fetch failed: " .$stmt->error); 
                $stmt->close();
                 }
                }


 //get information of landing page and view it
function ViewLandingPage($LPID){
    $stmt = $this->conn->prepare("SELECT * FROM landingpages where LPID=".$LPID."");
    $result = $stmt->execute();
if ($result) {     
    $LP = $stmt->get_result()->fetch_array(MYSQLI_NUM);
    return $LP;
}}


// get apis to view in edit landing pages if the user want to change the api
function Get_APIs(){
    $stmt = $this->conn->prepare("SELECT * FROM api");
    $result = $stmt->execute();
if ($result) {     
    $APIs = $stmt->get_result()->fetch_all();
    return $APIs;
}
}



// get all backurls  to view in edit landing pages if the user want to change the backurl
function Get_BackUrls(){
    $stmt = $this->conn->prepare("SELECT * FROM backurl");
    $result = $stmt->execute();
if ($result) {     
    $backurls = $stmt->get_result()->fetch_all();
    return $backurls;
}
}



// get the selected api in the edit landing page
function Get_SelectedAPI($LPID){
    $stmt = $this->conn->prepare("SELECT APID FROM landingpages where LPID=?");
    $stmt->bind_param("s",$LPID);
    $result = $stmt->execute();
if ($result) {     
    $API = $stmt->get_result()->fetch_all();
    return $API;
}
}



// get the selected bakcurl in the edit landing page
function Get_SelectedBackUrl($LPID){
    $stmt = $this->conn->prepare("SELECT BackUrl_ID FROM landingpages where LPID=?");
    $stmt->bind_param("s",$LPID);
        $result = $stmt->execute();
if ($result) {     
    $BackUrl = $stmt->get_result()->fetch_all();
    return $BackUrl;
}
}}
?>
