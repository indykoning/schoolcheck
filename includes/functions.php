<?php
function loggedin($userID, $login_key, $loginIP)
{
    if ($login_key !== '' && !empty($login_key) && !empty($userID) && !empty($loginIP)) {

        if ($loginIP == $_SERVER["REMOTE_ADDR"] && $login_key == $_SESSION['key']) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}
function logout(){
session_start();
$_SESSION['ID'] = '';
$_SESSION['key'] = '';
$_SESSION['IP'] = '';
session_unset();
session_destroy();
header('location: ./');
}

function login($username, $password, $mysqli){
$sql = "SELECT `password`,`id` FROM `users` WHERE username = '" . $username . "'";
$result = $mysqli->query($sql);
if($result){
    $row = $result->fetch_assoc();
    if(
//        password_verify($password, $row['password'])
    hash('whirlpool', $password) == $row['password']
    ){
        echo 'password correct';
//        session_start();
        $_SESSION['ID'] = $row['id'];
        $_SESSION['IP'] = $_SERVER["REMOTE_ADDR"];
        $login_key = hash('whirlpool', rand(0, 500));
        $_SESSION['key'] = $login_key;
    }else{
        echo 'password incorrect';
    }
}else{
    echo 'username possibly incorrect';
}
}

function register($username, $password, $mysqli){
//$password = password_hash($password, PASSWORD_DEFAULT);
    $password = hash('whirlpool', $password);
$sql = "INSERT INTO `users` (`username`, `password`) VALUES ('" . $username ."','" . $password ."')";
$result = $mysqli->query($sql);
if ($result){
    echo 'Register Successfull';
}else{
    echo 'Register Failed';
}

}