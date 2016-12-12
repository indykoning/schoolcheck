<?php
require_once "includes/database.php";
require_once 'includes/functions.php';
session_start();
if(!empty($_GET['logout'])){
    logout();
}
if(!empty($_POST['Username'])&&!empty($_POST['Password'])){
if(!empty($_POST['loginSubmit'])){
    login($_POST['Username'], $_POST['Password'], $mysqli);
}elseif (!empty($_POST['registerSubmit'])){
//    register($_POST['Username'], $_POST['Password'], $mysqli);
}
}
if(loggedin($_SESSION['ID'],$_SESSION['key'],$_SESSION['IP'])) {
    require_once "includes/database.php";
    include_once "includes/nav.php";
    $target = (isset($_GET['page']) && file_exists('views/' . $_GET['page'] . '.php')) ? $_GET['page'] : 'home';
    require_once 'views/' . $target . '.php';
}else{
    echo 'user not logged in';
    ?>
    <p id="switchButton">don't have an account? Register</p>
<form  id="loginForm" name="loginForm" method="post">
    <table>
        <tr><td>Username</td><td><input required name="Username" placeholder="Username" type="text"></td></tr>
        <tr><td>Password</td><td><input required name='Password' placeholder="Password" type="password"></td></tr>
        <tr><td></td><td><input type="submit" name="loginSubmit" value="Log in"></td></tr>
    </table>
</form>

    <form style="display: none" id="registerForm" name="registerForm" method="post">
    <table>
        <p>voor nu uit</p>
        <tr><td>Username</td><td><input disabled required name="Username" placeholder="Username" type="text"></td></tr>
        <tr><td>Password</td><td><input disabled required name="Password" placeholder="Password" type="password"></td></tr>
        <tr><td></td><td><input type="submit" name="registerSubmit" value="Register"></td></tr>
    </table>
</form>
    <script>
        var switchButton = document.getElementById('switchButton');
        var login = 1;
        switchButton.addEventListener('click', function (){
         if(login){
             switchButton.innerHTML = 'Already have an account? Log in';
             document.getElementById('registerForm').style.display = 'block';
             document.getElementById('loginForm').style.display = 'none';
             login = 0;
         }else{
             switchButton.innerHTML = "don't have an account? Register";
             document.getElementById('registerForm').style.display = 'none';
             document.getElementById('loginForm').style.display = 'block';
             login = 1;
         }
        });

    </script>
<?php
}