<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");

$_POST['emailerr'] = $_POST['otperr'] = "";

if (isset($_POST['sendemail'])) {
    $email = $_POST['email'];
    checkEmail();
} else {
    $email = "";
    $_POST['emailerr'] = "";
}

if (isset($_POST['submitotp'])) {
    checkOTP($_SESSION['otp'], $_POST['otp']);
} else {
    $_POST['otperr'] = "";
}

$form = "";
$form .= "

    <head>
    <link href='forgotpasswordstyle.css' rel='stylesheet' type='text/css'>
    </head>
    <form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
    <center>
    
    <table>
    <tr><td class='image'><img src='resources/SWA white.png' width='300' align='middle'/></td></tr>
    <tr><td>
    
    </table>
    <table class='logintable'>
    <tr><td colspan='3' height='60px' style='text-align:center';><p1>Send an OTP</p1></td></tr>
    
    <tr><td class='logintabletd' align='right' style='padding-right:10px;'>School email:</td><td><input type='text' name='email' value='".$email."' placeholder='user@swa-jkt.com...'></td><td>".$_POST['emailerr']."</td></tr>
    <tr><td class='submit' colspan='3' style='text-align:center';><input type='submit' name='sendemail' value='Send'></td></tr>
    <tr><td class='logintabletd' align='right' style='padding-right:10px;'>Your OTP:</td><td><input type='text' name='otp' value=''></td><td>".$_POST['otperr']."</td></tr>
    <tr><td class='submit' colspan='3' style='text-align:center';><input type='submit' name='submitotp' value='Confirm'></td></tr>

    </center></table>

    </td></tr>
    
    
    </form>
";
echo $form;

if (isset($_POST['sendemail'])) {
    if (checkEmail()) {
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        if (sendEmail($_POST['email'], $otp)) {
            echo "<script>alert('OTP sent. Click OK to continue.')</script>";
        } else {
            echo "<script>alert('Failed to send OTP')</script>";
        }
    }
}

if (isset($_POST['submitotp'])) {
    if (checkOTP($_SESSION['otp'], $_POST['otp'])) {
        $_SESSION['email'] = $_POST['email'];
        header("Location: changepasswordpage.php");
        exit;
    }
}

function checkEmail() {
    if (!filter_var(test_input($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $_POST['emailerr'] = "*invalid";
        return false;
    } elseif ($_POST['email'] == "") {
        $_POST['emailerr'] = "*required";
        return false;
    } elseif (arrayfirst(searchquery("Students", "id", "schoolemail", $_POST['email'])) == null && arrayfirst(searchquery("Counsellors", "id", "schoolemail", $_POST['email'])) == null && arrayfirst(searchquery("Teachers", "id", "schoolemail", $_POST['email'])) == null) {
        $_POST['emailerr'] = "*not found";
        return false;
    }
    return true;
}

function checkOTP($otp, $realotp) {
    if ($realotp == $otp) {
        return true;
    } else {
        $_POST['otperr'] = "incorrect";
        return false;
    }
}