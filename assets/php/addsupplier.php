<?php 
include './class/addsupplier.class.php';
$data = parse_ini_file("./class/.database.ini");
$supplier= new Order($data['host'],$data['user'],$data['db'],$data['pwd'],$data['MYSQL_ATTR_INIT_COMMAND']);

if(isset($_POST['sup_name']) && isset($_POST['address']) && isset($_POST['phone'])){
    $success = $supplier->add_suppliers($_POST['sup_name'],$_POST['address'],$_POST['phone']);
    if($success ==1){
        $confirm = array('state'=>1,"message_header"=>'Done','message_body'=>'Added success','active'=>1);
              $json = json_encode($confirm);//JSON Clearance
              echo $json;
  }
}
if(isset($_POST['get_suppliers'])){
    $stmt =$supplier->view_suppliers();
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($rows['state']==1){
            $tbl .="<tr>
            <td>".$rows['sup_id']."</td>
            <td>".$rows['sup_name']."</td>
            <td>".$rows['address']."</td>
            <td>".$rows['phone']."</td>
            <td><button class='btn btn-success deactivate' id='".$rows['sup_id']."'>Active</button></td>
        
        </tr>";
        }else{
            $tbl .="<tr>
            <td>".$rows['sup_id']."</td>
            <td>".$rows['sup_name']."</td>
            <td>".$rows['address']."</td>
            <td>".$rows['phone']."</td>
            <td><button class='btn btn-danger activate' id='".$rows['sup_id']."'>Deactive</button></td>
        
        </tr>";
        }
    }
    $my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
    echo json_encode($my_detail);
}
if(isset($_POST['optiongetsup'])){
    $stmt =$supplier->view_suppliers();
    $tbl = "";
    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
        if($rows['state']==1){
            $tbl .="
            <option value='".$rows['sup_id']."'>".$rows['sup_name']."</option>";
          
        }
    }
    $my_detail = array('state'=>999,'data_set'=>$tbl,'active'=>1);
    echo json_encode($my_detail);
}

if(isset($_POST['deactivate']) && isset($_POST['sup_id'])){
    
   $id =  $supplier->deactivate($_POST['sup_id']);
   if($id ==1){
    $my_detail = array('state'=>999,"message_header"=>'Done','message_body'=>'Done success','active'=>1);
   }else{
   $my_detail = array('state'=>499,'data_set'=>$tbl,'active'=>1);

   }
    echo json_encode($my_detail);

}

if(isset($_POST['activate']) && isset($_POST['sup_id'])){
  
    $id =  $supplier->activate($_POST['sup_id']);
    if($id ==1){
        $my_detail = array('state'=>999,"message_header"=>'Done','message_body'=>'Done success','active'=>1);
    
    }else{
    $my_detail = array('state'=>499,'data_set'=>$tbl,'active'=>1);
 
    }
     echo json_encode($my_detail);
 
 }
?>