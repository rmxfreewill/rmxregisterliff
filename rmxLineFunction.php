

<?php
ini_set('memory_limit', '-1');


session_start();
include_once("define_Gobal.php");


function updateRegisterFlag($CompanyUrl,$userId,$CompanyId,$sUserName,$sEMail,$sMobileNo){    
    $Command="call sp_main_request_register ('".$userId."','".$CompanyId
        ."','".$sUserName."','".$sEMail."','".$sMobileNo."')";
    $curl_data = "Command=".$Command;
    $response = post_web_content($CompanyUrl,$curl_data);

    return $response;
}


function getFormatTextMessage($text)
{
    $datas = [];
    $datas['type'] = 'text';
    $datas['text'] = $text;
    return $datas;
}

function sentMessage($encodeJson,$datas)
{
    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $datas['url'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $encodeJson,
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer ".$datas['token'],
        "cache-control: no-cache",
        "content-type: application/json; charset=UTF-8",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
             $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}

function sentMultiMessage($encodeJson,$Url,$Token)
{

    $datas['url'] = $Url;
    $datas['token'] = $Token;

    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $datas['url'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $encodeJson,
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer ".$datas['token'],
        "cache-control: no-cache",
        "content-type: application/json; charset=UTF-8",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
             $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}


function sentLineMessage($encodeJson,$Url,$Token)
{

    $datas['url'] = $Url;
    $datas['token'] = $Token;

    $datasReturn = [];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $datas['url'],
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $encodeJson,
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer ".$datas['token'],
        "cache-control: no-cache",
        "content-type: application/json; charset=UTF-8",
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        $datasReturn['result'] = 'E';
        $datasReturn['message'] = $err;
    } else {
        if($response == "{}"){
             $datasReturn['result'] = 'S';
            $datasReturn['message'] = 'Success';
        }else{
            $datasReturn['result'] = 'E';
            $datasReturn['message'] = $response;
        }
    }

    return $datasReturn;
}


function post_web_page( $url,$curl_data )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
           CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch,$options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch) ;
    $header  = curl_getinfo($ch);
    curl_close($ch);

  //  $header['errno']   = $err;
  //  $header['errmsg']  = $errmsg;
  //  $header['content'] = $content;
    return $header;
}




function post_web_content( $url,$curl_data )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,         // return web page
        CURLOPT_HEADER         => false,        // don't return headers
        CURLOPT_FOLLOWLOCATION => true,         // follow redirects
        CURLOPT_ENCODING       => "",           // handle all encodings
        CURLOPT_USERAGENT      => "kai",     // who am i
        CURLOPT_AUTOREFERER    => true,         // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,          // timeout on connect
        CURLOPT_TIMEOUT        => 120,          // timeout on response
        CURLOPT_MAXREDIRS      => 10,           // stop after 10 redirects
        CURLOPT_POST            => 1,            // i am sending post data
           CURLOPT_POSTFIELDS     => $curl_data,    // this are my post vars
        CURLOPT_SSL_VERIFYHOST => 0,            // don't verify ssl
        CURLOPT_SSL_VERIFYPEER => false,        //
        CURLOPT_VERBOSE        => 1                //
    );

    $ch      = curl_init($url);
    curl_setopt_array($ch,$options);
    $content = curl_exec($ch);
    $err     = curl_errno($ch);
    $errmsg  = curl_error($ch) ;
    $header  = curl_getinfo($ch);
    curl_close($ch);

  //  $header['errno']   = $err;
  //  $header['errmsg']  = $errmsg;
  //  $header['content'] = $content;
  
    return trim($content);
}


function line_reply($url,$CompanyToken,$userId,$replyToken,$msg){
    //$msg = "ถามอะไรมาก็ตอบได้ UserId[" . $userId."] ".$text."[replay[".$replyToken."]]";
   
    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    $messages = [];
    $messages['replyToken'] = $replyToken;
    $messages['messages'][0] = getFormatTextMessage($msg);

    $encodeJson = json_encode($messages);

    $results = sentMessage($encodeJson,$LINEDatas);
}

