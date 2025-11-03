<?php 

class ConnectionController{

	private $server = "sql300.infinityfree.com"; 
    private $user = "if0_40304927";              
    private $password = "GIdD1ZpKFq9";    
    private $dbname = "if0_40304927_app_db"; 

	 public function connect()
    {
        $connection = new mysqli($this->server, $this->user, $this->password, $this->dbname);

        if ($connection->connect_error) {
            die("Error de conexión: " . $connection->connect_error);
        } else {
          
        }

        return $connection;
    }

}

?>