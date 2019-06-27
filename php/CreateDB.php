<?php


class CreateDB
{

    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $connectin;


//    clas constructor

    public function __construct(
        $dbname = "PeersDB",
        $tablename = "PhonesTable",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {
        $this ->dbname = $dbname;
        $this ->tablename = $tablename;
        $this ->servername = $servername;
        $this ->username = $username;
        $this ->password = $password;

        //create connection to database
        $this->connectin = mysqli_connect($servername, $username, $password);

        //check if connection to DB was successful
        if (!$this->connectin){
            die("Connection to DB failed: ".mysqli_connect_error());
        }

        //but if connection was successful, then we go ahead and creat our DB

        //query
        $sql = "CREATE DATABASE IF NOT EXIST $dbname";

        //Now if we have a valid connection and a valid statement, then we can execute our query
        if (mysqli_query($this->connectin, $sql)){

        //After creating DB we can access it
            $this->connectin = mysqli_connect($servername, $username, $password, $dbname);

        //Now that we are connected to the database we can start working in it.

        //SQL Statement to create new table in DB
            $sql = "CREATE TABLE IF NOT EXISTS $tablename
                        (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                         product_name VARCHAR(25) NOT NULL,
                         product_price FLOAT,
                         product_image VARCHAR(100)
                         );";

            //Now we execute query
            if (!mysqli_query($this->connectin, $sql)){
                echo "Error creating table: ".mysqli_connect_error($this->connectin);
            }

        }else{
            return false;
        }
    }

}


?>