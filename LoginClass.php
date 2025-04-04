<?php 

class LoginClass {

    private $name;
    private $database;
    public $signInResult = 0;
    public $signUpResult = 0;

    public function __construct($act, $name, $database){
        $this->name = $name;
        $this->database = $database;
        
        if ($act == "signIn"){
            $returnValue = $this->signIn();
            $this->signInResult = $returnValue;
        }
        if ($act == "signUp"){
            $returnValue = $this->signUp();
            $this->signUpResult = $returnValue;
        }

    }

    public function signIn(){
        $result = $this->checkUser();
        if ($result == 1){
            return 1;
        } 
        return 0;
    }

    public function signUp(){
        $result = $this->checkUser();
        if ($result == 1){
            return 2;
        } else {
            $sql = "INSERT INTO `logan_elick`.`customer`(`name`, `total_spent`) VALUES ('$this->name', 0)";
            $this->database->conn->query($sql);
            return 1;
        }
  
        return 0;
    }

    public function checkUser(){
        $sql = "SELECT * FROM customer WHERE name = '$this->name'";

        $result = $this->database->conn->query($sql);

        if ($result->num_rows > 0) {
            return 1;
        }

        return 0;
    }
}