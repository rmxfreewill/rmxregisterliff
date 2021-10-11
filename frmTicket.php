<?php
    /*    include_once("index.html"); 
    https://rmxregister.herokuapp.com/frmTicket.php?LineId=Ucd102187a2dfb7494ea9d723a5ae4041&LinkCode=CHECK
    */

  session_start();

  error_reporting(E_ALL & ~E_NOTICE);
  include_once("rmxLineFunction.php");
  
  $CompanyUrl = COMPANY_URL;
  $RegisterUrl = REGISTER_URL;
  $CompanyCode = COMPANY_CODE;
  $LiffId = LIFF_ID;


    $LinkCode = '';
    if (isset($_POST['LinkCode']))
        $LinkCode = $_POST['LinkCode'];
    if (isset($_GET['LinkCode']))
        $LinkCode = $_GET['LinkCode'];

    $LineId = '';
    if (isset($_POST['LineId']))
        $LineId = $_POST['LineId'];
    if (isset($_GET['LineId']))
        $LineId = $_GET['LineId'];
    
    $CmdCommand = '';
    if (isset($_POST['CmdCommand']))
        $CmdCommand = $_POST['CmdCommand'];
    if (isset($_GET['CmdCommand']))
        $CmdCommand = $_GET['CmdCommand'];     

    $TableTitle = 'View Ticket';
    if (isset($_POST['TableTitle']))
        $TableTitle = $_POST['TableTitle'];
    if (isset($_GET['TableTitle']))
        $TableTitle = $_GET['TableTitle'];             
        
    $RetCommand = '';
    $Ret = '';
    
    $UserName = '';
    $EMail = '';
    $Tel = '';
    $SoldToCode = '';
    $SoldToName = '';
    $sFlagMsg = '';
    $sFlag = '5';
    $sTitle = 'Ticket';
    $sShowMsg = '';
        
    if ($LinkCode =='VIEW') {

         $RetCommand =send_query($CompanyUrl,$LineId,$CompanyCode,$CmdCommand);       
        if ($RetCommand) {
    
        }
        $sFlag = '5';
    } else if ($LinkCode =='CHECK') {

        
        $RetCommand =send_command($CompanyUrl,'','',$CmdCommand);                
        if ($RetCommand) {
            //select $sFlagMsg,$nFlag,$sTUserName,$sTEMail,$sTMobileNo;
            $ASRet = [];
            $ASRet = explode("^c", $RetCommand);        
            if (count($ASRet) >=2) {
                $sFlagMsg=$ASRet[0];
                $sFlag=$ASRet[1];     
              
                $sShowMsg = '0';
                if ($sFlag != '0') {
                    $sTitle = 'Ticket';

                    $CmdCommand = "call sp_comp_select_ticket('".$LineId."','30/9/2018','30/9/2021')";
                    
                    $RetCommand =send_query($CompanyUrl,$LineId,$CompanyCode,$CmdCommand);
                   
                }
            }
        } 
        /*
        $CmdCommand = "call sp_comp_select_ticket('".$LineId."','30/9/2018','30/9/2021')";                    
        $RetCommand =send_query($CompanyUrl,$LineId,$CompanyCode,$CmdCommand);
        */
    }

    

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-language" content="en-th">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta http-equiv="expires" content="0">
<meta http-equiv="pragma" content="no-cache">


<title><?php echo $sTitle; ?></title>

