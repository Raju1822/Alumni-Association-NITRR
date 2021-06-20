<table class="table table-hover dataTable table-striped width-full" id="exampleTableTools3">
            <thead>
              <tr>
                <th class="text-center">User Id</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Batch</th>
                <th class="text-center">Branch</th>
                <th class="text-center">DOB</th>
                <th class="text-center">Gender</th>
                <th class="text-center">City</th>
                <th class="text-center">Phone1</th>
                <th class="text-center">Phone2</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">User Id</th>
                <th>Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Batch</th>
                <th class="text-center">Branch</th>
                <th class="text-center">DOB</th>
                <th class="text-center">Gender</th>
                <th class="text-center">City</th>
                <th class="text-center">Phone1</th>
                <th class="text-center">Phone2</th>
              </tr>
            </tfoot>
            <tbody>    
                <?php foreach ($results as $key => $result) { 
                    if (is_numeric($result->branch_ug) || is_numeric($result->branch_ug)) {
                        foreach ($branches as $branch) {
                            if ($branch->BranchId == $result->branch_ug || $branch->BranchId == $result->branch_pg  ) {
                                $cur_branch = $branch->Branch;
                            }
                        }
                    }else{
                        if ($result->branch_ug) {
                            $cur_branch = $result->branch_ug;
                        }else{
                            $cur_branch = $result->branch_pg;
                        }
                    }

                    if ($result->ug_passing_year) {
                        $batch =$result->ug_passing_year; 
                    }else{
                        $batch =$result->pg_passing_year; 
                    }
                ?>
                <tr>
                    <td class="text-center"><?php echo $result->user_id?></td>
                    <td><?php echo $result->name?></td>
                    <td class="text-center"><?php echo $result->email?></td>
                    <td class="text-center"><?php echo $batch ?></td>
                    <td class="text-center"><?php echo $cur_branch ?></td>
                    <td class="text-center"><?php echo date('d-m-Y',strtotime($result->dob))?></td>
                    <td class="text-center"><?php echo $result->gender?></td>
                    <td class="text-center"><?php echo $result->city?></td>
                    <td class="text-center"><?php echo $result->ph_number_1?></td>
                    <td class="text-center"><?php echo $result->ph_number_2?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>