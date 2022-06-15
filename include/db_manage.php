<?php
class DB_manage {
    private $conn;
    function __construct() {
        require_once 'db_connect.php';
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }    // destructor


    function Add_API(){
        //for later
    }


    //add domain to the database
    function Add_Domain($DomainName,$DomainURL,$UserName,$Password,$DBName,$UserID,$ServerIP,$FTPUserName,$FTPPassword){
        $stmt = $this->conn->prepare("INSERT INTO domains(DomainName, DomainURL,DBName,UserName,Password,UserID,host,ftp_UserName,ftp_UserPassword) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssisss",$DomainName,$DomainURL,$DBName,$UserName,$Password,$UserID,$ServerIP,$FTPUserName,$FTPPassword);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //add backrul to the database
    function Add_BackUrl($BackUrlName,$BackUrlLink){
       
        $stmt = $this->conn->prepare("INSERT INTO backurl( BackUrl_Name, Link) VALUES (?,?)");
        $stmt->bind_param("ss",$BackUrlName,$BackUrlLink);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    // add user to the database
    function Add_User($UserName,$FirstName,$LastName,$UserType,$Password){
        $Salt=rand(10,100);
        $Password=$Password.$Salt;
        $hashedPassword=hash('sha256',$Password);

        $stmt = $this->conn->prepare("INSERT INTO users(UserName, FirstName, LastName,UserType,EncryptedPassword,Salt,CreationDate) VALUES (?,?,?,?,?,?,Now())");
        $stmt->bind_param("ssssss",$UserName,$FirstName,$LastName,$UserType,$hashedPassword,$Salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    // add landing page to the database and create an actual page by copying the template to a specific folder and getting content from database
    function Add_LandingPage($LandingPageName,$LPTitle,$DomainID,$APIID,$BackUrlID,$LandingPageTag,$Content,$LandingPageTemplate,$UserID){
        $stmt = $this->conn->prepare('INSERT INTO landingpages (LPName,LPTitle,DomainID,APID,BackUrl_ID,LP_Tags,LP_Content,LP_Template,UserID) VALUES (?,?,?,?,?,?,?,?,?);');
        $stmt->bind_param("ssiiissii",$LandingPageName,$LPTitle,$DomainID,$APIID,$BackUrlID,$LandingPageTag,$Content,$LandingPageTemplate,$UserID);
        $result = $stmt->execute();
        $last_id = $this->conn->insert_id;
        $stmt->close(); 

        $stmt = $this->conn->prepare("UPDATE landingpages SET db_table='LP".$last_id."' Where LPID='".$last_id."'");
        $result = $stmt->execute();
        $stmt->close(); 


        if ($result) {
         echo "Done";
        } else {
          echo "Error while Creatin landing Page";
        }
        

        
        mkdir("../pages/".$last_id);
         copy("../templates/".$LandingPageTemplate.".php","../pages/".$last_id."/index.php");
         copy("../header.php","../pages/".$last_id."/header.php");


        $stmt = $this->conn->prepare("SELECT * FROM domains where DomainID=?");
        $stmt->bind_param("i",$DomainID);
        $result = $stmt->execute();
if ($result) {     
    $Domain = $stmt->get_result()->fetch_array(MYSQLI_NUM);
    $ftp_user_name=$Domain[8];
    $ftp_user_pass=$Domain[9];
    $ftp_host=$Domain[7];
}



//create file index and header
// create folder in remote server
// copy files 
// create lead table
 
 

$connect_it = ftp_connect( $ftp_host );
 
$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );



ftp_chdir($connect_it, "public_html/pages");

 ftp_pwd($connect_it);



$dir=$last_id;

if (ftp_mkdir($connect_it, $dir))
{
echo "Successfully created folder ".$dir." <br>";
}
else
{
echo "Error while creating folder ".$dir." <br>";
}


$local_file = '../pages/'.$last_id.'/index.php';
$local_file_header = '../pages/'.$last_id.'/header.php';


$remote_file = '/public_html/pages/'.$last_id.'/index.php';
$remote_file_header = '/public_html/pages/'.$last_id.'/header.php';
if ( ftp_put( $connect_it, $remote_file, $local_file, FTP_BINARY ) ) {
    echo " Index Successfully Done <br>";
}
else {
    echo "Index There was a problem\n <br>";
}
 



if ( ftp_put( $connect_it, $remote_file_header, $local_file_header, FTP_BINARY ) ) {
    echo " header Successfully Done";
}
else {
    echo " header: There was a problem\n";
}
 

ftp_close( $connect_it );




        require_once 'db_manage_lp.php';


       $db = new DB_manage_LP($DomainID);
$DBTable="LP".$last_id;
       
        $db->Create_LeadTable($DBTable);
        

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }

    }


    //update the domain info in the database
    function Update_Domain($DomainID,$DomainName,$DomainUrl,$UserName,$Password,$DBName,$ServerIP,$FTPUserName,$FTPPassword){
        $stmt = $this->conn->prepare("UPDATE domains SET DomainName=?,DomainURl=?,DBName=?,UserName=?,Password=?,host=?, ftp_UserName=?, ftp_UserPassword=? WHERE DomainID=?");
        $stmt->bind_param("ssssssssi",$DomainName,$DomainUrl,$DBName,$UserName,$Password,$ServerIP,$FTPUserName,$FTPPassword,$DomainID);
        $result = $stmt->execute();
        $stmt->close();
    
    // check for successful store
    if ($result) {

        return true;
    } else {
        return false;
    }
    }


    // update the bakcurl info in the database
    function Update_BackUrl($BackUrlID,$BackUrlName,$BackURlLink){
        $stmt = $this->conn->prepare("UPDATE backurl SET BackUrl_Name=?,Link=? WHERE BackUrl_ID=?");
        $stmt->bind_param("ssi",$BackUrlName,$BackURlLink,$BackUrlID);
        $result = $stmt->execute();
        $stmt->close();
    
    // check for successful store
    if ($result) {

        return true;
    } else {
        return false;
    }
    }
    
    // update the user info in the database
    function Update_User($UserID,$UserName,$FirstName,$LastName,$UserType){

        $stmt = $this->conn->prepare("UPDATE users SET UserName=?,FirstName=?,LastName=?,UserType=? WHERE UserID=?");
        $stmt->bind_param("ssssi",$UserName,$FirstName,$LastName,$UserType,$UserID);
        $result = $stmt->execute();
        $stmt->close();
    // check for successful store
    if ($result) {
        if($_SESSION['UserID']==$UserID){
        $_SESSION['FirstName']=$FirstName;}
        return true;
    } else {
        return false;
    }
    }    
    
    // update api info in the database
    function Update_API($APIID,$APIName,$APILINK){
        $stmt = $this->conn->prepare("UPDATE api SET APIName=?,APILINK=? WHERE APIID=?");
        $stmt->bind_param("ssi",$APIName,$APILINK,$APIID);
        $result = $stmt->execute();
        $stmt->close();
    
    // check for successful store
    if ($result) {

        return true;
    } else {
        return false;
    }
    
    }

    // update the password of the user in the database 
    function ChangePassword($UserID,$Password){
        $Salt=rand(10,100);
        $Password=$Password.$Salt;
        $hashedPassword=hash('sha256',$Password);
        $stmt = $this->conn->prepare("UPDATE users SET EncryptedPassword=?, Salt=? WHERE UserID=?");
        $stmt->bind_param("sii",$hashedPassword,$Salt,$UserID);
        $result = $stmt->execute();
        $stmt->close();
    
    // check for successful store
    if ($result) {  
        return true;
    } else {
        return false;
    }}

    // update landing page info
       function Update_LandingPage($LandingPageID,$LandingPageName,$LPTitle,$DomainID,$APIID,$BackUrlID,$LandingPageTag,$LandingPageTemplate,$Content){
        $stmt = $this->conn->prepare("UPDATE landingpages SET LPName=?, LPTitle=?, APID=?,BackUrl_ID=?,LP_Tags=?, LP_Content=?, LP_Template=? where LPID=?");
        $stmt->bind_param("ssiissii",$LandingPageName,$LPTitle,$APIID,$BackUrlID,$LandingPageTag,$Content,$LandingPageTemplate,$LandingPageID);
        $result = $stmt->execute();
        $stmt->close(); 
         copy("../templates/".$LandingPageTemplate.".php","../pages/".$LandingPageID."/index.php");
        // check for successful store

        
        $stmt = $this->conn->prepare("SELECT * FROM domains where DomainID=?");
        $stmt->bind_param("i",$DomainID);
        $result = $stmt->execute();
if ($result) {     
    $Domain = $stmt->get_result()->fetch_array(MYSQLI_NUM);
    $ftp_user_name=$Domain[8];
    $ftp_user_pass=$Domain[9];
    $ftp_host=$Domain[7];
}



//create file index and header
// create folder in remote server
// copy files 
// create lead table
 
 

$connect_it = ftp_connect( $ftp_host );
 
$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );



ftp_chdir($connect_it, "public_html/pages");

 ftp_pwd($connect_it);





$local_file = '../pages/'.$LandingPageID.'/index.php';


$remote_file = '/public_html/pages/'.$LandingPageID.'/index.php';
if ( ftp_put( $connect_it, $remote_file, $local_file, FTP_BINARY ) ) {
    echo " Index Successfully Done <br>";
}
else {
    echo "Index There was a problem\n <br>";
}
 



 

ftp_close( $connect_it );

        if ($result) {
            return true;
        } else {
            return false;
        }

    }

    // remove domain from the database
    function Remove_Domain($DomainID){ 
        $stmt = $this->conn->prepare("DELETE FROM domains WHERE DomainID=? ");
        $stmt->bind_param("i", $DomainID);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
        //for later
    }


    // remove API from the database
    function Remove_API($APIID){
         $stmt = $this->conn->prepare("DELETE FROM api WHERE APIID=? ");
        $stmt->bind_param("i", $APIID);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    // remove backurl from the database
    function Remove_BackUrl($BackurlID){     
           $stmt = $this->conn->prepare("DELETE FROM backurl WHERE Backurl_ID=? ");
        $stmt->bind_param("i", $BackurlID);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }

    }


    // remove user from the database
    function Remove_User($UserID){
        $stmt = $this->conn->prepare("DELETE FROM users WHERE UserID=? ");
        $stmt->bind_param("i", $UserID);
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }

    }


