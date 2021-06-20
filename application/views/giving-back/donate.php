<link rel="stylesheet" href="<?= base_url()?>assets/css/giving-back.css">
	<div style="height:110px"></div>
	<div class="body-wrapper container">
		<?php $is19931997 = @$_GET['1993-1997'] ?>
		<?php $isMeet = @$_GET['alumni-meet'] ?>
		<?php $isGoldenTower = @$_GET['golden-tower'] ?>
		<?php $conflux = @$_GET['conflux-hyd-2018'] ?>
		<?php $isHelpingHands = @$_GET['helping-hands'] ?>
		<?php $isGoldenJubilee = @$_GET['golden-jubilee'] ?>
		<?php $isAppliedGeology = @$_GET['applied-geology-reunion'] ?>
		<?php $isAlumniMembership = @$_GET['alumni-membership-fees'] ?>
		<?php $AlumniAssociationMumbai = @$_GET['alumni-mumbai'] ?>
		<?php $AlumniAssociationPune = @$_GET['alumni-pune'] ?>
		<?php $AlumniAssociationHyderabad = @$_GET['alumni-hyderabad'] ?>
		<?php $SJR1991Batch = @$_GET['sjr-1991'] ?>
		<?php $SJR1989Batch = @$_GET['sjr-1989'] ?>
		<?php $GeneralCorpus = @$_GET['general-corpus'] ?>
		<?php $BenevolentFund = @$_GET['benevolent-fund'] ?>
		<?php $isNitrrMotoSports = @$_GET['nitrr-motosports-club'] ?>
		<?php $isGoldenTowerGuestRoomBooking = @$_GET['golden-guest-room'] ?>
		<?php $isGoldenTowerConferenceRoomBooking = @$_GET['golden-conference-room'] ?>

		<section class="search-page-wrapper">
			<h2 class="text-center">Please fill in your Details</h2>
			<hr>
			
			<div class="row">
				<div class="col-md-1"></div>
				<div class="registration-form col-md-10">
					<?php echo form_open('GivingBack/validate_donate') ?>
						<span style="color: red">
							<?php echo validation_errors(); ?>
						</span>
						<div class="item col-sm-4">
							<label for="first-name">First Name</label>		
							<input type="text" name="first-name" required value="<?php echo $view_data['first_name'] ?>">
						</div>
						<div class="item col-sm-4">
							<label for="last-name">Middle Name</label>		
							<input type="text" name="middle-name" value="<?php echo $view_data['middle_name'] ?>">
						</div>
						<div class="item col-sm-4">
							<label for="last-name">Last Name</label>		
							<input type="text" name="last-name" required value="<?php echo @$view_data['last_name'] ?>">
						</div>
						<div class="item col-sm-6">
							<label for="mobile-no">Mobile Number</label>		
							<input type="tel" name="mobile-no" required placeholder="10 Digits only" value="<?php echo @$view_data['mobile_no'] ?>">
						</div>

						<div class="item col-sm-6">
							<label for="whatsapp-no">Whatsapp Number</label>		
							<input type="tel" name="whatsapp-no" required placeholder="10 Digits only" value="<?php echo @$view_data['whatsapp_no'] ?>">
						</div>

						<div class="item col-sm-12">
							<label for="email">Email ID</label>		
							<input type="email" name="email" required placeholder="Please enter your personal email-id" value="<?php echo @$view_data['email'] ?>">
						</div>

						<div class="item col-sm-12">
							<label for="last-name">Complete Address</label>		
							<textarea required="" name="address" rows="5"><?php echo @$view_data['address'] ?></textarea>
						</div>

						<div class="item col-sm-12">
							<label for="passing-year">Passing Year</label>		
							<select name="passing-year">
								<script>
								  var myDate = new Date();
								  var year = myDate.getFullYear();
								  for(var i = year+4; i > 1956; i--){
									  document.write('<option value="'+i+'">'+i+'</option>');
								  }
							    </script>
							</select>
						</div>
						
						<div class="item col-sm-12">
							<label for="degree">Degree</label>		
							<select name="degree" id="degree">
								<option value="">Select</option>
								<option value="BE B tech" <?php if(@$view_data['degree'] == 'BE B tech') echo "selected"; ?>>B.E./B. Tech</option>
								<option value="B Arch" <?php if(@$view_data['degree'] == 'B Arch') echo "selected"; ?>>B. Arch</option>
								<option value="M E" <?php if(@$view_data['degree'] == 'M E') echo "selected"; ?>>M.E.</option>
								<option value="M Tech" <?php if(@$view_data['degree'] == 'M Tech') echo "selected"; ?>>M. Tech</option>
								<option value="MCA" <?php if(@$view_data['degree'] == 'MCA') echo "selected"; ?>>MCA</option>
							</select>
						</div>

						<div class="item col-sm-12">
							<label for="branch">Branch</label>		
							<select name="branch" id="branch">
								<option value="">Select</option>
								<option value="1" <?php if(@$view_data['branch_id'] == '1') echo "selected"; ?>>Metallurgical Engineering</option>
								<option value="2" <?php if(@$view_data['branch_id'] == '2') echo "selected"; ?>>Mining Engineering</option>
								<option value="3" <?php if(@$view_data['branch_id'] == '3') echo "selected"; ?>>Civil Engineering</option>
								<option value="4" <?php if(@$view_data['branch_id'] == '4') echo "selected"; ?>>Mechanical Engineering</option>
								<option value="5" <?php if(@$view_data['branch_id'] == '5') echo "selected"; ?>>Electrical Engineering</option>
								<option value="6" <?php if(@$view_data['branch_id'] == '6') echo "selected"; ?>>Chemical Engineering</option>
								<option value="7" <?php if(@$view_data['branch_id'] == '7') echo "selected"; ?>>Architecture</option>
								<option value="8" <?php if(@$view_data['branch_id'] == '8') echo "selected"; ?>>Electronics and Telecom Engineering</option>
								<option value="9" <?php if(@$view_data['branch_id'] == '9') echo "selected"; ?>>Information Technology</option>
								<option value="10 <?php if(@$view_data['branch_id'] == '10') echo "selected"; ?>">Computer Science and Engineering</option>
								<option value="11 <?php if(@$view_data['branch_id'] == '11') echo "selected"; ?>">Bio Medical Engineering</option>
								<option value="12 <?php if(@$view_data['branch_id'] == '12') echo "selected"; ?>">Bio Technology</option>
								<option value="13 <?php if(@$view_data['branch_id'] == '16') echo "selected"; ?>">Civil Enginerring-&gt;Water Resource &amp; Irregation Enginerring</option>
								<option value="19 <?php if(@$view_data['branch_id'] == '19') echo "selected"; ?>">Applied Geology</option>
								<option value="22 <?php if(@$view_data['branch_id'] == '22') echo "selected"; ?>">Mechanical Enginerring-&gt;Energy System &amp; Pollution</option>
								<option value="15 <?php if(@$view_data['branch_id'] == '15') echo "selected"; ?>">Electrical Enginerring-&gt;Computer Engineering</option>
								<option value="23 <?php if(@$view_data['branch_id'] == '23') echo "selected"; ?>">MCA</option>
							</select>
						</div>
						
						<div class="item col-sm-12 text-center">
							<p>How would you like to contribute?</p>
						</div>

						<div class="item col-sm-12 user-type-wrapper text-center">
							<label for="currency">Please choose your prefered currency:  </label>
							  <input type="radio" name="currency" value="INR" checked> Indian Rupees (INR)  
							  <input type="radio" name="currency" value="DLR"> Dollars ($)
						</div>
						
						<div class="item col-sm-12">
							<label for="cause">Select a cause:</label>		
							<select name="cause" id="cause">
								<option value="">Select</option>
								<option value="Alumni Association Member Fee" <?php echo ($isAlumniMembership) ? "selected":"" ?>>Alumni Association Member Fee</option>
								<option value="Golden Tower Fund" <?php echo ($isGoldenTower) ? "selected":"" ?>>Golden Tower Fund</option>
								<option value="Golden Tower Guest Room Booking" <?php echo ($isGoldenTowerGuestRoomBooking) ? "selected":"" ?>>Golden Tower Guest Room Booking</option>
								<option value="Golden Tower Conference Room Booking" <?php echo ($isGoldenTowerConferenceRoomBooking) ? "selected":"" ?>>Golden Tower Conference Room Booking</option>
								<option value="Student Education Assistant Fund">Student Education Assistant Fund</option>
								<option value="Abhishek Singh 2010 MCA Helping Hands" <?php echo ($isHelpingHands) ? "selected":"" ?>>Abhishek Singh - 2010 / MCA - Helping Hands</option>
								<!-- <option value="Batch of 1993 1997" <?php echo ($is19931997) ? "selected":"" ?>>Batch of 1993-1997</option> -->
								<option value="Alumni Association Mumbai Chapter" <?php echo ($AlumniAssociationMumbai) ? "selected":"" ?>>Alumni Association Mumbai Chapter</option>
								<option value="Alumni Association Pune Chapter" <?php echo ($AlumniAssociationPune) ? "selected":"" ?>>Alumni Association Pune Chapter</option>
								<option value="Alumni Association Hyderabad Chapter" <?php echo ($AlumniAssociationHyderabad) ? "selected":"" ?>>Alumni Association Hyderabad Chapter</option>
								<option value="SJR 1991 Batch" <?php echo ($SJR1991Batch) ? "selected":"" ?>>SJR 1991 Batch</option>
								<option value="SJR 1989 Batch" <?php echo ($SJR1989Batch) ? "selected":"" ?>>SJR 1989 Batch</option>
								<option value="General Corpus" <?php echo ($GeneralCorpus) ? "selected":"" ?>>General Corpus</option>
								<option value="Benevolent Fund" <?php echo ($BenevolentFund) ? "selected":"" ?>>Benevolent Fund</option>
								<option value="Annual Alumni Day 2019" <?php echo ($isMeet) ? "selected":"" ?>>Annual Alumni Day 2019</option>
								<option value="NITRR MOTOSPORTS Club Fund" <?php echo ($isNitrrMotoSports) ? "selected":"" ?>>NITRR MOTOSPORTS Club Fund</option>
								
								<?php 
									/*
									 <!-- <option value="Conflux 2018 Hyderabad" <?php echo ($conflux) ? "selected":"" ?>>Conflux 2018 Hyderabad</option> -->
									<!-- <option value="Golden Jubilee Reunion" <?php echo ($isGoldenJubilee) ? "selected":"" ?>>Golden Jubilee Reunion</option> -->
									<!-- <option value="Applied Geology Reunion 2018" <?php echo ($isAppliedGeology) ? "selected":"" ?>>GEO MILAP 2018</option> -->
								*/
								?>
								<option value="General Donation">General Donation</option>
							</select>
							<input name="sub-plan-details" type="hidden" value="">
						</div>

						<!-- <div class="item col-sm-12" id="alumni-meet" <?php echo ($isMeet? '':'style="display: none;"'); ?>>
							<label for="alumni-meet-plans">Select Plan:</label>		
							<select name="alumni-meet-plans">
								<option value="">Select</option>
								<option value="Singe Participation 3000">Singe Participation - 3000</option>
								<option value="Couple Participation 5000">Couple Participation - 5000</option>
								<option value="Family Participation 6000">Family Participation - 6000</option>
							</select>
						</div> -->

						<div class="item col-sm-12" id="golden-guest-room" <?php echo ($isGoldenTowerGuestRoomBooking? '':'style="display: none;"'); ?>>
							<div class="row">
								<p class="error text-center"><b>Note: For booking confirmation, please confirm the availabilty with Mr Prakash Mishra, Coordinator @ +91 9755595002. Make the payment, then download <a href="http://gecnitrralumni.org/files/GH-Form.pdf">this</a> file, fill it and mail to <a href="mailto:secretary@gecnitrralumni.org">secretary@gecnitrralumni.org</a></b></p>
								<div class="col-md-4">
									<label for="golden-guest-room-plans">Select Plan:</label>		
									<select name="golden-guest-room-plans">
										<option value="">Select</option>
										<option value="A">Category A : Rs 1500/-</option>
										<option value="B">Category B : Rs 2000/-</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="golden-guest-room-count">No of Rooms:</label>		
									<select name="golden-guest-room-count">
										<option value="">Select</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</div>
								<div class="col-md-4">
									<label for="golden-guest-room-days">No of Days:</label>		
									<select name="golden-guest-room-days">
										<option value="">Select</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
									</select>
								</div>
							</div>
						</div>

						<div class="item col-sm-12" id="golden-conference-room" <?php echo ($isGoldenTowerConferenceRoomBooking? '':'style="display: none;"'); ?>>
							<div class="row">
								<p class="error text-center"><b>Note: For booking confirmation, please confirm the availabilty with Mr Prakash Mishra, Coordinator @ +91 9755595002. Make the payment, then download <a href="http://gecnitrralumni.org/files/GH-Form.pdf">this</a> file, fill it and mail to <a href="mailto:secretary@gecnitrralumni.org">secretary@gecnitrralumni.org</a></b></p>
								<div class="col-md-6">
									<label for="golden-conference-room-plans">Select Plan:</label>		
									<select name="golden-conference-room-plans">
										<option value="">Select</option>
										<option value="A">Category A : Rs 5000/-</option>
										<option value="B">Category B : Rs 7500/-</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="golden-conference-room-days">No of Days:</label>		
									<select name="golden-conference-room-days">
										<option value="">Select</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
									</select>
								</div>
							</div>
						</div>

						<div class="item col-sm-12" id="alumni-meet" <?php echo ($isMeet? '':'style="display: none;"'); ?>>
							<div class="row">
								<div class="col-md-6"><p>Participation Fee Single: Rs 3000/ Person</p></div>
								<div class="col-md-6">
									<select name="alumni-meet-participation-single">
										<option value="0">Persons: 0</option>
										<option value="1">Persons: 1</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6"><p>Participation Fee Family : Rs 5000/ Family</p></div>
								<div class="col-md-6">
									<select name="alumni-meet-participation-family">
										<option value="0">Family: 0</option>
										<option value="1">Family: 1</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6"><p>Accommodation: Rs.2000 per person per night (Sharing basis)</p></div>
								<!-- <div class="col-md-6">
									<select name="alumni-meet-persons-single-sharing">
										<option selected value>Persons: 0</option>
										<option value="1">Persons: 1 </option>
										<option value="2">Persons: 2 </option>
										<option value="3">Persons: 3 </option>
										<option value="4">Persons: 4 </option>
									</select>
								</div> -->
								<div class="col-md-6">
									<select name="alumni-meet-persons-single-sharing-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6"><p>Accommodation: Rs.4000 per person per night (Non-Sharing basis)</p></div>
								<!-- <div class="col-md-6">
									<select name="alumni-meet-persons-single-non-sharing">
										<option selected value>Persons: 0</option>
										<option value="1">Persons: 1 </option>
										<option value="2">Persons: 2 </option>
										<option value="3">Persons: 3 </option>
										<option value="4">Persons: 4 </option>
									</select>
								</div> -->
								<div class="col-md-6">
									<select name="alumni-meet-persons-single-non-sharing-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6"><p>Accommodation: Rs.4000 per night (one Family Couple)</p></div>
								<div class="col-md-6">
									<select name="alumni-meet-family-couple-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6"><p>Accommodation: Rs.5000 per night (per Family with children)</p></div>
								<div class="col-md-6">
									<select name="alumni-meet-family-children-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>
						</div>

						<?php /*
						<!-- Conflux Hyderabad 2018 -->
						<div class="item col-sm-12" id="conflux-hyd-2018" <?php echo ($conflux? '':'style="display: none;"'); ?>>
							<div class="row">
								<div class="col-md-4"><p>Single occupancy - Rs 7250</p></div>
								<div class="col-md-4">
									<select name="conflux-hyd-single-occupancy-persons">
										<option selected value>Persons: 0</option>
										<option value="1">Persons: 1</option>
										<option value="2">Persons: 2</option>
										<option value="3">Persons: 3</option>
										<option value="4">Persons: 4</option>
									</select>
								</div>
								<div class="col-md-4">
									<select name="conflux-hyd-single-occupancy-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4"><p>Double occupancy (Each person) - Rs 4850</p></div>
								<div class="col-md-4">
									<select name="conflux-hyd-double-occupancy-persons">
										<option selected value>Persons: 0</option>
										<option value="1">Persons: 1</option>
										<option value="2">Persons: 2</option>
										<option value="3">Persons: 3</option>
										<option value="4">Persons: 4</option>
										<option value="5">Persons: 5</option>
										<option value="6">Persons: 6</option>
									</select>
								</div>
								<div class="col-md-4">
									<select name="conflux-hyd-double-occupancy-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4"><p>Childrens (5+ up to 18 years) - Rs 2950</p></div>
								<div class="col-md-4">
									<select name="conflux-hyd-children-occupancy-persons">
										<option selected value>Children: 0</option>
										<option value="1">Children: 1</option>
										<option value="2">Children: 2</option>
										<option value="3">Children: 3</option>
										<option value="4">Children: 4</option>
										<option value="5">Children: 5</option>
										<option value="6">Children: 6</option>
									</select>
								</div>
								<div class="col-md-4">
									<select name="conflux-hyd-children-occupancy-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>
							<p><b>Check-in: 1 PM, 24th Nov, 2018 | Check-out: 12 PM, 25th Nov, 2018.</b> All charges are inclusive of taxes for one day.</p>
							<p>Charges for city tour ( Any one) on 25th Nov 2018. Starting after breakfast & finish by 8:30 pm max. Tours inclusive of transportation, entry tickets, parking, lunch & guide.</p>
							<label for="conflux-hyd-2018-city-tour">City Tour: Select only ONE</label>
							<div class="row">
								<div class="col-md-6">
									<select name="conflux-hyd-2018-city-tour">
										<option value="">Select</option>
										<option value="Hyderabad City Tour Attractions : Rs 1400">Hyderabad City Tour Attractions : Rs 1400 per person ( Above 5 years age)</option>
										<option value="Ramoji Film City Tour: Rs 2500">Ramoji Film City Tour: Rs 2500 per person( above 5 years of age)</option>
									</select>
								</div>
								<div class="col-md-6">
									<select name="conflux-hyd-2018-city-tour-qty">
										<option selected value>Persons: 0</option>
										<option value="1">Persons: 1</option>
										<option value="2">Persons: 2</option>
										<option value="3">Persons: 3</option>
										<option value="4">Persons: 4</option>
										<option value="5">Persons: 5</option>
										<option value="6">Persons: 6</option>
									</select>
								</div>
							</div>
						</div>
						*/
						?>
						<?php /*
						<!-- Golden Jubliee Reunion 2018 -->

						<div class="item col-sm-12" id="golden-jubilee" <?php echo ($isGoldenJubilee? '':'style="display: none;"'); ?>>
							<div class="row">
								<div class="col-md-6"><p>Participation Fees - Rs 3000/ Person (22nd & 24th Dec Program of 1968 Batch only. No charge for 23rd Dec. college program)</p></div>
								<div class="col-md-6">
									<select name="golden-jubilee-participation">
										<option value="0">Persons: 0</option>
										<option value="1">Persons: 1</option>
										<option value="2">Persons: 2</option>
										<option value="3">Persons: 3</option>
										<option value="4">Persons: 4</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4"><p>Accommodation Fees - Rs.3000 per person per night(Either single or double sharing basis)</p></div>
								<div class="col-md-4">
									<select name="golden-jubilee-single-occupancy-persons">
										<option selected value>Persons: 0</option>
										<option value="Persons: 1">Persons: 1</option>
										<option value="Persons: 2">Persons: 2</option>
										<option value="Persons: 2 with Minor">Persons: 2 with Minor</option>
										<option value="Persons: 3">Persons: 3</option>
										<option value="Persons: 4">Persons: 4</option>
									</select>
								</div>
								<div class="col-md-4">
									<select name="golden-jubilee-single-occupancy-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
										<option value="3">Days: 3</option>
									</select>
								</div>
							</div>
						</div>
						*/?>
						<!-- Applied Geology Reunion 2018 -->
						<div class="item col-sm-12" id="applied-geology" <?php echo ($isAppliedGeology? '':'style="display: none;"'); ?>>
							<div class="row">
								<div class="col-md-6"><p>Participation Fee : Rs 1500/ Person or Family (Inclusive of Annual Alumni Day 2018)</p></div>
								<div class="col-md-6">
									<select name="applied-geology-participation">
										<option value="0">Persons: 0</option>
										<option value="1">Persons: 1</option>
										<option value="2">Persons: 2</option>
										<option value="3">Persons: 3</option>
										<option value="4">Persons: 4</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4"><p>Accommodation Fees : Rs.2000 per person per night (Twin sharing basis)</p></div>
								<div class="col-md-4">
									<select name="applied-geology-persons">
										<option selected value>Persons: 0</option>
										<option value="1">Persons: 1 / Sharing : Rs 2000</option>
										<option value="2">Persons: 1 / Non-Sharing: Rs 4000</option>
										<option value="2">Persons: 2 or 2+</option>
									</select>
								</div>
								<div class="col-md-4">
									<select name="applied-geology-days">
										<option selected value>Days: 0</option>
										<option value="1">Days: 1</option>
										<option value="2">Days: 2</option>
									</select>
								</div>
							</div>
						</div>
						<div class="item col-sm-12">
							<label for="mobile-no">Amount</label>
							<?php if($isAlumniMembership){ $view_data['amount'] = "1000"; } ?>
							<input type="text" <?php if($isAlumniMembership)echo 'readonly';?> name="amount" required value="<?php echo @$view_data['amount'] ?>">
						</div>
						
						<div class="item submit-button col-sm-12 text-center">
							<button class="btn purple-bkgd" type="submit">Submit</button>
						</div>

					<?php echo form_close() ?>
				</div>
				<div class="col-md-1"></div>
			</div>
		</section>
	</div>