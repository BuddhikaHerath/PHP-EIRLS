<?php 
include 'DB.php';
class Order Extends DatabaseConnectionPDO{
    function __construct($host,$user,$db,$pwd,$type) {
        parent::__construct($host,$user,$db,$pwd,$type);
        
    }


   function add_suppliers($supplier_name,$address,$phone){
    $insert = "INSERT INTO `supplier` (`sup_id`, `sup_name`, `address`, `phone`) VALUES (NULL,:sup_name,:address,:phone)";
    $param = [':sup_name'=>$supplier_name,':address'=>$address,':phone'=>$phone];
    $this->init($insert,$param);
    return 1;
   }
   function view_suppliers(){
       $select ="SELECT * FROM supplier";
       return $this->init($select);
   } 

   function activate($sup_id){
       
    $update ="UPDATE `supplier` SET `state` = '1' WHERE `supplier`.`sup_id` = :sup_id";
    $param =[':sup_id'=>$sup_id];
    return $this->init($update,$param);
   }
   function deactivate($sup_id){
    
    $update ="UPDATE `supplier` SET `state` = '0' WHERE `supplier`.`sup_id` = :sup_id";
    $param =[':sup_id'=>$sup_id];
    return $this->init($update,$param);
   }
 

}

