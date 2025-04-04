<?php

class Database {

    private $host = "undcemmysql.mysql.database.azure.com"; 
    private $username = "logan_elick";
    private $password = "logan7349";
    private $database = "logan_elick";
    
    public $conn;
   
    public function __construct(){
        $this->conn = mysqli_init();

        mysqli_ssl_set( $this->conn, NULL, NULL, "DigiCertGlobalRootCA.crt.pem", NULL, NULL );

        if (!mysqli_real_connect($this->conn, $this->host, $this->username, $this->password, $this->database, 3306)){
            die("Connection failed: " . mysqli_connect_error()); 
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