<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>

 <link rel="stylesheet" href="style.css">

 <style>
    * {box-sizing: border-box}

    /* Set height of body and the document to 100% */
    body, html {
        height: 100%;
        margin: 0;
        font-family: Arial;
    }

    div.scrollmenu {
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
        height: 40px;
        
    }

    div.scrollmenu a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }

    div.scrollmenu a:hover {
        background-color: #777;
    }
    /* Style tab links */

    .tablink {
      
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        color: white;
        display: none;
        padding: 2px;
        height: 100%;
        width: 100%;
    }


    table.tblticket {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }

    table.tblticket td, table.tblticket th {
        
        border: 1px solid black;
        padding: 8px;
    }


    table.tblticket th {
        text-align: right;
        color: blue;
    }
    table.tblticket td {
        text-align: left;
        color: black;
    }




    /* Create two equal columns that floats next to each other */
    .column {
        border: 1px solid black;
        float: left;
        width: 50%;        
        background-color: #f1f1f1;
       
        text-align: center;
        vertical-align: middle;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
        width: 99%;
        padding: 1px;
    }
    /* Style the buttons */
    .btn {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: #f1f1f1;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #ddd;
    }

    .btn.active {
        background-color: #666;
        color: white;
    }
   
   /* The Modal (background) */
   .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 10; /* Sit on top */
        padding-top: 10px; /* Location of the box */
        padding-bottom: 10px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 95%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 10px;
        border: 1px solid #888;
        width: 90%;

        height: 100%; 
        overflow: auto; 
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }



    #tblTicket {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #tblTicket td, #tblTickets th {
        
        border: 1px solid black;
        padding: 8px;
    }


    #tblTicket th {
        /*padding-top: 12px;*
        /*padding-bottom: 12px;*/        
        text-align: right;
        /*background-color: #04AA6D;*/
        color: blue;
    }

