<?php 

// Database Connection

class Model {
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'php_oop';
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        if($this->conn->connect_error){
            echo'Connection Failed';
        } else {
          return $this->conn;
        } 
    } //constructor close

    // For InsertRecord

    public  function insertRecord($post)
    {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $sql = "INSERT INTO user(name,email)VALUES('$name','$email')";
        $result = $this->conn->query($sql);

        if($result){
            header('location:index.php?msg=insert');
        } else {
            echo "Error ".$sql."<br>".$this->conn->error;
        }


    }

    // For Update Record
    public  function updateRecord($post)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $editid = $_POST['eid'];

        $sql = "UPDATE user SET name='$name', email='$email' WHERE id = '$editid'; ";
        $result = $this->conn->query($sql);

        if($result){
            header('location:index.php?msg=update');
        } else {
            echo "Error ".$sql."<br>".$this->conn->error;
        }
    }

    public  function deleteRecord($delid)
    {
     
        $sql = "DELETE FROM user WHERE id = '$delid'";
        $result = $this->conn->query($sql);

        if($result){
            header('location:index.php?msg=delete');
        } else {
            echo "Error ".$sql."<br>".$this->conn->error;
        }
    }

     public function displayRecord()
    {
       $sql = "SELECT * FROM user";
       $result = $this->conn->query($sql);
       if($result->num_rows>-0){
           while($row = $result->fetch_assoc()){
            $data[] = $row;   
           }
           return $data;
       }

    }

    public  function displayRecordById($editid)
    {
        $sql = "SELECT * FROM user WHERE id = '$editid'";
        $result = $this->conn->query($sql);
        if($result->num_rows==1){
            $row = $result->fetch_assoc();
            return $row;
        }
    }





} // class close


?>