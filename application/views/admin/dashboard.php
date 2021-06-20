<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Dashboard | Admin Panel</title>
  
  <?php include_once('includes/css.php') ?>  

</head>
<body class="site-navbar-small ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <?php include_once('includes/header.php'); ?>
  <!-- Page -->
  <div class="page animsition">
    <div class="page-content container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
        <div class="col-lg-3 col-sm-6">
          <!-- Widget Linearea One-->
          <div class="widget widget-shadow" id="widgetLineareaOne">
            <div class="widget-content">
              <div class="padding-20 padding-top-10">
                <div class="clearfix">
                  <div class="grey-800 pull-left padding-vertical-10">
                    <i class="icon md-shield-check grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>                    Verified Users: 
                  </div>
                  <span class="pull-right grey-700 font-size-30"><?php echo "<b>".$verified_users."</b>" ?></span>
                </div>
                
              </div>
            </div>
          </div>
          <!-- End Widget Linearea One -->
        </div>
        <div class="col-lg-3 col-sm-6">
          <!-- Widget Linearea Two -->
          <div class="widget widget-shadow" id="widgetLineareaTwo">
            <div class="widget-content">
              <div class="padding-20 padding-top-10">
                <div class="clearfix">
                  <div class="grey-800 pull-left padding-vertical-10">
                    <i class="icon md-alert-triangle grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>                    Pending User Verifications
                  </div>
                  <span class="pull-right grey-700 font-size-30"><?php echo "<b>".$pending_users."</b>" ?></span>
                </div>
                
              </div>
            </div>
          </div>
          <!-- End Widget Linearea Two -->
        </div>
        <div class="col-lg-3 col-sm-6">
          <!-- Widget Linearea Three -->
          <div class="widget widget-shadow" id="widgetLineareaThree">
            <div class="widget-content">
              <div class="padding-20 padding-top-10">
                <div class="clearfix">
                  <div class="grey-800 pull-left padding-vertical-10">
                    <i class="icon md-info grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>                    No of Donations
                  </div>
                  <span class="pull-right grey-700 font-size-30"><?php echo "<b>".$no_of_donations."</b>" ?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Widget Linearea Three -->
        </div>
        <div class="col-lg-3 col-sm-6">
          <!-- Widget Linearea Four -->
          <div class="widget widget-shadow" id="widgetLineareaFour">
            <div class="widget-content">
              <div class="padding-20 padding-top-10">
                <div class="clearfix">
                  <div class="grey-800 pull-left padding-vertical-10">
                    <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>                    Donations Recieved (Rs)
                  </div>
                  <span class="pull-right grey-700 font-size-30"><?php echo "<b>".$total_donations."</b>" ?></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Widget Linearea Four -->
        </div>
        <div class="col-lg-3 col-sm-6">
          <!-- Widget Linearea Four -->
          <div class="widget widget-shadow" id="widgetLineareaFour">
            <div class="widget-content">
              <div class="padding-20 padding-top-10">
                <div class="clearfix">
                  <div class="grey-800 pull-left padding-vertical-10">
                    <i class="icon md-view-list grey-600 font-size-24 vertical-align-bottom margin-right-5"></i>                    Export Student Data
                  </div>
                  <span class="pull-right grey-700 font-size-20"><a href="<?=base_url()?>admin/exportUserDataCSV">Export CSV</a></span>
                </div>
              </div>
            </div>
          </div>
          <!-- End Widget Linearea Four -->
        </div>
        <div class="clearfix"></div>        
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  

  <?php include_once('includes/footer.php') ?>  