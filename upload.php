<?php

if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    $filename = 'uploads/' . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $filename);
    $xml=simplexml_load_file($filename) or die("Error: Cannot create object");
    $UserLoginName = $xml->UserAuthRequest->UserLoginName;
    $PolNumber = $xml->TXLifeRequest->OLifE->Holding->Policy->PolNumber;
    $CarrierCode = $xml->TXLifeRequest->OLifE->Holding->Policy->CarrierCode;
    $Party = $xml->TXLifeRequest->OLifE->Party[0];
    $person = $Party->Person;
    $FirstName = $person->FirstName;
    $LastName = $person->LastName;
    $BirthDate = $person->BirthDate;
    $Phone = $Party->Phone;
    $PhoneTypeCode = $Phone->PhoneTypeCode;
    $AreaCode = $Phone->AreaCode;
    $DialNumber = $Phone->DialNumber;

    $data = [];
    $data['UserLoginName'] = $UserLoginName;
    $data['PolNumber'] = $PolNumber;
    $data['CarrierCode'] = $CarrierCode;
    $data['FirstName'] = $FirstName;
    $data['LastName'] = $LastName;
    $data['BirthDate'] = $BirthDate;
    $data['PhoneTypeCode'] = $PhoneTypeCode;
    $data['AreaCode'] = $AreaCode;
    $data['DialNumber'] = $DialNumber;
    echo json_encode($data);
}

?>