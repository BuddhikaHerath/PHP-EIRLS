<?php 
include './class/order.class.php';
$data = parse_ini_file("./class/.database.ini");
$manage_order= new Order($data['host'],$data['user'],$data['db'],$data['pwd'],$data['MYSQL_ATTR_INIT_COMMAND']);

if(isset($_POST['order_id'])){

   
    $stmt =  $manage_order->getOrder($_POST['order_id']);
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
     if($rows['state']==1){
      $tbl .=" <tr>
      <td>".$rows['qty']."</td>
      <td>".$rows['prd_id']."</td>
      <td><select id='return_state' class='form-control'><option value='1'>Return</option><option value='2'>Repair</option><option value='3'>Exchange</option></Select>
      <td><button class='btn btn-success return' order_id = '".$_POST['order_id']."' table_id='".$rows['it_req_id']."'>Return this item</td>
      
    </tr>";
     }else{
      $tbl .=" <tr>
      <td>".$rows['qty']."</td>
      <td>".$rows['prd_id']."</td>
      <td>Returned item</td>
      
    </tr>";
     }
   
  
    }
    $my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
      echo json_encode($my_detail);
  }

  if(isset($_POST['order_id_of']) && isset($_POST['table_id']) && isset($_POST['return_state'])){
    $state = $manage_order->return_items($_POST['order_id_of'],$_POST['table_id'],$_POST['return_state']);
    $my_detail = array('state'=>999,'data_set'=>$state,'active'=>1);
    echo  json_encode($my_detail);
  }

  if(isset($_GET['returned_items'])){
    $stmt =$manage_order->show_returned_items();
    $array = array();
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
      $type = "";
      if($rows['state']==1){
        $type= 'Refund';
      }else if($rows['state']==2){
        $type= 'Repair';
      }else{
        $type ="Exchange";

      }
      array_push($array,[
          "ord_id"=>$rows['ord_id'],
          "table_id"=>$rows['table_id'],
          "return_type"=>$type,
          "date"=>$rows['date']
         
      ]);
    }
    $array = json_encode($array,true);
    echo $array;
  }