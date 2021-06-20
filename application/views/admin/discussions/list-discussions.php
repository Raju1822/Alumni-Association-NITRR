<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title><?php echo $page_title; ?> | Admin Panel</title>
  
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
          <h2 class="panel-title text-center">All <?php echo $page_title; ?></h2>
        </div>

        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="exampleTableTools">
            <thead>
              <tr>
                <th class="text-center">Id</th>
                <th class="text-center">Title</th>
                <th class="text-center">Date</th>
                <th class="text-center">Created By</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Chapter Id</th>
                <th class="text-center">Chapter Title</th>
                <th class="text-center">Date</th>
                <th class="text-center">Created By</th>
                <th class="text-center">Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <?php foreach ($results as $result) { ?>            
            <tr>
              <td class="text-center"><?php echo $result->discussion_id ?></td>
              <td class="text-center"><?php echo $result->discussion_name ?></td>
              <td class="text-center"><?php echo $result->date?></td>
              <td class="text-center"><?php echo $result->content_posted_by_user_id ?></td>
              <td class="text-center">
                <?php if ($result->status == 0){ ?>
                  <a id="approve_<?php echo $result->discussion_id; ?>" onclick="approve_discussion('<?=base_url()?>admin/verify_discussion/<?php echo $result->discussion_id?>/approve', <?php echo $result->discussion_id?>)" class="btn btn-success btn-sm">Apporve</a>
                <?php }else if($result->status == 1){ ?>
                  <a id="disapprove_<?php echo $result->discussion_id; ?>" onclick="disapprove_discussion('<?=base_url()?>admin/verify_discussion/<?php echo $result->discussion_id?>/disapprove', <?php echo $result->discussion_id?>)" class="btn btn-danger btn-sm">Disapprove</a>
                <?php } ?>

                  <a class="btn btn-primary btn-sm" href="<?=base_url()?>admin/edit_discussion/<?php echo $type_id?>/<?php echo $result->discussion_id?>">Edit</a>
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

  <?php include_once(__DIR__.'/../includes/footer.php') ?>  
  <script>
    
    function approve_discussion(url, content_id){
      $.get( 
        url, 
        function(data) {
            if (data == 1) {
              $('#approve_'+content_id).html('Apporved!');
            }else{
              alert("Verification Falied!");
            }   
      });
    }

    function disapprove_discussion(url, content_id){
      $.get( 
        url, 
        function(data) {
            if (data == 1) {
              $('#disapprove_'+content_id).html('Disapproved!');
            }else{
              alert("Disapproval Failed");
            }
      });
    }
  </script>