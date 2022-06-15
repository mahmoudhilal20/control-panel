<?php 	
class DB_Login {
    private $conn;
    // constructor
    function __construct() {
        require_once 'db_connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }



    //login 
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE UserName = ? OR UserID= ?");
        $stmt->bind_param("ss", $username,$username);
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            // verifying user password
            $UserName=$user['UserName'];
            $UserType=$user['UserType'];

            $EncryptedPassword = $user['EncryptedPassword']; 
            $Salt= $user['Salt'];
            // check for password equality

            $password=$password.$Salt;
            $hashedpassword=hash('sha256',$password);

            if ($EncryptedPassword == $hashedpassword) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }
	
}?>