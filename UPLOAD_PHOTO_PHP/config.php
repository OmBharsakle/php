<?php

class Config
{
    private $host = "localhost";
    private $username = "u437361260_demoapi";
    private $password = "C24X3/3h/";
    private $dbname = "u437361260_demoapi";
    private $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);

        if (!$this->connection) {
            die("Database connection failed: " . mysqli_connect_error());
        }
    }

    public function uploadImage($name, $path)
    {
        $name = mysqli_real_escape_string($this->connection, $name);
        $path = mysqli_real_escape_string($this->connection, $path);

        $query = "INSERT INTO `gallery`(`name`, `path`) VALUES('$name','$path')";
        return mysqli_query($this->connection, $query);
    }

    public function fetchImages()
    {
        $query = "SELECT * FROM gallery";
        return mysqli_query($this->connection, $query);
    }

    public function fetchImage($id)
    {
        $id = (int)$id; // Ensure ID is an integer
        $query = "SELECT * FROM gallery WHERE id = $id";
        return mysqli_query($this->connection, $query);
    }

    public function delete($id)
    {
        $image = $this->fetchImage($id);
        $filename = mysqli_fetch_assoc($image);

        if ($filename && file_exists($filename['path'])) {
            if (unlink($filename['path'])) {
                $query = "DELETE FROM gallery WHERE id = $id";
                return mysqli_query($this->connection, $query);
            }
        }
        return false;
    }
}
?>
