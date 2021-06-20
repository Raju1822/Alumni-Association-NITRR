<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GivingBack extends CI_Controller {

	public function index()
	{
		$this->giving_back();
	}

	public function giving_back()
	{
		$this->load->view('header.php');
		$this->load->view('giving-back/giving-back.php');
		$this->load->view('footer.php');
	}

	public function donate($data=null)
	{
		$view_data['view_data'] = $this->session->userdata('donation_details');
		$this->load->view('header.php');
		$this->load->view('giving-back/donate.php', $view_data);
		$this->load->view('footer.php');
	}

	public function validate_donate()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first-name','First Name', 'required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('middle-name','Middle Name', 'trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('last-name','Last Name', 'required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('branch','Branch', 'required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('degree','Degree', 'required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('currency','Currency', 'required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('mobile-no','Mobile Number','required|trim|numeric');
		$this->form_validation->set_rules('whatsapp-no','Mobile Number','required|trim|numeric');
		$this->form_validation->set_rules('amount','Amount','required|trim|numeric|greater_than[0]');
		$this->form_validation->set_rules('passing-year','Passing Year','required|trim|numeric');
		$this->form_validation->set_rules('cause','Cause','required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('sub-plan-details','Sub plan details','trim');
		$this->form_validation->set_rules('address','Address','required|trim');
		$this->form_validation->set_rules('currency','Currency','required|trim');

		if ($this->form_validation->run()) {
			$this->load->Model('Model_giving_back');

			$email = $this->input->post('email');
			$mobile_no = $this->input->post('mobile-no');
			$whatsapp_no = $this->input->post('whatsapp-no');
			$passing_year = $this->input->post('passing-year');
			$degree = $this->input->post('degree');
			$branch_id = $this->input->post('branch');
			$batch = $this->input->post('batch');
			$address = $this->input->post('address');
			$first_name = $this->input->post('first-name');
			$last_name = $this->input->post('last-name');
			$middle_name = $this->input->post('middle-name');
			$cause = $this->input->post('cause');
			$amount = $this->input->post('amount');
			$currency = $this->input->post('currency');
			$meet_plan = $this->input->post('sub-plan-details');

			$branches = $this->Model_giving_back->get_all_branches();

			foreach ($branches as $branch) {
				if ($branch->BranchId == $branch_id) {
					$branch_name = $branch->Branch;
				}
			}

			$data = array(
				'email' => $email,
				'mobile_no' => $mobile_no,
				'passing_year' => $passing_year,
				'branch_id' => $branch_id,
				'batch' => $batch,
				'degree' => $degree,
				'address' => $address,
				'first_name' => $first_name,
				'middle_name' => $middle_name,
				'last_name' => $last_name,
				'whatsapp_no' => $whatsapp_no,
				'cause' => $cause,
				'amount' => $amount,
				'currency' => $currency,
				'branch_name' => $branch_name,
				'meet_plan' => $meet_plan
			);

			$this->session->set_userdata('donation_details', $data);
			$this->confirm_donation();
		}else{
			$this->donate();
		}
	}
 
	public function edit_donatation()
	{
		$userdata = $this->session->userdata('donation_details');

		if ($userdata) {
			$this->donate($this->session->userdata('donation_details'));
		}
	}

	private function confirm_donation()
	{
		if(!$this->session->userdata('donation_details')){
			redirect('GivingBack');
		}else{
			$data['details'] = $this->session->userdata('donation_details');

			$this->load->view('header.php');
			$this->load->view('giving-back/confirm-donation.php',$data);
			$this->load->view('footer.php');			
		}
	}

	public function start_transaction()
	{
		$details = $this->session->userdata('donation_details'); 
		if (!$details) {
			redirect('GivingBack/donate');
		}else{
 
			// insert into pending transactions table
			$this->load->Model('Model_giving_back');
			
			// creating a unique transaction_id and user id
			$user_id_new = (int) $this->Model_giving_back->get_new_user_id() + 1;

			$data = array(
				'user_id' => $user_id_new,
				'first_name'=> $details['first_name'],
				'middle_name'=> $details['middle_name'],
				'last_name'=> $details['last_name'],
				'email'=> $details['email'],
				'address'=> $details['address'],
				'mobile'=> $details['mobile_no'],
				'whatsapp_no'=> $details['whatsapp_no'],
				'passing_year'=> $details['passing_year'],
				'branch'=> $details['branch_name'],
				'degree'=> $details['degree'],
				'currency'=> $details['currency'],
				'cause'=> $details['cause'],
				'amount'=> $details['amount'],
				'meet_plan' => $details['meet_plan'] 
			);

			if($this->Model_giving_back->add_pending_donation($data)){
				$data['txn_id'] = $this->Model_giving_back->get_txn_id();
				$this->session->set_userdata('txn_id', $data['txn_id']);
				$this->session->set_userdata('user_id', $data['user_id']);
				$this->redirect_to_bank($data);
			}
		}
	}

	private function redirect_to_bank($data=null)
	{	

		ob_start();
		// The payment gateway is integrated here.
		if ($data) {
			// from excel sheet
			$iv = '6731156943UGXLOI';
			$key = '3650760307JCEVDT';

			$this->session->set_userdata('iv',$iv);
			$this->session->set_userdata('key', $key);

			// Requiring TranscationBean files 
			require_once (APPPATH.'payment-kit/TransactionRequestBean.php');
			require_once (APPPATH.'payment-kit/TransactionResponseBean.php');

			$transactionRequestBean = new TransactionRequestBean();
			date_default_timezone_set('Asia/Calcutta');
			
			$request_type = 'T';
			$txn_id = $data['txn_id'];
			$date = date('d-m-Y');
			$locatorURL = 'https://www.tpsl-india.in/PaymentGateway/TransactionDetailsNew.wsdl';
			$return_url = base_url()."GivingBack/responseFromBank";
			if ($data['middle_name']) {
				$cust_name = $data['first_name']." ".$data['middle_name']." ".$data['last_name'];			
			}else{
				$cust_name = $data['first_name']." ".$data['last_name'];			
			}
			$this->session->set_userdata('full_name', $cust_name);
			
			// This is the format for shopping cart details. It is not mentioned anywhere in the documentation. They suck.
			// Alum_amount_.0_0.0
			$shoppingCartDetails = "Alum_". $data['amount'] .".0_0.0";

			// Setting all the values here
    
    		$transactionRequestBean->setMerchantCode('L85020');
			$transactionRequestBean->setMobileNumber(strval($data['mobile']));
		    $transactionRequestBean->setCustomerName($cust_name);
		    $transactionRequestBean->setRequestType($request_type);
		    $transactionRequestBean->setMerchantTxnRefNumber(strval($data['txn_id']));
		    // So after 1 day and 5 remakes of the complete payment gateway, I found that the test server is only allowed to make Rs 1 transaction only. They should fucking mention it somewhere in their shitty documentation.
		    $transactionRequestBean->setAmount($data['amount']);
		    $transactionRequestBean->setCurrencyCode('INR');
		    $transactionRequestBean->setReturnURL($return_url);
		    $transactionRequestBean->setShoppingCartDetails($shoppingCartDetails);
    		$transactionRequestBean->setTxnDate($date);
    		$transactionRequestBean->setCustId($data['user_id']);
		    $transactionRequestBean->setKey($this->session->userdata('key'));
		    $transactionRequestBean->setIv($this->session->userdata('iv'));
		    $transactionRequestBean->setWebServiceLocator($locatorURL);

		    $responseDetails = $transactionRequestBean->getTransactionToken();
		    $responseDetails = (array)$responseDetails;
		    $response = $responseDetails[0];
		    if(is_string($response) && preg_match('/^msg=/',$response)){
		        $outputStr = str_replace('msg=', '', $response);
		        $outputArr = explode('&', $outputStr);
		        $str = $outputArr[0];

		        $transactionResponseBean = new TransactionResponseBean();
		        $transactionResponseBean->setResponsePayload($str);
		        $transactionResponseBean->setKey($this->session->userdata('key'));
		        $transactionResponseBean->setIv($this->session->userdata('iv'));

		        $response = $transactionResponseBean->getResponsePayload();
		        // echo "<pre>";
		        // print_r($response);
		        exit;
		    }elseif(is_string($response) && preg_match('/^txn_status=/',$response)){
				// echo "<pre>";
				// print_r($response);
		        exit;
			}
		    echo "<script>window.location = '".$response."'</script>";
		    ob_flush();
		}
	}

	public function responseFromBank()
	{
		if (@$_SESSION['iv']) {
			// Load Models
			$this->load->Model('Model_giving_back');
			// Requiring TranscationBean files 
			require_once (APPPATH.'payment-kit/TransactionRequestBean.php');
			require_once (APPPATH.'payment-kit/TransactionResponseBean.php');

			$response = $this->input->post();
			
			if(is_array($response)){
		        $str = $response['msg'];
		    }else if(is_string($response) && strstr($response, 'msg=')){
		        $outputStr = str_replace('msg=', '', $response);
		        $outputArr = explode('&', $outputStr);
		        $str = $outputArr[0];
		    }else {
		        $str = $response;
		    }

		    $transactionResponseBean = new TransactionResponseBean();

		    $transactionResponseBean->setKey($_SESSION['key']);
		    $transactionResponseBean->setIv($_SESSION['iv']);
		    $transactionResponseBean->setResponsePayload($str);

		    $response = $transactionResponseBean->getResponsePayload();
		    
		    $responseArray = explode("|", $response);
		    foreach ($responseArray as $key => $response) {
		    	$responseArray[$key] = explode("=", $response);
		    }

		    if ($responseArray[0][1] === "0300") {
		    	// Success
		    	// prepare the data for insertion
		    	$user_data = $this->session->userdata('donation_details');

				$data = array(
					'transaction_id' => $this->session->userdata('txn_id') ,
					'user_id' => $this->session->userdata('user_id'),
					'customer_name' => $this->session->userdata('full_name'),
					'email' => $user_data["email"],
					'mobile' => $user_data["mobile_no"],
					'whatsapp_no' => $user_data["whatsapp_no"],
					'address' => $user_data["address"],
					'passing_year' => $user_data["passing_year"],
					'branch' => $user_data["branch_name"],
					'degree' => $user_data["degree"],
					'currency' => $user_data["currency"],
					'cause' => $user_data["cause"],
					'amount' => $user_data["amount"],
					'meet_plan' => $user_data["meet_plan"],
					'txn_status' => $responseArray[0][1],
					'txn_msg' => $responseArray[1][1],
					'tspl_bank_cd' => $responseArray[4][1],
					'tspl_txn_id' => $responseArray[5][1],
					'tspl_txn_time' => $responseArray[8][1],
					'tpsl_rfnd_id' => $responseArray[9][1],
					'bal_amt' => $responseArray[10][1],
					'rqst_token' => $responseArray[11][1],
					'hash' => $responseArray[12][1]
				);

			    // Save it in the database
			    if($this->Model_giving_back->add_completed_donation($data)){
			    	// delete the transaction from the pending donations table
			    	if ($this->Model_giving_back->delete_pending_donation($this->session->userdata('txn_id'))) {
			    		$this->successful_transaction($data);
			    		session_destroy();
			    	}
			    }
		    }else{
		    	$user_data = $this->session->userdata('donation_details');

				$data = array(
					'transaction_id' => $this->session->userdata('txn_id') ,
					'user_id' => $this->session->userdata('user_id'),
					'customer_name' => $this->session->userdata('full_name'),
					'email' => $user_data["email"],
					'mobile' => $user_data["mobile_no"],
					'whatsapp_no' => $user_data["whatsapp_no"],
					'address' => $user_data["address"],
					'passing_year' => $user_data["passing_year"],
					'branch' => $user_data["branch_name"],
					'degree' => $user_data["degree"],
					'currency' => $user_data["currency"],
					'cause' => $user_data["cause"],
					'meet_plan' => $user_data["meet_plan"],
					'amount' => $user_data["amount"],
					'txn_status' => $responseArray[0][1],
					'txn_msg' => $responseArray[1][1],
					'tspl_bank_cd' => $responseArray[4][1],
					'tspl_txn_id' => $responseArray[5][1],
					'tspl_txn_time' => $responseArray[8][1],
					'tpsl_rfnd_id' => $responseArray[9][1],
					'bal_amt' => $responseArray[10][1],
					'rqst_token' => $responseArray[11][1],
					'hash' => $responseArray[12][1]
				);
				if($this->Model_giving_back->add_unsuccessful_donation($data)){
			    	$this->unsuccessful_transaction($data);
				}
		    }
		}else{
		    	echo "<h2>Error!</h2>";
		    }
	}


	private function successful_transaction($data)
	{
		$viewdata['details'] = $data;
		$this->load->view('header.php');	
		$this->load->view('giving-back/successful_transaction', $viewdata);
		$this->load->view('footer.php');

	}
	private function unsuccessful_transaction($data)
	{	
		$viewdata['details'] = $data;
		$this->load->view('header.php');	
		$this->load->view('giving-back/unsuccessful_transaction', $viewdata);
		$this->load->view('footer.php');

	}
}