<?php

    include ("connect.php");

    //$callbackJSONData = '{"Body":{"stkCallback":{"MerchantRequestID":"10219-282761-1","CheckoutRequestID":"ws_CO_29112017125436847","ResultCode":0,"ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1.00},{"Name":"MpesaReceiptNumber","Value":"LKT9FDXVQ1"},{"Name":"Balance"},{"Name":"TransactionDate","Value":20171129125455},{"Name":"PhoneNumber","Value":254719273965}]}}}}';

    $balance = "";
    $b2CUtilityAccountAvailableFunds = "";

    $callbackJSONData = file_get_contents('php://input');
    $callbackData = json_decode($callbackJSONData,true);

    $data = json_decode($callbackJSONData);

    $json_good =  json_encode($data, JSON_PRETTY_PRINT);

    $datas = json_decode($json_good, true);

    $callbackData = $datas["Body"]["stkCallback"];

    echo $resultCode = $callbackData["ResultCode"];
    echo $resultDesc = $callbackData["ResultDesc"];
    echo $merchantRequestID = $callbackData["MerchantRequestID"];
    echo $checkoutRequestID = $callbackData["CheckoutRequestID"];

    $CallbackMetadata = $callbackData["CallbackMetadata"];
    echo $amount = $CallbackMetadata["Item"][0]["Value"];
    echo $mpesaReceiptNumber = $CallbackMetadata["Item"][1]["Value"];
    echo $transactionDate = $CallbackMetadata["Item"][3]["Value"];
    //echo $balance = $CallbackMetadata["Item"][2]["Value"];
    echo $phoneNumber = $CallbackMetadata["Item"][4]["Value"];

    // echo $b2CUtilityAccountAvailableFunds = $callbackData->stkCallback->CallbackMetadata->Item[3]->Value;
 
    $query = "UPDATE `online` SET `resultCode` = '".$resultCode."', `resultDesc` = '".$resultDesc."', `merchantRequestID` = '".$merchantRequestID."', `amount` = '".$amount."', `mpesaReceiptNumber` = '".$mpesaReceiptNumber."', `balance` = '".$balance."', `b2CUtilityAccountAvailableFunds` = '".$b2CUtilityAccountAvailableFunds."', `transactionDate` = '".$transactionDate."', `phoneNumber` = '".$phoneNumber."' WHERE `online`.`checkoutRequestID` = '".$checkoutRequestID."'";

    $result = mysqli_query($connection, $query);
    
    if($result){
        echo "successs";
    }else{
        echo "fail";
    }
?>