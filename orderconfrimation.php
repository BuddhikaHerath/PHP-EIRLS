<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Order Confirmation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <?php include "./import/nav.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Products
        <small>Confirma Recived Orders</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Products</a></li>
        <li class="active">Completed Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Products name </th>
                  <th>Suppliers</th>
                  <th>QTy</th>
                  <th>Order Date</th>
                  <th>State</th>
                  
                  
                </tr>
                </thead>
                <tbody id='table_data'>
               
                </tbody>
                <tfoot>
                <tr>
                <th>Products name </th>
                  <th>Suppliers</th>
                  <th>QTy</th>
                  <th>Order Date</th>
                  <th>State</th>
                  
                
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   

 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src ='./assets/js/ajaxv1.js'></script>
<script>
let NewUser = new App();

$(document).ready(function(){
    load_users();
})



$(document).on('click','.deactivate',function(){
  var user_info = {
    url:'./assets/php/addproducts.php'
    ,type:'POST'
    ,data:{deactivate:1,prd_id:$(this).attr('id')}
    ,callback:load_users}
    
NewUser.AjaxCaller(user_info);
})
$(document).on('click','.activate',function(){
 
  var user_info = {
    url:'./assets/php/addproducts.php'
    ,type:'POST'
    ,data:{pending_orders:1}
    ,callback:load_users}
    
NewUser.AjaxCaller(user_info);
})

$(document).on('click','.order_done',function(){
    

    let order_id = $(this).attr('id');
   
    var user_info = {
      url:'./assets/php/addproducts.php'
      ,type:'POST'
      ,data:{done_order:1,order_id:order_id,prd_id:$(this).attr('prd_id')}
      ,callback:load_users}
      
   NewUser.AjaxCaller(user_info);
   })


function load_users(){
    var user_info = {
    url:'./assets/php/addproducts.php'
    ,type:'POST'
    ,data:{pending_orders:1}
    ,callback:tablefill}
    
NewUser.AjaxCaller(user_info);
}

function tablefill(data){
    $("#table_data").html(data['data_set']);

}

$(document).ready(function(){
  var user_info = {
    url:'./assets/php/addproducts.php'
    ,type:'POST'
    ,data:{triger:1}
    ,callback:function(response){
        console.log(response);
    }}
NewUser.AjaxCaller(user_info);
})

</script>
</body>
</html>