    // remove landing page from the database
    function Remove_LandingPage($LPID){
        $stmt = $this->conn->prepare("DELETE FROM landingpages WHERE LPID=? ");
        $stmt->bind_param("i", $LPID);
        $result = $stmt->execute();
        $stmt->close();     
           if ($result) {
            return true;
        } else {
            return false;
        }

    }


    // get domain by id 
public function get_domainbyid($DomainID) {
    $stmt = $this->conn->prepare('SELECT * FROM domains where DomainID=?');
    $stmt->bind_param("i", $DomainID);
    if ($stmt->execute()) {
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $user;
    }else{
        return NULL;
    }
}


//get landing db table to get the connection to get the leads
public function get_LPbyID($LPID) {
    $stmt = $this->conn->prepare("SELECT * FROM landingpages where LPID=?");
    $stmt->bind_param("i", $LPID);
    if ($stmt->execute()) {
        $LP = $stmt->get_result()->fetch_array(MYSQLI_NUM);
        $stmt->close();
        return $LP;
    }else{
        return NULL;
    }
}
public function getDomainID($LPID) {
    $stmt = $this->conn->prepare("SELECT * FROM landingpages where LPID=?");
    $stmt->bind_param("i", $LPID);
    if ($stmt->execute()) {
        $Domain = $stmt->get_result()->fetch_array(MYSQLI_NUM);
        $stmt->close();
        return $Domain;
    }else{
        return NULL;
    }
}	

public function DownloadData($LP,$DomainID,$From,$To,$DBTable) {
    chdir("../DownloadedData");
     getcwd();
    $file_name ="LP".$LP."-".$From."-".$To.".csv";
    $output = fopen($file_name, "w+");

    require_once '../include/db_manage_lp.php';
    $db = new DB_manage_LP($DomainID);
    $Data=$db->getDonwloadedData($LPID,$From,$To,$DBTable);
    
    
    
    fputcsv($output, array('ID','FullName','Email','Country Code','Country','PhoneNumber','Age','Creation Date','Status','LPID'));
    foreach($Data as $row) {
        fputcsv($output, $row);
    }
        fclose($output);
        
    header("location:../DownloadedData/".$file_name);
}
}
?>