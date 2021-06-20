<?php

ob_start();

$strNo = rand(1,1000000);
date_default_timezone_set('Asia/Calcutta');

//echo date_default_timezone_get();

$strCurDate = date('d-m-Y');

require_once (APPPATH.'payment-kit/TransactionRequestBean.php');
require_once (APPPATH.'payment-kit/TransactionResponseBean.php');

if($_POST){

    $response = $_POST;

    if(is_array($response)){
        echo "setting str as response is array";
        $str = $response['msg'];
    }else if(is_string($response) && strstr($response, 'msg=')){
        $outputStr = str_replace('msg=', '', $response);
        $outputArr = explode('&', $outputStr);
        $str = $outputArr[0];
    }else {
        $str = $response;
    }

    $transactionResponseBean = new TransactionResponseBean();

    $transactionResponseBean->setResponsePayload($str);
    $transactionResponseBean->setKey($_SESSION['key']);
    $transactionResponseBean->setIv($_SESSION['iv']);

    $response = $transactionResponseBean->getResponsePayload();
    echo "printiinf respo";
    echo "<pre>";
    print_r($response);
    echo "<br><br><br><br>";

    session_destroy();?>

    <a href='<?php echo "http://".$_SERVER["HTTP_HOST"].$_SERVER['SCRIPT_NAME'];?>'>GO TO HOME</a>

    <?php
    exit;
}else if ($data){

    $_SESSION['iv'] = '6014291051IBXWQV';
    $_SESSION['key']   = '6636259131GPLFAX';
    $locatorURL = 'https://www.tekprocess.co.in/PaymentGateway/TransactionDetailsNew.wsdl';
    $transactionRequestBean = new TransactionRequestBean();

    //Setting all values here
    $transactionRequestBean->setMerchantCode('T45183');
    $transactionRequestBean->setAccountNo('');
    $transactionRequestBean->setITC('');
    $transactionRequestBean->setMobileNumber(strval($data['mobile']));
    $transactionRequestBean->setCustomerName($data['first_name']);
    $transactionRequestBean->setRequestType('T');
    $transactionRequestBean->setMerchantTxnRefNumber($data['txn_id']);
    $transactionRequestBean->setAmount(strval($data['amount']));
    $transactionRequestBean->setCurrencyCode('INR');
    $transactionRequestBean->setReturnURL(base_url()."GivingBack/redirect_to_bank");
    // $transactionRequestBean->setS2SReturnURL($data['s2SReturnURL']);
    // $transactionRequestBean->setShoppingCartDetails($data['reqDetail']);
    $transactionRequestBean->setTxnDate($strCurDate);
    // $transactionRequestBean->setBankCode($data['bankCode']);
    // $transactionRequestBean->setTPSLTxnID($data['tpsl_txn_id']);
    $transactionRequestBean->setCustId($data['user_id']);
    // $transactionRequestBean->setCardId($data['cardID']);
    $transactionRequestBean->setKey($_SESSION['key']);
    $transactionRequestBean->setIv($_SESSION['iv']);
    $transactionRequestBean->setWebServiceLocator($locatorURL);
    // $transactionRequestBean->setMMID($data['mmid']);
    // $transactionRequestBean->setOTP($data['otp']);
    // $transactionRequestBean->setCardName($data['cardName']);
    // $transactionRequestBean->setCardNo($data['cardNo']);
    // $transactionRequestBean->setCardCVV($data['cardCVV']);
    // $transactionRequestBean->setCardExpMM($data['cardExpMM']);
    // $transactionRequestBean->setCardExpYY($data['cardExpYY']);
    // $transactionRequestBean->setTimeOut($data['timeOut']);

    // $url = $transactionRequestBean->getTransactionToken();

    $responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response = $responseDetails[0];

    if(is_string($response) && preg_match('/^msg=/',$response)){
        $outputStr = str_replace('msg=', '', $response);
        $outputArr = explode('&', $outputStr);
        $str = $outputArr[0];

        $transactionResponseBean = new TransactionResponseBean();
        $transactionResponseBean->setResponsePayload($str);
        $transactionResponseBean->setKey($data['key']);
        $transactionResponseBean->setIv($data['iv']);

        $response = $transactionResponseBean->getResponsePayload();
        echo "<pre>";
        print_r($response);
        exit;
    }elseif(is_string($response) && preg_match('/^txn_status=/',$response)){
        echo "<pre>";
        print_r($response);
        exit;
    }
    
    echo "<script>window.location = '".$response."'</script>";
    ob_flush();
}
?>
