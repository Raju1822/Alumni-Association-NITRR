<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Edit Users | Admin Panel</title>
  
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
       <!--  <pre>
        <?php var_dump($user) ?>
        </pre> -->
        <?php if($msg){ ?>
        <div class="alert dark alert-icon alert-primary alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i class="icon md-check" aria-hidden="true"></i><?=$msg ?>
        </div>
        <?php } ?>
        <div class="panel-head">
          <h2 class="panel-title text-center">Edit User</h2>
        </div>

        <div class="panel-body container">
          <form action="<?php echo base_url().'Admin/users_edit_validate' ?>" method="POST" class="form-horizontal">
            <?php echo validation_errors() ?>
            <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
            <div class="form-group">
              <label class="control-label col-sm-3">Name: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="name" value="<?= $user->name ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Email: </label>
              <div class="col-sm-9">
                <input type="email" class="form-control" name="email"  value="<?= $user->email ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Gender: </label>
              <div class="col-sm-9">
                <div class="radio-custom radio-default radio-inline">
                  <input type="radio" id="inputHorizontalMale" value="M" name="gender" 
                    <?php if ($user->gender == 'M'): ?>
                      checked
                    <?php endif ?>
                  />
                  <label for="inputHorizontalMale">Male</label>
                </div>
                <div class="radio-custom radio-default radio-inline">
                  <input type="radio" id="inputHorizontalFemale" value="F" name="gender" <?php if ($user->gender == 'F'): ?>
                      checked
                    <?php endif ?>/>
                  <label for="inputHorizontalFemale">Female</label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">DOB: </label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="dob" value="<?= $user->dob ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Phone 1: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ph_number_1" value="<?= $user->ph_number_1 ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Phone 2: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="ph_number_2" value="<?= $user->ph_number_2 ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3">City: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="city"  value="<?= $user->city ?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3">State: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="state"  value="<?= $user->state ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">Country: </label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="country"  value="<?= $user->country?>">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">About Me: </label>
              <div class="col-sm-9">
                <textarea class="form-control" name="about_me" rows="7"><?= $user->about_me ?></textarea>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3">Address: </label>
              <div class="col-sm-9">
                <textarea class="form-control" name="address" rows="7"><?= $user->address ?></textarea>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3">UG Batch: </label>
              <div class="col-sm-9">
                <select name="ug_batch" class="form-control">
                    <option value="">Select</option>
                    <?php 
                      for ($i=date('Y') + 4; $i > 1956 ; $i--) {
                    ?> 
                        <option value='<?=$i ?>' <?php if($user->ug_passing_year == $i){echo "selected";} ?>><?=$i ?></option>
                    <?php
                      }
                    ?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3">UG Degree: </label>
              <div class="col-sm-9">
                <select name="ug_degree" class="form-control">
                    <option value="">Select</option>
                    <option value="1" <?php if($user->degree_ug == '1'){ echo "selected";} ?>>BE/ B Tech</option>
                    <option value="7" <?php if($user->degree_ug == '7'){ echo "selected";} ?>>B Arch</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">UG Branch: </label>
              <div class="col-sm-9">
                <select name="ug_branch" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($branches as $key => $value) { ?>
                    <option value="<?= $value->BranchId ?>" <?php if($user->branch_ug == $value->BranchId){ echo "selected";} ?> ><?= $value->Branch ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <hr>

            <div class="form-group">
              <label class="control-label col-sm-3">PG Batch: </label>
              <div class="col-sm-9">
                <select name="pg_batch" class="form-control">
                    <option value="">Select</option>
                    <?php 
                      for ($i=date('Y') + 4; $i > 1956 ; $i--) {
                    ?> 
                        <option value='<?=$i ?>' <?php if($user->pg_passing_year == $i){echo "selected";} ?>><?=$i ?></option>
                    <?php
                      }
                    ?>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-3">PG Degree: </label>
              <div class="col-sm-9">
                <select name="pg_degree" class="form-control">
                    <option value="">Select</option>
                    <option value="2" <?php if($user->degree_pg == '1'){ echo "selected";} ?>>ME</option>
                    <option value="3" <?php if($user->degree_pg == '3'){ echo "selected";} ?>>M Tech</option>
                    <option value="4" <?php if($user->degree_pg == '4'){ echo "selected";} ?>>M.C.A.</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3">PG Branch: </label>
              <div class="col-sm-9">
                <select name="pg_branch" class="form-control">
                    <option value="">Select</option>
                    <?php foreach ($branches as $key => $value) { ?>
                    <option value="<?= $value->BranchId ?>" <?php if($user->branch_pg == $value->BranchId){ echo "selected";} ?> ><?= $value->Branch ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>

            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3">Notes: </label>
              <div class="col-sm-9">
                <textarea class="form-control" name="notes" rows="7"><?= $user->notes?></textarea>
              </div>
            </div>
            
            <div class="form-group text-center form-material">
              <a href="#" class="btn btn-danger">Cancel</a>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page -->
  <!-- Footer -->
  <?php include_once(__DIR__.'/../includes/footer.php') ?>  
