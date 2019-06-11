<?php 
include 'DB.php';
class products Extends DatabaseConnectionPDO{
    function __construct($host,$user,$db,$pwd,$type) {
        parent::__construct($host,$user,$db,$pwd,$type);
        
    }


  function addproducts($sup_id,$prd_name,$buy,$sell,$qty){
      $insert = "INSERT INTO `products` (`prd_id`, `sup_id`, `prd_name`, `sell`, `buy`, `state`) VALUES (NULL,:sup_id,:prd_name,:sell,:buy,1)";
      $param =[':sup_id'=>$sup_id,':prd_name'=>$prd_name,':sell'=>$sell,':buy'=>$buy];
      $this->init($insert,$param);
      $id = $this->lastInsertId();
      return $this->qty($id,$qty);
    
  }
  function qty($id,$qty){
      $insert = "INSERT INTO `prd_qty` (`prd_id`, `qty`) VALUES (:prd_id,:qty)";
      $param = [':prd_id'=>$id,':qty'=>$qty];
      return $this->init($insert,$param);
  }

  function view_porducts(){
      $select = "SELECT products.*,prd_qty.*,supplier.sup_name,supplier.sup_id FROM products INNER JOIN prd_qty ON products.prd_id = prd_qty.prd_id INNER JOIN supplier ON supplier.sup_id = products.sup_id";
      return $this->init($select);   
  }

  function deactivate($prd_id){
      $update = "UPDATE `products` SET `state` = '0' WHERE `products`.`prd_id` =:prd_id;";
      $param = [':prd_id'=>$prd_id];
      return $this->init($update,$param);
  }

  function activate($prd_id){
    $update = "UPDATE `products` SET `state` = '1' WHERE `products`.`prd_id` =:prd_id;";
    $param = [':prd_id'=>$prd_id];
    return $this->init($update,$param);
}

function updateQTY($prd_id,$qty){
    $update= "UPDATE `prd_qty` SET `qty` = qty+:qty WHERE `prd_qty`.`prd_id` = :prd_id";
    $param = [':qty'=>$qty,':prd_id'=>$prd_id];
    return $this->init($update,$param);

}
function makeasorder($prd_id,$sup_id,$qty){
    
    $insert = "INSERT INTO `made_order` (`ord_id`, `prd_id`, `sup_id`, `qty`, `date`, `state`) VALUES (NULL,:prd_id,:sup_id,:qty, CURRENT_TIMESTAMP,1)";
    $param = [':prd_id'=>$prd_id,':sup_id'=>$sup_id,':qty'=>$qty];
   
    if($this->init($insert,$param)){
       return $this->update_order_state($prd_id,2);
    }
}
 

function update_order_state($prd_id,$state){
    $update = "UPDATE `products` SET `ord_q` = :ord_q WHERE `products`.`prd_id` = :prd_id;";
    $param = [':ord_q'=>$state,':prd_id'=>$prd_id];
    return $this->init($update,$param);
}

function pending_orders(){
    $get_all_pending= "SELECT made_order.*,products.prd_name,supplier.sup_name FROM made_order INNER JOIN products ON products.prd_id = made_order.prd_id INNER JOIN supplier ON supplier.sup_id = made_order.sup_id ";
    return $this->init($get_all_pending);
}

function done_order($order_id,$prd_id){
    $update = "UPDATE `made_order` SET `state` = '0' WHERE `made_order`.`ord_id` = :order_id";
    $param= [':order_id'=>$order_id];
    if($this->init($update,$param)){
       return $this->update_order_state($prd_id,1);
    }

}

function supplier_orderset(){
    $select = "SELECT * FROM made_order WHERE state = 1";
    return $this->init($select);
}

function allprodcuts($term){
    $select = "SELECT products.*,prd_qty.qty FROM products INNER JOIN prd_qty ON prd_qty.prd_id = products.prd_id WHERE products.prd_name LIKE :term";
    $param = [':term'=>'%'.$term.'%'];
    return $this->init($select,$param);
}


function triger(){
    $select = "SELECT products.*,prd_qty.qty FROM products INNER JOIN prd_qty ON prd_qty.prd_id = products.prd_id";
    $stmt = $this->init($select);
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($rows['qty'] < 6000 && $rows['ord_q']==1){
            $this->makeasorder($rows['prd_id'],$rows['sup_id'],4000);

        }
    }
    return 1;
}
}

