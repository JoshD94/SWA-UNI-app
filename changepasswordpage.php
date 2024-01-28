<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");

$email = $_SESSION['email'];

if (isset($_POST['changepasswordbutton'])) {
    checkPassword();
} else {
    $_POST['passworderr'] = "";
    $_POST['password'] = "";
    $_POST['confirmpassword'] = "";
}

$form = "";
$form .= "

    <head>
    <link href='changepasswordstyle.css' rel='stylesheet' type='text/css'>
    </head>
    <form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
    <center>
    
    <table>
    <tr><td class='image'><img src='resources/SWA white.png' width='300' align='middle'/></td></tr>
    <tr><td>
    
    </table>
    <table class='logintable'>
    <tr><td colspan='2' height='60px' style='text-align:center';><p1>Change Password</p1></td></tr>
    <tr><td class='logintabletd' align='right' style='padding-right:10px;'>Password:</td><td><input type='password' id='password' name='password' value=''></td>
    <tr><td class='logintabletd' align='right' style='padding-right:10px;'>Confirm Password:</td><td><input type='password' id='confirmpassword' name='confirmpassword' value=''>
    <tr><td colspan='2' class='errormsg'><center>".$_POST['passworderr']."</center></td></tr>
    <tr><td colspan='2' align='center' height='10px'><input type='checkbox' onclick='showPassword()'>Show Password</td></tr>
    <tr><td class='submit' colspan='2' style='text-align:center';><input type='submit' name='changepasswordbutton' value='Submit'></td></tr>
    </center></table>

    </td></tr>
    <script>
    function showPassword() {
        var x = document.getElementById('password');
        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
        var x = document.getElementById('confirmpassword');
        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
    }
    </script>
    </form>
";
echo $form;

function checkPassword() {
    if ($_POST['password'] == $_POST['confirmpassword'] and $_POST['password'] != "") {
        return true;
    } else {
        $_POST['passworderr'] = 'Passwords do not match';
        return false;
    }
}

if (checkPassword()) {
    updatevalue(findUserTypeFromEmail($email), "password", password_hash($_POST['password'], PASSWORD_DEFAULT), "schoolemail", $email);
    echo "<script>alert('Password successfully changed')</script>";
    header("Location: loginpage.php");
    exit;
}