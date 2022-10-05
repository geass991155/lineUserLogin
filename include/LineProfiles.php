<?php


/**
 * 取得用戶端 Profile
 *
 * @see https://developers.line.biz/en/docs/social-api/getting-user-profiles/
 * @param $code
 * @return bool|mixed|string
 * @throws LineAccessTokenNotFoundException
 */
// function get($code)
// {
//     $accessToken = getAccessToken($code);
//     $headerData = [
//         "content-type: application/x-www-form-urlencoded",
//         "charset=UTF-8",
//         'Authorization: Bearer ' . $accessToken,
//     ];
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
//     curl_setopt($ch, CURLOPT_URL, "https://api.line.me/v2/profile");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//     $result = curl_exec($ch);
//     curl_close($ch);
//     $result = json_decode($result);
//     $result['accessToken2'] = $accessToken;
//     return $result;
// }

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
 * 取得用戶端 Profile 已經有 $accessTokene
 *
 * @param $accessToken
 * @return array
 */
function getLineProfile_access_token($accessToken)
{
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
}

/**
 * id_token解析email
 *
 * @param $id_token, $client_id
 * @return string
 */
function getEmail($id_token, $client_id)
{
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
}

/**
 * 取得用戶端 Access Token
 *
 * @param $code ,$config
 * @return string
 */
function getAccessToken($code, $config)
{
    // $url = "https://api.line.me/oauth2/v2.1/token";
    // $query = "";
    // $query .= "grant_type=" . urlencode("authorization_code") . "&";
    // $query .= "code=" . urlencode($code) . "&";
    // $query .= "redirect_uri=" . urlencode($config["REDIRECT_URI"]) . "&";
    // $query .= "client_id=" . urlencode($config["CLIENT_ID"]) . "&";
    // $query .= "client_secret=" . urlencode($config["CLIENT_SECRET"]) . "&";
    // $header = array(
    //     "Content-Type: application/x-www-form-urlencoded",
    //     "Content-Length: " . strlen($query),
    // );
    // $context = array(
    //     "http" => array(
    //         "method" => "POST",
    //         "header" => implode("\r\n", $header),
    //         "content" => $query,
    //         "ignore_errors" => true,
    //     ),
    // );

    // $res_json = file_get_contents($url, false, stream_context_create($context));
    // $info = json_decode($res_json);

    // // id_token要解碼出email
    // $getdata = getEmail($info->id_token, $config["CLIENT_ID"]);

    // if (empty($info->access_token)) {
    //     echo 'Can Not Find User Access Token';
    // }
    // return array($info->access_token, $getdata);

    $headerData = [
        "content-type: application/x-www-form-urlencoded",
        "charset=UTF-8",
    ];

    $postData = [
        "grant_type" => urlencode("authorization_code"),
        "code" => urlencode($code),
        "redirect_uri" => urlencode($config["REDIRECT_URI"]),
        "client_id" => urlencode($config["CLIENT_ID"]),
        "client_secret" => urlencode($config["CLIENT_SECRET"]),
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
}

/**
 * 傳送訊息給user
 *
 * @param $userid ,$config
 * @return string
 */
function sendMessage($userid, $config)
{

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
                "text" => "Hello, 測試訊息"
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
}

/**
 * 登出，主要註銷access_Token
 *
 * @param $userid ,$config
 * @return string
 */
function getLogout($config, $accessToken)
{
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
}