function line_multicast($url,$CompanyToken,$userId,$msg){

    $LINEDatas['url'] = $url;
    $LINEDatas['token'] = $CompanyToken;

    //$msg = "push message \n[" . $userId."]";
    $messages = [];
    $messages['to'][0] = $userId;
    $messages['messages'][0] = getFormatTextMessage($msg);
    
    $encodeJson = json_encode($messages);
    $results = sentMessage($encodeJson,$LINEDatas);
}




function put_request($CompanyUrl,$userId,$CompanyId,$text,$datas){


    $datas1 = str_replace("'", "\'", $datas);
    $text1 = str_replace("'", "\'", $text);
    $Command="call sp_comp_insert_user_resquest ('"
        .$userId."','".$CompanyId."','".$text1."','".$datas1."')";
    //return send_command($CompanyUrl,$userId,$CompanyId,$Command);
    
    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    
    //$response = post_web_page($CompanyUrl,$curl_data);
    $response = post_web_content($CompanyUrl,$curl_data);
    return $response;
    
}



function send_command($CompanyUrl,$userId,$CompanyId,$Command){

    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&Command=".$Command;    
    $response = post_web_content($CompanyUrl,$curl_data);
    return $response;

}

function send_query($CompanyUrl,$userId,$CompanyId,$Command){

    $curl_data = "LineId=".$userId."&CompanyCode=".$CompanyId."&QueryCommand=".$Command;    
    $response = post_web_content($CompanyUrl,$curl_data);
    return $response;

}


function register_command($RegisterUrl,$LineId,$CompanyCode,
        $LineDisplay,$UserName,$Tel,$EMail){

    $curl_data = "LineId=".$LineId."&CompanyCode=".$CompanyCode
        ."&LineDisplay=".$LineDisplay."&UserName=".$UserName
        ."&Tel=".$Tel."&EMail=".$EMail; 

    $response = post_web_content($RegisterUrl,$curl_data);
    return $response;

    /*
http://rmxcell.pe.hu/rmxLineRegister.php
?LineId=t0000-930000330
    &CompanyCode=00001
    &LineDisplay=display
    &UserName=UserName
    &Tel=9983473955
    &EMail=g@g.com
*/
}


function registerScreen(){
    $scr = '<div class="login_container">
    
        <label for="uname"><b>Line Display Name</b></label>
        <input type="text" name="txtDisplay" id="txtDisplay"  readonly>

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="txtUserName"       
        id="txtUserName" required>

        <label for="psw"><b>EMail</b></label>
        <input type="email" placeholder="Enter EMail" name="txtEMail" 
            id="txtEMail" required >
        
        <label for="psw"><b>Telephone / Mobile</b></label>
        <input type="tel" placeholder="Enter Telephone/Mobile" 
            name="txtTel" id="txtTel" 
            pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
        
        <button type="button"  name="btnLogin" id="btnLogin" 
            onclick="RegisterClick()">Register</button>
    
    </div>

    <div id="liffAppContent" class="hidden">
              
        <!-- ACCESS TOKEN DATA -->
        <div id="accessTokenData" class="hidden textLeft">
            <h2>Access Token</h2>
            <a href="#" onclick="toggleAccessToken()">Close Access Token</a>
            <table>
                <tr>
                    <th>accessToken</th>
                    <td id="accessTokenField"></td>
                </tr>
            </table>
        </div>
       
     
        <!-- LIFF DATA -->
        <div id="liffData">
            <h2 id="liffDataHeader" class="textLeft">Line Data</h2>
            <table>
                <tr>
                    <th>User Id</th>
                    <td id="lblUserId" class="textLeft"></td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td id="lblUserName" class="textLeft"></td>
                </tr>
                <tr>
                    <th>OS</th>
                    <td id="deviceOS" class="textLeft"></td>
                </tr>
                <tr>
                    <th>Language</th>
                    <td id="browserLanguage" class="textLeft"></td>
                </tr>
                <tr>
                    <th>LIFF SDK Version</th>
                    <td id="sdkVersion" class="textLeft"></td>
                </tr>
                <tr>
                    <th>LINE Version</th>
                    <td id="lineVersion" class="textLeft"></td>
                </tr>
              
            </table>
        </div>
       
    </div>';
    return $scr;

}

?>
