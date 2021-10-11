<?php
    /*    include_once("index.html"); */

  session_start();

  error_reporting(E_ALL & ~E_NOTICE);
  include_once("rmxLineFunction.php");
  
  $CompanyUrl = COMPANY_URL;

  
    $CompanyCode = '00001';
    if (isset($_POST['CompanyCode']))
        $CompanyCode = $_POST['CompanyCode'];
    if (isset($_GET['CompanyCode']))
        $CompanyCode = $_GET['CompanyCode'];


    $LineId = 'T0000-200001';
    if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
        $LineId = $_GET['LineId'];
    

    $Command = '';
    if (isset($_POST['Command']))
        $Command = $_POST['Command'];
    if (isset($_GET['Command']))
        $Command = $_GET['Command'];


    put_request($CompanyUrl,$LineId,$CompanyCode,date("Y-m-d h:i:sa"),$Command);
/*

    $LineId= '';
    if (isset($_POST['lblUserId'])) $LineId= $_POST['lblUserId'];
    $UserName= '';
    if (isset($_POST['txtUserName'])) $UserName= $_POST['txtUserName'];
    $EMail= '';
    if (isset($_POST['txtEMail'])) $EMail= $_POST['txtEMail'];
    $Tel='';
    if (isset($_POST['txtTel'])) $Tel= $_POST['txtTel'];
    //if ($LineId) {
      //  if (strlen($LineId) >0) {
            $sD = $UserName ."  " . $EMail ." " . $Tel ." ". date("Y-m-d h:i:sa");
            put_request($CompanyUrl,$LineId,"00001","TETS Liff",$sD);
       // }
    //}
*/
?>
