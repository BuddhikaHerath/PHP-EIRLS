<?php

class DatabaseConnectionPDO{
    private $host = "";
    private $user = "";
    private $db = "";
    private $pwd = "";
    private $query = "";
    private $type = "";
    private $pdo;
    private $state;
    public function __construct($host,$user,$db,$pwd,$type){         
        $this->Connect($host, $db, $user, $pwd,$type);
		$this->parameters = array();
    }
    
		private function Connect($hostname, $database, $username, $password,$type)
		{  
           
			 $dsn = "mysql:host=$hostname;dbname=$database";
			try 
			{
                # Read settings from INI file, set UTF8
                
				$this->pdo = new PDO($dsn,$username,$password, array(PDO::MYSQL_ATTR_INIT_COMMAND => $type));
				# Disable emulation of prepared statements, use REAL prepared statements instead.
				$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
                $this->bConnected = true;
                
			}
			catch (PDOException $e) 
			{
				# Write into log
				echo $e->getMessage();
				die();
			}
		}


        public function CloseConnection()
	 	{
	 		$this->pdo = null;
         }
         


         public function init($query,$param =[]){
             $esc = explode(' ', $query);
            
            if(!$this->bConnected) { $this->Connect(); }
            try{
               if($esc[0] === "SELECT" || $esc[0] === "SHOW"){
                
                $stmt = $this->pdo->prepare($query);
                $stmt->execute($param);
                return $stmt;
               }else if($esc[0]  === 'INSERT' ||  $esc[0]  === 'UPDATE' || $esc[0]  === 'DELETE' ){
                $stmt = $this->pdo->prepare($query);
                return $stmt->execute($param);
                
               }
               
                
            }catch(Exception $e){
                echo $e->getMessage();
            }
         
             
             

         }

         public function lastInsertId() {
			return $this->pdo->lastInsertId();
		}	
        
        


        

}









?>