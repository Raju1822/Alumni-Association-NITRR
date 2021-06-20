<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Search Users | Admin Panel</title>
  
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
          <h2 class="panel-title text-center">Search</h2>
        </div>
        <div class="panel-body container">
          <div class="form-group form-material">
            <label class="control-label">Name: </label>
            <div class="">
              <input type="text" class="form-control" id="name" autocomplete="off">
            </div>
          </div>
          <div class="form-group form-material">

            <label class="control-label">Batch: </label>
            <select name="" id="batch" class="form-control">
                <option value="">Select</option>
              <script>
                var myDate = new Date();
                var year = myDate.getFullYear();
                for(var i = year + 4; i > 1956; i--){
                  document.write('<option value="'+i+'">'+i+'</option>');
                }
              </script>
            </select>    
          </div>
          <div class="form-group form-material">
              <label class="control-label">Batch: </label>
              <select name="" id="branch" class="form-control">
                <option value="">Select</option>
                <option value="1">Metallurgical Engineering</option>
                <option value="2">Mining Engineering</option>
                <option value="3">Civil Engineering</option>
                <option value="4">Mechanical Engineering</option>
                <option value="5">Electrical Engineering</option>
                <option value="6">Chemical Engineering</option>
                <option value="8">Electronics and Telecom Engineering</option>
                <option value="9">Information Technology</option>
                <option value="10">Computer Science and Engineering</option>
                <option value="11">Bio Medical Engineering</option>
                <option value="12">Bio Technology</option>
              </select>
            </div>

          <div class="form-group form-material text-center">
            <button class="btn btn-primary" onclick="search(event)">Search</button>
          </div>
        </div>
      </div>
      <div class="panel">
        <div class="panel-head">
          <h2 class="panel-title text-center">Search Results</h2>
        </div>

        <div class="panel-body" id="search-wrapper">
          
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <script>
    
    

    function search(event) {
      $('#search-wrapper').html("<p class='text-center'>Please Wait..</p>");
      event.preventDefault();
      var name = $('#name').val(),
      batch = $('#batch').val(),
      branch = $('#branch').val(),
      postdata = {
        'name' : name,
        'batch': batch,
        'branch': branch
      };

      url = "<?php echo base_url(); ?>Admin/users_getSearchResults";
      $.post(
        url,
        postdata, 
        function(data) {
            if (data) {
              $('#search-wrapper').empty().html(data);
              initialize_table();
            }
      });
    }

    function initialize_table() {
      // Reinitialize table
          var defaults = $.components.getDefaults("dataTable");

          var options = $.extend(true, {}, defaults, {
            "aoColumnDefs": [{
              'bSortable': false,
              'aTargets': [-1]
            }],
            "iDisplayLength": 100,
            "aLengthMenu": [
              [5, 10, 25, 50, -1],
              [5, 10, 25, 50, "All"]
            ],
            "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
            "oTableTools": {
              "sSwfPath": "../../../global/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf"
            }
          });

          $('#exampleTableTools3').dataTable(options); 
    }
    

  </script>
              
  <?php include_once(__DIR__.'/../includes/footer.php') ?>  
