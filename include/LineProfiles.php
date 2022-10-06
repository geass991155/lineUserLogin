<?php

/**
 * 去到line登入頁面
 *
 * @param $config
 * @return string
 */
function goLineLgoin($config)
{
    $state = sha1(time());

    $scope = str_replace(",", "%20", $config["SCOPE"]);
    $parameter = [
        'response_type' => 'code',
        'client_id' => $config["CLIENT_ID"],
        'redirect_uri' => $config["REDIRECT_URI"],
        'state' => $state,
    ];

    $host = "https://access.line.me/oauth2/v2.1/authorize";

    $url = $host . "?" . http_build_query($parameter) . "&scope=" . $scope;
    return $url;
}

/**
 * 取得用戶端 Profile 已經有 $accessTokene，拿到userid、username等
 *
 * @param $accessToken
 * @return array
 */
function getLineProfile_access_token($accessToken)
{
    try {
        $headerData = [
            "content-type: application/json",
            "charset=UTF-8",
            'Authorization: Bearer ' . $accessToken,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/profile");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
        $result = curl_exec($ch);
        $decode_user_data = json_decode((string)$result, true);
    
        curl_close($ch);
    
        return $decode_user_data;
    } catch (Exception $e) {
        echo "<script> window.alert('無法與伺服器連線，請稍後。');</script>";
        return $e;
    } 
    
}

/**
 * id_token解析email
 *
 * @param $id_token, $client_id
 * @return string
 */
function getEmail($id_token, $client_id)
{
    try {
        $headerData = [
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
        ];
    
        $postData = [
            "id_token" => $id_token,
            "client_id" => $client_id
        ];
        $data = http_build_query($postData);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/oauth2/v2.1/verify");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); //設定傳送方式為post請求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //設定post的資料
    
        $result = curl_exec($ch);
        $info = json_decode($result);
    
        curl_close($ch);
    
        return $info;
    } catch (Exception $e) {
        echo "<script> window.alert('無法與伺服器連線，請稍後。');</script>";
        return $e;
    }
    
}

/**
 * 取得用戶端 Access Token
 *
 * @param $code ,$config
 * @return string
 */
function getAccessToken($code, $config)
{
    try {
        $headerData = [
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
        ];
    
        $postData = [
            "grant_type" => "authorization_code",
            "code" => $code,
            "redirect_uri" => $config["REDIRECT_URI"],
            "client_id" => $config["CLIENT_ID"],
            "client_secret" => $config["CLIENT_SECRET"],
        ];
        $data = http_build_query($postData);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/oauth2/v2.1/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); //設定傳送方式為post請求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //設定post的資料
    
        $result = curl_exec($ch);
        $info = json_decode($result);
        
        curl_close($ch);
    
        // id_token要解碼出email
        $getdata = getEmail($info->id_token, $config["CLIENT_ID"]);
    
        return array($info->access_token, $getdata);
    } catch (Exception $e) {
        echo "<script> window.alert('無法與伺服器連線，請稍後。');</script>";
        return $e;
    }
    
}

/**
 * 傳送訊息給user
 *
 * @param $userid ,$config
 * @return string
 */
function sendMessage($userid, $config, $message)
{
    try {
        $headerData = [
            "content-type: application/json",
            "charset=UTF-8",
            'Authorization: Bearer ' . $config["BEARER_TOKEN"],
        ];
    
        $postData = array(
            "to" => $userid,
            "messages" => [
                [
                    "type" => "text",
                    "text" => "Messages：".$message
                ]
            ],
        );
        $data = json_encode($postData);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/bot/message/push");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); //設定傳送方式為post請求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //設定post的資料
    
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    } catch (Exception $e) {
        echo "<script> window.alert('訊息無法傳遞，請重新嘗試');</script>";
        return $e;
    } 
    
}

/**
 * 登出，主要註銷access_Token
 *
 * @param $userid ,$config
 * @return string
 */
function getLogout($config, $accessToken)
{
    try {
        $headerData = [
            "content-type: application/x-www-form-urlencoded",
            "charset=UTF-8",
            'Authorization: Bearer ' . $config["BEARER_TOKEN"],
        ];
    
        $postData = array(
            "client_id" => $config["CLIENT_ID"],
            "client_secret" => $config["CLIENT_SECRET"],
            "access_token" => $accessToken,
        );
        
        $data = http_build_query($postData);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
        curl_setopt($ch, CURLOPT_URL, "https://api.line.me/oauth2/v2.1/revoke");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); //設定傳送方式為post請求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //設定post的資料
    
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }  catch (Exception $e) {
        echo "<script> window.alert('無法與伺服器連線，請稍後。');</script>";
        return $e;
    }
    
}