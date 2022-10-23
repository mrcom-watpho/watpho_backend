<?php

date_default_timezone_set("Asia/Bangkok");

class DB{
	var $con;
	var $link;
	var $host = "localhost";
	var $user = "";
	var $pass = "";
	var $dbname = "WAT"; 
	
	// Function Connect Database
	function DB($dbname='',$host='',$user='',$pass=''){
		if($dbname!=''){
		$this->dbname=$dbname;
		}
		if($host!=''){
		$this->host=$host;
		}
		if($user!=''){
		$this->user=$user;
		}
		if($pass!=''){
		$this->host=$pass;
		}
		//DBcon::$dbname = $name;

		$serverName = "localhost"; //serverName\instanceName
		$connectionInfo = array( "Database"=>"WAT", "UID"=>"", "PWD"=>"", "CharacterSet" => "UTF-8");
		//$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		$this->con = sqlsrv_connect( $serverName, $connectionInfo);
		//sqlsrv_connect($this->host,$this->user,$this->pass);
		if($this->con == 0){
			$this->Error[]="Connect ERROR";
			return "Connect ERROR";
		}else{
			
			//sqlsrv_query($this->dbname,"SET NAMES UTF8");
			//sqlsrv_select_db($this->dbname,$this->con);
			return "Connect ERROR";
		}
	}
	
	// Function Execute Query
	function Execute($strSQL){
		$this->link = sqlsrv_query($this->con,$strSQL);
		
		if($this->link==0){
			$this->Error[]="Query Error";
			return sqlsrv_errors();
		}else{
			return 1;
		}
	}

	function Begin(){
		if(sqlsrv_begin_transaction($this->con) === false ) {
     			$this->Error[]=sqlsrv_errors();
			return 0;
		}
	}

	function NextResult(){
		return sqlsrv_next_result($this->link);
	}

	function Commit(){
		if($this->link) {
     			sqlsrv_commit($this->con);
     			return 1;
		}else{
			return 0;
		}
	}

	function Roll(){
		sqlsrv_rollback($this->con);
		$this->Error[]=sqlsrv_errors();
		return 0;
	}
	
	// Function GetData Query
	function getData(){
			$rows = sqlsrv_fetch_array($this->link);
			return $rows;
	}

	function getRowsData($table, $sql_where){
	    $sql_rows_count = " SELECT count(*) as cc FROM $table WHERE $sql_where ";
		$data = sqlsrv_query($this->con,$sql_rows_count);
		$rows = sqlsrv_fetch_array($data);
		$rows_count = $rows['cc'];
		return $rows_count;
	}
		
	// GET NUM ROW
	function getNum(){
		try{
			$num = sqlsrv_num_rows($this->link);
			return $num;
		}catch (Exception $e){
			return 0;	
		}
	}
	
	// Function Disconnect
	function Disconnect(){
		sqlsrv_close($this->con);
	}



	
}
?>