<?php 
include './class/addproducts.class.php';
$data = parse_ini_file("./class/.database.ini");
$products= new products($data['host'],$data['user'],$data['db'],$data['pwd'],$data['MYSQL_ATTR_INIT_COMMAND']);

if(isset($_POST['sup']) && isset($_POST['product_name']) && isset($_POST['buy_price']) && isset($_POST['sell_price']) && isset($_POST['qty'])){
   
     $rest = $products->addproducts($_POST['sup'],$_POST['product_name'],$_POST['buy_price'],$_POST['sell_price'],$_POST['qty']);
    if($rest==1){
        $my_detail = array('state'=>1,'message_header'=>'Success','message_body'=>'Data entred');
        echo json_encode($my_detail);
    }else{
        $my_detail = array('state'=>499,'message_header'=>'Not Entered','message_body'=>'Entry not done');
        echo json_encode($my_detail);
    }

    }
if(isset($_POST['get_products'])){
        $stmt =$products->view_porducts();
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($rows['state'] >=1){
            $tbl .="<tr>
            <td>".$rows['prd_id']."</td>
            <td>".$rows['prd_name']."</td>
            <td>".$rows['buy']."</td>
            <td>".$rows['sell']."</td>
            <td>".$rows['qty']."</td>
            <td><input type='number'  value='0' id='qty_".$rows['prd_id']."'></td>
            <td><button class='btn btn-success update' id='".$rows['prd_id']."'>Update</button></td>
            <td><button class='btn btn-warning deactivate' id='".$rows['prd_id']."'>Deactivate</button></td>
        
        </tr>";
        }else if($rows['state']==0){
            $tbl .="<tr>
            <td>".$rows['prd_id']."</td>
            <td>".$rows['prd_name']."</td>
            <td>".$rows['buy']."</td>
            <td>".$rows['sell']."</td>
            <td>".$rows['qty']."</td>
            <td>Not Active</td>
            <td><button class='btn btn-danger activate' id='".$rows['prd_id']."'>Deactivate</button></td>
        
        </tr>";
        }

    }
    $my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
    echo json_encode($my_detail);
}

if(isset($_POST['deactivate']) && isset($_POST['prd_id'])){
     $id = $products->deactivate($_POST['prd_id']);
    if($id==1){
        $my_detail = array('state'=>999,'message_header'=>'Success','message_body'=>'Deactivated','active'=>1);
        echo json_encode($my_detail);
    }else{
        $my_detail = array('state'=>499,'message_header'=>'went wrong','message_body'=>'Somthing Went Wrong');
        echo json_encode($my_detail);   
    }
}

if(isset($_POST['activate']) && isset($_POST['prd_id'])){
    $id = $products->activate($_POST['prd_id']);
    if($id==1){
        $my_detail = array('state'=>999,'message_header'=>'Success','message_body'=>'Activated','active'=>1);
        echo json_encode($my_detail);
    }else{
        $my_detail = array('state'=>499,'message_header'=>'went wrong','message_body'=>'Somthing Went Wrong');
        echo json_encode($my_detail);   
    }
}

if(isset($_POST['update']) && isset($_POST['qty']) && isset($_POST['prd_id'])){
 
 if($products->updateQTY($_POST['prd_id'],$_POST['qty'])){
    $my_detail = array('state'=>999,'message_header'=>'Success','message_body'=>'Activated','active'=>1);
    echo json_encode($my_detail);
 }
}

if(isset($_POST['fororders'])){
    $stmt =$products->view_porducts();
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        
          if($rows['ord_q']==1){
            $tbl .="<tr>
            <td>".$rows['prd_id']."</td>
            <td>".$rows['prd_name']."</td>
            <td>".$rows['sup_name']."</td>
            <td>".$rows['buy']."</td>
            <td>".$rows['sell']."</td>
            <td>".$rows['qty']."</td>
            <td><input type='number' id='qty_".$rows['prd_id']."'></td>
            <td><button class='btn btn-warning order' sup_id = '".$rows['sup_id']."' id='".$rows['prd_id']."'>Make orders</button></td>
        
        </tr>";
          }else{
            $tbl .="<tr>
            <td>".$rows['prd_id']."</td>
            <td>".$rows['prd_name']."</td>
            <td>".$rows['sup_name']."</td>
            <td>".$rows['buy']."</td>
            <td>".$rows['sell']."</td>
            <td>".$rows['qty']."</td>
            <td>Ordered</td>
            <td>Ordered</td>
        
        </tr>";
          }
        
    }
    $my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
    echo json_encode($my_detail);
}
if(isset($_POST['order']) && isset($_POST['prd_id']) && isset($_POST['qty']) && isset($_POST['sup'])){

 $stmt =$products->makeasorder($_POST['prd_id'],$_POST['sup'],$_POST['qty']); 
 if($stmt==1){
    $my_detail = array('state'=>999,'data_set'=>'1','active'=>1);
    echo json_encode($my_detail);
 }  
}
if(isset($_POST['pending_orders'])){
    $stmt = $products->pending_orders();
    $tbl = '';
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($rows['state']==0){
            $tbl .="<tr>
            <td>".$rows['prd_name']."</td>
            <td>".$rows['sup_name']."</td>
            <td>".$rows['qty']."</td>
            <td>".$rows['date']."</td>
            <td>Completed</td>
        </tr>";
          }else{
            $tbl .="<tr>
            <td>".$rows['prd_name']."</td>
            <td>".$rows['sup_name']."</td>
            <td>".$rows['qty']."</td>
            <td>".$rows['date']."</td>
            <td><button class='btn btn-success order_done' prd_id = '".$rows['prd_id']."' id='".$rows['ord_id']."'>Order done</button></td>
        
        </tr>";
          }   
    }
    $my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
    echo json_encode($my_detail);
}

if(isset($_POST['done_order']) && isset($_POST['order_id'])){
    $stmt = $products->done_order($_POST['order_id'],$_POST['prd_id']);
    if($stmt==1){
        $my_detail = array('state'=>999,'data_set'=>'1','active'=>1);
        echo json_encode($my_detail);
     }  
}

if(isset($_GET['give_supplier_orders'])){
    $stmt = $products->supplier_orderset();
    $array = array();
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
         
        array_push($array,[
            "id" => $rows['prd_id'],
            "request_qty"=>$rows['qty'],
            "from"=>'MAT'
           
        ]);
      }

      $array = json_encode($array,true);
      echo $array;
}
 
if(isset($_GET['term'])){
    $data = $_GET['term'];
    $qtc = strtok($data, '@');  
    if($qtc == "" || !is_numeric($qtc)){
        $qtc = 1;
    }
    $search = substr($_GET['term'], strpos($data, "@") + 1); 
    $stmt = $products->allprodcuts($search);
    $array = array();
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        $show_name = $rows['prd_name']." - ".$rows['qty'];
        array_push($array,[
            "id" => $rows['prd_id'],
            "label"=>$show_name,
            "text_box"=>$rows['prd_name'],
            "request_qty"=>$qtc,
            "sell"=>$rows['sell'],
            "available"=>$rows['qty']
           
        ]);
      }

      $array = json_encode($array,true);
      echo $array;

}
if(isset($_POST['triger'])){
   echo $state = $products->triger();
}
?>