</style>
</head>
<body>



    
    <?php if ($sFlag == '0' || $sFlag == '') { echo registerScreen();  
    } else { 
        
       
        if ($RetCommand){
            $asTable = explode("^t", $RetCommand);
            if (count($asTable) >0){
                $arTmp = explode("^f", $asTable[0]);
                if (count($arTmp) >1){
                    $asCol = explode("^c", $arTmp[0]);
                    $asRow = explode("^r", $arTmp[1]);	

                    if (count($asRow) >0){                                        
                        $nRLen = count($asRow);
                        $nCLen = count($asCol);
                        $sTab ="";
                        $sDiv ="";
                        $sPage ="";

                        $nLoop =0;
                        $asTicket = [];
                        $asValue = [];

                        $asGroup = [];

                        for ($n=0;$n<$nRLen;$n++) {
                            $sRow=$asRow[$n];
                        
                            $asData = explode("^c", $sRow);
                            $nDLen = count($asData);
                            if ($nDLen >0){
                                $sTicketNo = $asData[0];
                                $sV = $sTicketNo."^c".$asData[4];
                                if (!in_array($sV, $asTicket)) {
                                    array_push($asTicket, $sV);   
                                    $nLoop =0;
                                   
                                    if (count($asGroup)>0){
                                        if (count($asGroup)==1){
                                            $asD = $asGroup[0];
                                            $_sTicketNo=$asD[0];
                                            $sHtml = "<div id='div".$_sTicketNo."' class='modal'>
                                                <div class='modal-content' >
                                                    <span class='close'
                                                onclick=\"closeClick('div".$_sTicketNo."')\">&times;</span>
                                                    <div style='overflow-x:auto;'>
                                                    <h2>".$_sTicketNo."</h2>";
                                            $sHtml =$sHtml."<div id='div".$_sTicketNo."_".$nLoop."' >";                                            
                                            $sPage ="<table class='tblticket'>";
                                            for ($r=0;$r<$nDLen;$r++) {
                                                $sC = $asCol[$r];
                                                $sD = $asD[$r];
                                                $sPage =$sPage."<tr><th>".$sC
                                                    ."</th><td class='textLeft'>"
                                                    .$sD."</td></tr>";
                                            }
                                            $sHtml =$sHtml.$sPage
                                                ."</table></div><h2></h2></div></div></div>";
                                            echo $sHtml;
                                        } else {  
                                            
                                            $asD = $asGroup[0];
                                            $_sTicketNo=$asD[0];
                                            
                                            $sHtml = "<div id='div".$_sTicketNo."' class='modal'>
                                                <div class='modal-content' >
                                                    <span class='close' onclick=\"closeClick('div".$_sTicketNo."')\">&times;</span>
                                                    <div style='overflow-x:auto;'>
                                                    <h2>".$_sTicketNo."</h2>";

                                            $_sTab ="";
                                            $_sPage ="";
                                            $_nRLen = count($asGroup);
                                            
                                            for ($n=0;$n<$_nRLen;$n++) {
                                                
                                                $_asData=$asGroup[$n];                                                
                                                $_nDLen = count($_asData);
                                                
                                                if ($_nDLen >0){
                                                    $m=$n+1;
                                                    $_sTicketNo = $_asData[0];
                                                    $_sTab =$_sTab."<a class='tablink' href='#' "
                                                        ."onclick=\"openPage('div".$_sTicketNo."_".$n
                                                        ."', this, 'red')\">".$_sTicketNo."(".$m.")</a>";
                    
                                                    $_sPage =$_sPage."<div id='div".$_sTicketNo."_".$n
                                                        ."' class='tabcontent'>";

                                                    $_sPage =$_sPage."<table class='tblticket'>";                                                    
                                                    for ($r=0;$r<$_nDLen;$r++) {
                                                        $sC = $asCol[$r];
                                                        $sD = $_asData[$r];                                                       
                                                        $_sPage =$_sPage."<tr><th>".$sC
                                                            ."</th><td class='textLeft'>".$sD."</td></tr>";
                                                    }                                                    
                                                    $_sPage =$_sPage."</table></div>";
                                                } // if ($_nDLen >0){
                                                
                                            } // for ($n=0;$n<$_nRLen;$n++) {

                                            $_sTab ="<div class='scrollmenu' style='height:45px;'>".$_sTab."</div>";
                                            $sHtml =$sHtml.$_sTab.$_sPage;

                                            $sHtml =$sHtml."<h2></h2></div></div></div>";
                                            echo $sHtml;
                                            
                                        }

                                        $asGroup =[];
                                    } //if (count($asGroup)>0){
                                    
                                } else {
                                    $nLoop++;                                    
                                } //if (!in_array($sV, $asTicket)) {
                                array_push($asGroup,$asData);
                                
                               
                            }
                        }

                        $nRLen = count($asTicket);
                        
                        $nLoop =0;
                        for ($n=0;$n<$nRLen;$n++) {
                            $sRow=$asTicket[$n];
                        
                            $asData = explode("^c", $sRow);
                            $nDLen = count($asData);
                            if ($nDLen >0){
                                $sTicketNo = $asData[0];
                                $sShipTo = $asData[1];
                                if ( $nLoop ==0) {
                                    $sDiv = "<div class='row'>
                                        <div class='column' 
                                            style='background-color:#ddd;border: 1px solid black;'>
                                        <button style = 'float: center;' type='button' 
                                            class='btn' 
                                            onclick=\"openTicketClick('".$sTicketNo."')\"
                                            >".$sTicketNo."\nShip:".$sShipTo."</button> 
                                        
                                        </div>";
                                } else {
                                    $sDiv = $sDiv."<div class='column' 
                                        style='background-color:#ddd;border: 1px solid black;'>
                                    <button style = 'float: center;' type='button' 
                                        class='btn' onclick=\"openTicketClick('".$sTicketNo."')\"
                                        >".$sTicketNo."\nShip:".$sShipTo."</button> 

                                    </div></div>";
                                    $sTab =$sTab.$sDiv;
                                    $nLoop=-1;
                                }                                                                
                                $nLoop++;
                            }
                           
                        }
                      
                        $sTab ="<div style = 'float: center;border: 1px solid black;
                         padding: 4px;'>".$sTab."</div>";
                        echo $sTab;
                        

                    }
                }
            }
        }


    } 



    ?>
      

<input type="hidden" id="txtFlag" value ="<?php echo $sFlag; ?>" >
<input type="hidden" id="txtCompanyCode" value ="<?php echo $CompanyCode; ?>" >
<input type="hidden" id="txtLiffId" value ="<?php echo $LiffId; ?>" >
<input type="hidden" id="txtMsg" value ="<?php echo $sFlagMsg; ?>" >
<input type="hidden" id="txtShowMsg" value ="<?php echo $sShowMsg; ?>" >
<input type="hidden" id="txtRetCommand" value ="<?php echo $RetCommand; ?>" >
<input type="hidden" id="txtLineId"  value ="<?php echo $LiffId; ?>" >
<input type="hidden" id="txtTableTitle"  value ="<?php echo $TableTitle; ?>" >




