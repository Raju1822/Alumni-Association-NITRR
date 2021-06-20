<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Pending Users | Admin Panel</title>
  
  <?php include_once(__DIR__.'/../includes/css.php') ?>  

</head>
<body class="site-navbar-small ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include_once(__DIR__.'/../includes/header.php'); ?>
  <!-- Page -->
  <div class="page animsition">
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-head">
          <h2 class="panel-title">Pending User Verifications</h2>
        </div>

        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="exampleTableTools">
            <thead>
              <tr>
                <th class="text-center">User Id</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Batch</th>
                <th class="text-center">Branch</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">User Id</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Batch</th>
                <th class="text-center">Branch</th>
                <th class="text-center">Action</th>
              </tr>
            </tfoot>
            <tbody>
              <?php foreach ($pending_users as $pending_user) { ?>            
            <tr>
              <td class="text-center"><?php echo $pending_user->user_id ?></td>
              <td><a href="<?=base_url()?>viewprofile/user/<?php echo $pending_user->user_id ?>"><?php echo $pending_user->name ?></a></td>
              <td class="text-center" <?php if(!$pending_user->email_verification_status){echo "style='background-color:#FF8E8E;'";} ?>><?php echo $pending_user->email ?></td>
              <td class="text-center"><?php echo $pending_user->passing_year ?></td>
              <td class="text-center"><?php echo $pending_user->branch ?></td>
              <td class="text-center" id="approve_<?php echo $pending_user->user_id; ?>">
                <a onclick="approve_user('<?=base_url()?>admin/verifyuser/<?php echo $pending_user->user_id; ?>/approve', '<?php echo $pending_user->user_id; ?>')" class="btn btn-success btn-sm">Apporve</a>
                <a onclick="decline_user('<?=base_url()?>admin/verifyuser/<?php echo $pending_user->user_id; ?>/decline', '<?php echo $pending_user->user_id; ?>')" class="btn btn-danger btn-sm">Decline</a>
              </td>
            </tr>
          <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <script>
    function approve_user(url, user_id){
      $.get( 
        url, 
        function(data) {
            if (data) {
              $('#approve_'+user_id).html('Apporved!');
            }else{
              alert("Verification Falied!");
            }   
      });
    }

    function decline_user(url, user_id){
      $.get( 
        url, 
        function(data) {
            if (data) {
              $('#approve_'+user_id).html('Declined!');
            }else{
              alert("Rejection Falied!");
            }
            
      });
    }
  </script>

  <?php include_once(__DIR__.'/../includes/footer.php') ?>  
