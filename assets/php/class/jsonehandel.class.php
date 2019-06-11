<?php 
include 'DB.php';
class Jsonhande Extends DatabaseConnectionPDO{
    function __construct($host,$user,$db,$pwd,$type) {
        parent::__construct($host,$user,$db,$pwd,$type);
        
    }

function insertToorder($ord_id){
    // 0 = done nohthing
    // 1 = reciverved
    // 2 = Order confiremed
    $select = "SELECT * FROM orders WHERE ord_id = :ord_id";
    $param  =[':ord_id'=>$ord_id];
    $stmt = $this->init($select,$param);
    if($stmt->rowCount()==0){
    $insert = "INSERT INTO `orders` (`ord_id`, `date`, `state`) VALUES (:ord_id, CURRENT_TIMESTAMP, '0')";
    $param = [':ord_id'=>$ord_id];
    return $this->init($insert,$param);
    }else{
        return 0;
    }
}
 
function insertITems($items_id,$ord_id,$qty){

    $insert = "INSERT INTO `ordered_items` (`id`, `itemCd`, `qty`, `ord_id`) VALUES (NULL,:itemCd,:qty,:ord_id)";
    $param = [':itemCd'=>$items_id,':qty'=>$qty,':ord_id'=>$ord_id];
    return $this->init($insert,$param);
    }

function get_recived_orders(){
    $select = "SELECT * FROM orders WHERE state = 0";
    return $this->init($select);
}

function get_pending_orders(){
    $select = "SELECT * FROM orders WHERE state = 2";
    return $this->init($select);
}


function get_items($prd_items){
    $select = "SELECT * FROM ordered_items WHERE ord_id = :ord_id";
    $param =[':ord_id'=>$prd_items];
    return $this->init($select,$param);
}

function recerve($order){
    $select = "SELECT * FROM ordered_items WHERE ord_id = :ord_id";
    $param = ['ord_id'=>$order];
    $stmt = $this->init($select,$param);
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        $this->deduct($rows['itemCd'],$rows['qty']);
    }
    return $this->updateORderState($order,2);
    //state 2 = reserved
}

function confirm_order($prd_id){
    
    $select = "UPDATE orders SET state = 1 WHERE ord_id = :ord_id";
    $param = ['ord_id'=>$prd_id];
    return $this->init($select,$param);
}


function cancel($order){
    $select = "SELECT * FROM ordered_items WHERE ord_id = :ord_id";
    $param = ['ord_id'=>$order];
    $stmt = $this->init($select,$param);
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
          $this->add($rows['itemCd'],$rows['qty']);
    }
    return $this->updateORderState($order,3);
    //state 3 = canceled

}
function updateORderState($order_from,$state){
    
    $order = "UPDATE orders SET state = :new_state WHERE ord_id = :ord_id";
    $param = [":new_state"=>$state,'ord_id'=>$order_from];
    return $this->init($order,$param);

}
function deduct($prd_id,$qty){
    $update = "UPDATE `prd_qty` SET `qty` = qty-:qty WHERE `prd_qty`.`prd_id` = :prd_id";
    $param= [':qty'=>$qty,':prd_id'=>$prd_id];
    return $this->init($update,$param);
}
function add($prd_id,$qty){
    $update = "UPDATE `prd_qty` SET `qty` = qty+:qty WHERE `prd_qty`.`prd_id` = :prd_id";
    $param= [':qty'=>$qty,':prd_id'=>$prd_id];
    return $this->init($update,$param);
}
}

 


