<?php
class DB
{
    private $dbh;
    private $stmt;
    public function __construct($host = "27.254.81.223", $user = "ktsoft", $pass = "ktsoft", $database = "WAT")
    {
        try {
            $this->dbh = new PDO("sqlsrv:server=$host ; Database = $database", $user, $pass);
        } catch (PDOException $e) {
            die('DB Error');
        }
    }
    function Query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
        $this->stmt->execute();
        if ($this->stmt !== false) {
            return 0;
        } else {
            return 1;
        }
    }
    function QueryParam($query,$param)
    {
        $this->stmt = $this->dbh->prepare($query);
        for($i=0;$i<count($param);$i++){
            $this->stmt->bindParam($i+1,$param[$i][1], $param[$i][1]=='i'?PDO::PARAM_INT:PDO::PARAM_STR);
        }
        $this->stmt->execute();
        if ($this->stmt !== false) {
            return 0;
        } else {
            return 1;
        }
    }
    function Read()
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    function __destruct(){
        $this->Close();
    }
    function Close()
    {
        $this->dbh = null;
    }
}
