<?php
include_once('config.php');

if (get('action') == 'login') {
    // Random Hash stored in session for security.
    $_SESSION['state'] = hash('sha256', microtime(TRUE).rand().$_SERVER['REMOTE_ADDR']);
    unset($_SESSION['access_token']);
    
    $params = array(
        'client_id' => OAUTH2_CLIENT_ID,
        'redirect_uri' => CALLBACK_URL,
        'response_type' => 'code',
        'scope' => SCOPE,
        'state' => $_SESSION['state']
    );
    
    //Redirect to Discord Auth Page
    header('Location: ' . AUTH_URL . '?' . http_build_query($params));
    die();
}

if (get('action') == 'logout') {
    session_destroy();
    header('Location: ' . SITE_URL . '/auth');
    die();
}

if (get('code')) {
    if(!get('state') || $_SESSION['state'] != get('state')) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die();
    }
    
    //Exchange auth_code for token
    $token = apiRequest(TOKEN_URL, true, array (
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
        'grant_type' => 'authorization_code',
        'code' => get('code'),
        'redirect_uri' => CALLBACK_URL,
        'scope' => SCOPE
    ));
    $_SESSION['access_token'] = $token->access_token;
    
    header('Location: ' . $_SERVER['PHP_SELF']);
}

if(session('access_token')) {
    $user = apiRequest(URL_BASE, false, '');
    $_SESSION['user'] = $user;

    // Insert info into db
    include_once(GLOBAL_URL.'/server/connect.php');
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT IGNORE INTO users (id, username, discriminator, avatar) VALUES ('$user->id', '$user->username', '$user->discriminator', '$user->avatar'); ";

    $result = $conn->query($sql);

    if (!$result) {
        die('Could not query:' . mysqli_error($conn));
    }

    include_once(GLOBAL_URL.'/home.php');

} else {
    header('location: '.SITE_URL.'?action=login');
    exit();
}

// Functions
function apiRequest($url, $post, $params) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }
    
    if (session('access_token')) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'authorization: Bearer ' . session('access_token'),
            'cache-control: no-cache',
            'Accept: application/json'
        ));
    }
    
    $data = curl_exec($ch);
    return json_decode($data);
}

function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
?>