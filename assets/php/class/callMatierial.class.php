<?php 
include 'DB.php';

class Matiereal Extends DatabaseConnectionPDO{
    function __construct($host,$user,$db,$pwd,$type) {
        parent::__construct($host,$user,$db,$pwd,$type);
        
    }

    function Products($term){
    $term = '%'.$term.'%';
    $select = "SELECT * FROM `Products` WHERE productName LIKE :prd_name";
    $param = [':prd_name'=>$term];
    
    return $stmt = $this->init($select,$param);
    }
  
    
}

