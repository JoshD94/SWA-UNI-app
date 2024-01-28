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
    <link href='signupstyle.css' rel='stylesheet' type='text/css'>
    </head>
    <form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>

    <center>
    
    <table>
    <tr><td class='image'><img src='resources/SWA white.png' width='300' align='middle'/></td></tr>
    </table>

    <table class='logintable'>
    <tr><td colspan='3' height='60px' style='text-align:center';><p1>Sign Up</p1></td></tr>
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
    <tr><td class='submit' colspan='3' style='text-align:center';><input type='submit' name='loginclicked' value='Sign Up'></td></tr>
    </center></table>
    
    </center>

    ".showPassword("password")."

    </form>
";
echo $form;

if (isset($_POST['loginclicked'])) {
    if (validateForm()) {
        $usertypetable = '';
        if ($_POST['usertype'] == "student") {
            $usertypetable = "Students";
            addstudentquery("", "", "", $_POST['email'], "", "0000-0-0", "", "", "", "", password_hash($_POST['password'], PASSWORD_DEFAULT), "", "", "", 0, "", "", "", "", "", "", "", "", "");
        } elseif ($_POST['usertype'] == "counsellor") {
            $usertypetable = "Counsellors";
            addcounsellorquery("", "", "", $_POST['email'], "", "0000-0-0", "", "", "", "", password_hash($_POST['password'], PASSWORD_DEFAULT), "");
        } elseif ($_POST['usertype'] == "teacher") {
            $usertypetable = "Teachers";
            addteacherquery("", "", "", $_POST['email'], "", "0000-0-0", "", "", "", "", password_hash($_POST['password'], PASSWORD_DEFAULT), "", "");
        }
        // $userid = arrayfirst(searchquery($usertypetable, "id", "schoolemail", $_POST['email']));
        // addlogin($_POST['usertype'], $userid, date("Y-m-d,h:i:s"), "");
        $userid = arrayfirst(searchquery($usertypetable, "id", "schoolemail", $_POST['email']));
        addlogin($_POST['usertype'], $userid, date("Y-m-d,h:i:s"), "");
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
    if (strlen($_POST['password']) < 8) {
        $_POST['loginerr'] = "*At least 8 characters";
        return false;
    } else if (!preg_match( '/[^A-Za-z0-9]+/', $_POST['password'])) {
        $_POST['loginerr'] = "*Must be alphanumeric";
        return false;
    } else {
        return true;
    }
}