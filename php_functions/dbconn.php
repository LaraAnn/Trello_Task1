<?php
	class db{

		public function connect()
		{
            
			$this->host = "localhost";
			$this->db = "smartink";
			$this->user = "LaraAnn";
			$this->password = "";

			$this->link = mysql_connect($this->host, $this->user, $this->password);

			mysql_select_db($this->db) or die(mysql_error());
			mysql_query("set names utf8;", $this->link);
            
		}
	}

?>