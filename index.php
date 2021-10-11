<?php
    /*    include_once("index.html"); */

    session_start();

    error_reporting(E_ALL & ~E_NOTICE);
    include_once("rmxLineFunction.php");
  
    $CompanyUrl = COMPANY_URL;
    $CompanyCode = COMPANY_CODE;
    $LiffId = LIFF_ID;

    $Function='';
    if (isset($_POST['Function']))
        $Function = $_POST['Function'];
    if (isset($_GET['Function']))
        $Function = $_GET['Function'];

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
<title>Line</title>


<script charset="utf-8" src="https://static.line-scdn.net/liff/edge/versions/2.3.0/sdk.js"></script>

</head>
<body>
<form class="animate" method="GET" enctype="multipart/form-data" action="index.php">
    <input type="hidden" id="txtCompanyCode" value ="<?php echo $CompanyCode; ?>" >
    <input type="hidden" id="txtFunction" value ="<?php echo $Function; ?>" >
    <input type="hidden" id="txtLiffId" value ="<?php echo $LiffId; ?>" >
    
</form>

<script>


window.onload = function() {

    var LiffId=document.getElementById('txtLiffId').value;

    const useNodeJS = false;   // if you are not using a node server, set this value to false
    const defaultLiffId = "1656445468-pPVkELw7";   // change the default LIFF value if you are not using a node server

    // DO NOT CHANGE THIS
    let myLiffId = "";

    // if node is used, fetch the environment variable and pass it to the LIFF method
    // otherwise, pass defaultLiffId
    if (useNodeJS) {
        fetch('/send-id')
            .then(function(reqResponse) {
                return reqResponse.json();
            })
            .then(function(jsonResponse) {
                myLiffId = jsonResponse.id;
                initializeLiffOrDie(myLiffId);
            })
            .catch(function(error) {
                //document.getElementById("liffAppContent").classList.add('hidden');
               // document.getElementById("nodeLiffIdErrorMessage").classList.remove('hidden');
            });
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
    liff.init({
            liffId: myLiffId
        })
        .then(() => {
            initializeApp();
        })
        .catch((err) => {
           // document.getElementById('lblUserId').textContent = err.error;
            //document.getElementById("liffAppContent").classList.add('hidden');
            //document.getElementById("liffInitErrorMessage").classList.remove('hidden');
        });
}

/**
 * Initialize the app by calling functions handling individual app components
 */
function initializeApp() {
   
    
    
    if (liff.isLoggedIn()) {        

        var sFunction=document.getElementById('txtFunction').value;

        if (sFunction != '') {

            liff.getProfile().then(profile => {            

                const userId = profile.userId;

                var sCompCode=document.getElementById('txtCompanyCode').value;

                var sCmd = "call sp_main_check_register ('"+userId+"','"+sCompCode+"')";
                var para = "?LinkCode=CHECK&LineId="+userId+"&CmdCommand="+sCmd;
                var url = "";

                switch (sFunction) {
                    case "REGISTER":
                        url = "https://rmxregister.herokuapp.com/frmRegister.php" + para;
                        break;
                    case "QUERY":
                        url = "https://rmxregister.herokuapp.com/frmQuery.php" + para;
                        break;
                    case "VIEW":    
                        url = "https://rmxregister.herokuapp.com/frmView.php" + para;
                        break;
                    case "TICKET":    
                        url = "https://rmxregister.herokuapp.com/frmTicket.php" + para;
                        break;
                        
                    default:
                        break;    
                        //code to be executed if n is different from all labels;
                }
                //alert(sFunction);
                liff.login({ redirectUri: url });

               
            
            })
            .catch((err) => {
                console.log('error', err);
            });
        
        }
    }
    //liff.getProfile().userId;

}



</script>

</body>
</html>

