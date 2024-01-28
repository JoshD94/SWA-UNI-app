<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");

$_POST['usertypeerr'] = $_POST['emailerr'] = $_POST['loginerr'] = '';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    validateForm();
} else {
    $email = "";
    $password = "";
}

$form = "";
$form .= "

    <head>
    <link href='loginstyle.css' rel='stylesheet' type='text/css'>
    </head>
    <form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
    <center>
    
    <table>
    <tr><td class='image'><img src='resources/SWA white.png' width='300' align='middle'/></td></tr>
    
    </table>
    <table class='logintable'>
    <tr><td colspan='3' height='60px' style='text-align:center';><p1>Login</p1></td></tr>
    <tr>
    <td class='logintabletd' align='right' style='padding-right:10px;'>I am a:</td>
    <td><select name='usertype'>
	<option value='none'> Select a user type </option>
	<option value='student'>Student</option>
    <option value='counsellor'>Counsellor</option>
    <option value='teacher'>Teacher</option>
    </select></td>
    <td class='errormsg'>".$_POST['usertypeerr']."</td>
    </tr>
    
    <tr><td class='logintabletd' align='right' style='padding-right:10px;'>School email:</td><td><input type='text' name='email' value='".$email."' placeholder='user@swa-jkt.com...'></td><td class='errormsg'>".$_POST['emailerr']."</td></tr>
    <tr><td class='logintabletd' align='right' style='padding-right:10px;'>Password:</td><td width='70px'><input type='password' id='password' name='password' value='".$password."'></td><td height='10px'><input type='checkbox' onclick='showPassword()'>Show</td></tr>
    <tr><td height='5px' class='errormsg' colspan='3'><center>".$_POST['loginerr']."</center></td></tr>
    <tr><td class='forgot' colspan='3'><center><a class='link' href='forgotpasswordpage.php'>Forgot password</a></center></td></tr>
    <tr><td class='submit' colspan='3' style='text-align:center;'><input type='submit' name='loginclicked' value='Login'></td></tr>
    <tr><td colspan='3' height='10px' style='padding-bottom:10px;'><center>New here? Click here to <a class='link' href='signuppage.php'>Signup</a></center></td></tr>
    </center></table>

    </td></tr>

    ".showPassword("password")."
    
    </form>
";
echo $form;

if (isset($_POST['loginclicked'])) {
    if (validateForm()) {
        $usertypetable = '';
        if ($_POST['usertype'] == "student") {
            $usertypetable = "Students";
        } elseif ($_POST['usertype'] == "counsellor") {
            $usertypetable = "Counsellors";
        } elseif ($_POST['usertype'] == "teacher") {
            $usertypetable = "Teachers";
        }
        $userid = arrayfirst(searchquery($usertypetable, "id", "schoolemail", $_POST['email']));
        addlogin($_POST['usertype'], $userid, date("Y-m-d,h:i:s"), "");
        $currentuser = new CurrentUser($_POST['usertype'], $userid);
        header("Location: ".$_POST['usertype']."homepage.php");
        exit;
    }
}

function validateForm() {
    //check usertype
    if ($_POST['usertype'] == "none") {
        $_POST['usertypeerr'] = "*required";
        return false;
    } else {
        $_POST['usertypeerr'] = "";
    }
    //check email
    if (!filter_var(test_input($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $_POST['emailerr'] = "*invalid";
        return false;
    } elseif ($_POST['email'] == "") {
        $_POST['emailerr'] = "*required";
        return false;
    }
    //check password
    $usertypetable = '';
    if ($_POST['usertype'] == "student") {
        $usertypetable = "Students";
    } elseif ($_POST['usertype'] == "counsellor") {
        $usertypetable = "Counsellors";
    } elseif ($_POST['usertype'] == "teacher") {
        $usertypetable = "Teachers";
    }
    if (!password_verify($_POST['password'], arrayfirst(searchquery($usertypetable, "password", "schoolemail", $_POST['email'])))) {
        $_POST['loginerr'] = "Email or password incorrect";
        return false;     
    } else {
        return true;
    }
}