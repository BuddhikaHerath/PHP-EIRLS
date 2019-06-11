<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add new Products</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "./import/nav.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Add new Products</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class='content'>
        <div class="box box-primary">
        <?php include "./import/error.php"; ?>
            <div class="box-header with-border">
              <h3 class="box-title">Add new Supplier</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="user_fname">Select Supplier</label>
                  <select class="form-control" id="sup" name="sup">
                  
                  </select>
                </div>

                <div class="form-group">
                  <label for="user_lname">Products name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="product_name">
                </div>

                <div class="form-group">
                  <label for="phone">Buying price </label>
                  <input type="text" class="form-control" id="buy_price" name="buy_price" placeholder="buy_price">
                </div>

                <div class="form-group">
                  <label for="phone">Selling price </label>
                  <input type="text" class="form-control" id="sell_price " name="sell_price" placeholder="sell_price ">
                </div>

                <div class="form-group">
                  <label for="phone">Qty</label>
                  <input type="text" class="form-control" id="qty " name="qty" placeholder="qty">
                </div>
                

                  <div class="box-footer">
                    <button id='submit' class='btn btn-success'>Add new Products</button>
                </div>
                
              </div>
              <?php include './import/loader.php'; ?>
            </form>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

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
$('form').submit(function(e){
e.preventDefault();

if(NewUser.checkforempty2({value:$("#sup").val(),type:'text',header:'Supplier name',body:'Enter first name'})){
if(NewUser.checkforempty2({value:$("#product_name").val(),type:'text',header:'Product name',body:'Empty prodcut name'})){
if(NewUser.checkforempty2({value:$("#buy_price").val(),type:'price',minimum:0,header:'Value not valide',body:'Please enter valide'})){
var user_info = {url:'./assets/php/addproducts.php',type:'POST',data:$('form').serialize()}
          NewUser.AjaxCaller(user_info);


}
}
} 

});

$(document).ready(function(){
  load_supplier();
})

function load_supplier(){
    var user_info = {
    url:'./assets/php/addsupplier.php'
    ,type:'POST'
    ,data:{optiongetsup:1}
    ,callback:tablefill}
    
NewUser.AjaxCaller(user_info);
}

function tablefill(data){
    $("#sup").html(data['data_set']);

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
