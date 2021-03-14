<?php
session_start();
if (isset($_POST['submit'])) {
    $json=$_FILES['json'];
    $jsonName=$json['name'];
    $jsonType=$json['type'];
    $jsonTmpName=$json['tmp_name'];
    $jsonError=$json['error'];
    $jsonSize=$json['size'];
    $jsonSizeMb= $jsonSize / (1024**2);
    $ext=pathinfo($jsonName,PATHINFO_EXTENSION);
    
    $errors=[];
    if ($jsonError !=0) {
        $errors[]='error while uploading file';
    } elseif (! in_array($ext,['json'])) {
        $errors[]='file must be json file'; 
    } elseif ($jsonSizeMb>1) {
        $errors[]='file size must be lower than 1MB';
    }
    
    
    
    if (empty($errors)) {
        //move to uploads
        $randomStr=uniqid();
        $jsonNewName="$randomStr.$ext";
        move_uploaded_file($jsonTmpName,"project-directory/$jsonNewName");
        $jsonFile=fopen("project-directory/$jsonNewName","r");
        $testFileSize= fread($jsonFile,filesize("project-directory/$jsonNewName"));
        $assocData=json_decode($testFileSize);
        $_SESSION['success']=$assocData;
        header("location: display.php");
    } else {
        $_SESSION['errors']=$errors;
        header("location: upload-json.php");
    }
}