<script>


    function closeClick(divNo) {        
        document.getElementById(divNo).style.display = "none";       
    }
   
    function modalClick() {   
        var divModal = document.getElementsByClassName("modal");
        for (var i = 0; i < divModal.length; i++) {
            divModal[i].style.display = "none";
        }
    }
    
  

    /***************************************************************************** */
    function openTicketClick(divNo) {
        
        var divModal = document.getElementsByClassName("modal");
        for (var i = 0; i < divModal.length; i++) {
            divModal[i].style.display = "none";
        }
        var sNo = "div"+divNo;
        document.getElementById(sNo).style.display = "block";


        sNo = "div"+divNo+"_0";
        if (document.getElementById(sNo)){
            document.getElementById(sNo).style.display = "block";
        }

        //$_sPage =$_sPage."<div id='div".$_sTicketNo."_".$n
        
    }

    /***************************************************************************** */
        
    function openPage(pageName,elmnt,color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    //document.getElementById("defaultOpen").click();

    /***************************************************************************** */

    window.onload = function() {
        const useNodeJS = false;   // if you are not using a node server, set this value to false
        const defaultLiffId = "1656445468-pPVkELw7";   // change the default LIFF value if you are not using a node server

        let myLiffId = "";
       
        if (useNodeJS) {
            fetch('/send-id')
                .then(function(reqResponse) { return reqResponse.json();})
                .then(function(jsonResponse) {
                    myLiffId = jsonResponse.id;
                    initializeLiffOrDie(myLiffId);
                })
                .catch(function(error) {});
        } else {
            myLiffId = defaultLiffId;
            initializeLiffOrDie(myLiffId);
        }
    };
    
    function initializeLiffOrDie(myLiffId) {
        if (myLiffId) {       
            initializeLiff(myLiffId);
        }
    }
   
    function initializeLiff(myLiffId) {
        liff.init({ liffId: myLiffId })
            .then(() => { initializeApp(); })
            .catch((err) => {});
    }

    
    function initializeApp() {
                    
        if (liff.isLoggedIn()) {
           
            liff.getProfile().then(profile => {                    
                const userId = profile.userId;                        
                if (document.getElementById('txtLineId'))
                    document.getElementById('txtLineId').value = userId;

                if (document.getElementById('txtShowMsg')) {
                    var sShow = document.getElementById('txtShowMsg').value;
                    if (sShow=="1") {
                            var sMsg = document.getElementById('txtMsg').value;
                            if (sMsg.length >0) alert(sMsg);                        
                    }
                }
                // alert(userId);
            })
            .catch((err) => {
                alert(err);
                console.log('error', err);
            });
            
            
        }
        

    }

   
    function RegisterClick(msg){
                
        var sLineId =document.getElementById('lblUserId').textContent;
        var sLineDisplay =document.getElementById('txtDisplay').value;

        var sCompanyCode =document.getElementById('txtCompanyCode').value;
        var sUserName =document.getElementById('txtUserName').value;
        var sEMail =document.getElementById('txtEMail').value;
        var sTel =document.getElementById('txtTel').value;

    
        var sCmd = sLineDisplay+"^c"+sUserName+"^c"+sTel+"^c"+sEMail;

        var para = "?LinkCode=REGISTER&LineId="+sLineId+"&CmdCommand="+sCmd;
        var url = "https://rmxregister.herokuapp.com/frmRegister.php" + para;
            
        liff.login({ redirectUri: url });

        //alert(url);
    }
        
    
    function fillTicketData(tableName,asCol,asData)
    {
              
        var table = document.getElementById(tableName);
        if (table) {
            var sHtml = "";
            var nRLen = asData.length;
            for (var r=0;r<nRLen;r++ ) {
                var sC = asCol[r];
                var sD = asData[r];
                sHtml = sHtml + "<tr><th>"+sC+"</th><td class='textLeft'>"+sD+"</td></tr>";
            }
            table.innerHTML = sHtml;

         
        }
       
    }
    // Get the modal

  

</script>

</body>
</html>

