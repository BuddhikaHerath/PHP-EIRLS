<?php 
include './class/jsonehandel.class.php';
$data = parse_ini_file("./class/.database.ini");
$Jsonhnadel= new Jsonhande($data['host'],$data['user'],$data['db'],$data['pwd'],$data['MYSQL_ATTR_INIT_COMMAND']);

if(isset($_GET['get_orders'])){
    $file = file_get_contents('./orders.json', true);
    $array = json_decode( $file, true );
   foreach($array as $item) { //foreach element in $arr
   if($Jsonhnadel->insertToorder($item['ord_id'])){
    $uses = sizeof($item['products']); //etc
    $c = 0;
    while($c < sizeof($item['products'] ) ){
        $Jsonhnadel->insertITems($item['products'][$c]['prd_id'],$item['products'][$c]['qty'],$item['ord_id']);
        $c++;
    }
   }
  
   } 
   echo "Done Recording";
}

if(isset($_POST['get_recived_orders'])){
    $stmt = $Jsonhnadel->get_recived_orders();
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tbl .="<tr>
           <td>".$rows['ord_id']."</td>
           <td>".$rows['date']."</td>
           <td><button class='btn btn-success seeitems' id ='".$rows['ord_id']."'>See Items</button></td>
         </tr>";
}
$my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
echo json_encode($my_detail);
}

if(isset($_POST['recreved'])){
    $stmt = $Jsonhnadel->get_pending_orders();
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tbl .="<tr>
           <td>".$rows['ord_id']."</td>
           <td>".$rows['date']."</td>
           <td><button class='btn btn-info seeitems' id ='".$rows['ord_id']."'>See Items</button></td>
           <td><button class='btn btn-success confirm' id ='".$rows['ord_id']."'>confirm</button></td>
         </tr>";
}
$my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
echo json_encode($my_detail);
}

if(isset($_POST['selected_id'])){
    $stmt = $Jsonhnadel->get_items($_POST['selected_id']);  
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tbl .="<tr>
           <td>".$rows['itemCd']."</td>
           <td>".$rows['qty']."</td>
                 </tr>";
}
$my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
echo json_encode($my_detail);
}

if(isset($_POST['recervied'])){
   if($stmt = $Jsonhnadel->recerve($_POST['recervied'])){
     $my_detail = array('state'=>999,'data_set'=>'1','active'=>1);
    echo  json_encode($my_detail);
   }

}

if(isset($_POST['cancel'])){
    if($stmt = $Jsonhnadel->cancel($_POST['cancel'])){
         $my_detail = array('state'=>999,'data_set'=>'1','active'=>1);
        echo  json_encode($my_detail);
    }
 
 }

 if(isset($_POST['confirm'])){
     
    if($stmt = $Jsonhnadel->confirm_order($_POST['confirm'])){
         $my_detail = array('state'=>999,'data_set'=>'1','active'=>1);
        echo  json_encode($my_detail);
    }
 
 }
?>

