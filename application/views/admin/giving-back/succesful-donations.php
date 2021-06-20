<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Succesful Donations | Admin Panel</title>
  
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
          <h2 class="panel-title">Successful Donations</h2>
        </div>

        <div class="panel-body">
          <table class="table table-hover dataTable table-striped width-full" id="exampleTableTools">
            <thead>
              <tr>
                <th class="text-center">Transaction Id</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Mobile</th>
                <th class="text-center">Passing Year</th>
                <th class="text-center">Branch</th>
                <th class="text-center">Degree</th>
                <th class="text-center">Cause</th>
                <th class="text-center">Address</th>
                <th class="text-center">Whatsapp No</th>
                <th class="text-center">Alumni Meet Plan</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Time</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Transaction Id</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Mobile</th>
                <th class="text-center">Passing Year</th>
                <th class="text-center">Branch</th>
                <th class="text-center">Degree</th>
                <th class="text-center">Cause</th>
                <th class="text-center">Address</th>
                <th class="text-center">Whatsapp No</th>
                <th class="text-center">Alumni Meet Plan</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Time</th>
              </tr>
            </tfoot>
            <tbody>
              <?php foreach ($results as $result) { ?>            
            <tr>
              <td class="text-center"><?php echo $result->transaction_id ?></td>
              <td class="text-center"><?php echo $result->customer_name ?></td>
              <td class="text-center"><?php echo $result->email ?></td>
              <td class="text-center"><?php echo $result->mobile ?></td>
              <td class="text-center"><?php echo $result->passing_year ?></td>
              <td class="text-center"><?php echo $result->branch ?></td>
              <td class="text-center"><?php echo $result->degree ?></td>
              <td class="text-center"><?php echo $result->cause ?></td>
              <td class="text-center"><?php echo $result->address ?></td>
              <td class="text-center"><?php echo $result->whatsapp_no ?></td>
              <td class="text-center"><?php echo $result->meet_plan ?></td>
              <td class="text-center"><?php echo $result->amount ?></td>
              <td class="text-center"><?php echo $result->tspl_txn_time ?></td>
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
