<?php 
class Config {
    private $host = "localhost";
    private $username = "u437361260_demoapi";
    private $password = "C24X3/3h/";
    private $dbname = "u437361260_demoapi";
    private $connection;

    public function connect() {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function __construct() {
        $this->connect();
    }

    public function insert($name, $age, $phone, $email) {
        $query = "INSERT INTO users (name, age, phone, email) VALUES('$name', '$age', '$phone', '$email')";
        $res = mysqli_query($this->connection, $query);

        if (!$res) {
            return mysqli_error($this->connection); // Return error if query fails
        }

        return $res;
    }

    public function getRecord() {
        $query = "SELECT * FROM users";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function deleteData($id) {
        $query = "DELETE FROM users WHERE id = '$id'";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

    public function updateData($id, $name, $age, $phone) {
        $query = "UPDATE users SET name='$name', age='$age', phone='$phone' WHERE id='$id'";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }
}
?>
