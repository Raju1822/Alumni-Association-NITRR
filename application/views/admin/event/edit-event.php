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
          <h2 class="panel-title text-center"><?php echo $page_title; ?></h2>
          

        </div>

        <div class="panel-body container">
          
          <div class="alert alert-success alert-dismissible" id="success" role="alert">
            SUCCESS : Successfully Updated!
          </div>
          <div class="alert alert-danger alert-dismissible"  id="failed" role="alert">
            Error : There were errors!
          </div>
          <?php 
            if ($event) {
              $main_content_id = $event->main_content_id;
              $content_category_id = $event->content_category_id;
              $content_posted_by_user_id = $event->content_posted_by_user_id;
              $main_content_name = $event->main_content_name;
              $content_text = $event->content_text;
              $content_date = $event->content_date;
            }else{
              $main_content_id = null;
              $content_category_id = 3;
              $content_posted_by_user_id = '0';
              $main_content_name = null;
              $content_text = null;
              $content_date = date('Y-m-d');
            }

          ?>
          <div class="form-group form-material">
            <label class="control-label">Title: </label>
            <div class="">
              <input type="hidden" id="article_id" value="<?php echo $main_content_id; ?>">
              <input type="hidden" id="content_category_id" value="<?php echo $content_category_id; ?>">
              <input type="hidden" id="user_id" value="<?php echo $content_posted_by_user_id; ?>">
              <input type="text" class="form-control" id="main_content_name" value="<?php echo $main_content_name; ?>" autocomplete="off">
            </div>
          </div>
          
          <div class="form-group form-material">
            <label class="control-label">Status: </label>
            <select name="" id="status" class="form-control">
              <option value="1" selected="selected">Approve</option>
              <option value="0">Disapprove</option>
            </select>
          </div>

          <div class="form-group form-material">
            <label class="control-label">Post Date: </label>
            <div class="">
              <input type="date" class="form-control" id="content_date" value="<?php echo date("Y-m-d", strtotime($content_date)) ?>">
            </div>
          </div>

          <div class="form-group form-material">
            <label class="control-label">Post Body</label>
            <div class="">
              <div id="summernote"><?php echo $content_text; ?></div>
            </div>
          </div>
          
          <div class="form-group form-material text-center">
            <button class="btn btn-primary" onclick="submitNews()">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        $('#success').hide();
        $('#failed').hide();
    });

    function submitNews(){
      $('#success').hide();
      $('#failed').hide();
      var data = {
        article_id : $('#article_id').val(),
        content_category_id : $('#content_category_id').val(),
        user_id : $('#user_id').val(),
        status : $('#status').val(),
        main_content_name : $('#main_content_name').val(),
        content_date : $('#content_date').val(),
        content: $('#summernote').code()
      };
      $.post("<?php echo base_url() ?>Admin/edit_event_submit", data, function( res ) {
        if (res == 1) {
          $('#failed').hide();
          $('#success').show();
        }else{
          $('#failed').show();
          $('#success').hide();
          
        }
      });
    }

  </script>
  <?php include_once(__DIR__.'/../includes/footer.php') ?> 