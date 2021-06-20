	<link rel="stylesheet" href="<?= base_url()?>assets/css/giving-back.css">
	<div style="height:110px"></div>
	<div class="body-wrapper container">
		<section class="search-page-wrapper">
			<h2 class="text-center">Sorry Your Transaction was not succesful</h2>
			<p class="text-center">Don't Worry. If you account was debited, It'll be credited back into your account in 2-3 working days.</p>
			<hr>
			<?php if (isset($details)) { ?>

				<table class="table table-hover table-striped" align="center">
					<tbody>
						<tr>
							<td class="td-label">Transaction ID: </td>
							<td class="td-content"><?php echo $details['transaction_id'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Name: </td>
							<td class="td-content"><?php echo $details['customer_name'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Email: </td>
							<td class="td-content"><?php echo $details['email'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Mobile Number: </td>
							<td class="td-content"><?php echo $details['mobile'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Whatsapp Number: </td>
							<td class="td-content"><?php echo $details['whatsapp_no'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Passing Year: </td>
							<td class="td-content"><?php echo $details['passing_year'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Branch: </td>
							<td class="td-content"><?php echo $details['branch'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Address: </td>
							<td class="td-content"><?php echo $details['address'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Currency: </td>
							<td class="td-content"><?php echo $details['currency'] ?></td>
						</tr>
						<tr>
							<td class="td-label">Cause: </td>
							<td class="td-content"><?php echo $details['cause'] ?></td>
						</tr>
						<?php if ($details['meet_plan']) { ?>
						<tr>
							<td class="td-label">Plan: </td>
							<td class="td-content"><?php echo $details['meet_plan'] ?></td>
						</tr>
						<?php } ?>
						<tr>
							<td class="td-label">Amount: </td>
							<td class="td-content">&#8377; <?php echo $details['amount'] ?>/-</td>
						</tr>
					</tbody>
				</table>
			<?php }else{ ?>
				<h2>Sorry! Something Bad Happened!</h2>
			<?php }?>
			
		</section>
	</div>