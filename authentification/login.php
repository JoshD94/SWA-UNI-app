<?php
// session_start();
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");

$usertype = $email = $password = "";
$usertypeerr = $emailerr = $passworderr = "";
$_POST = array();

if (empty($_POST['usertype'])) {
    $usertypeerr = "*Please select a user type";
} else {
    $usertype = $_POST['usertype'];
}

if (empty($_POST['email'])) {
    $emailerr = "*Enter your school email";
} elseif (!filter_var(test_input($_POST['email']), FILTER_VALIDATE_EMAIL)){
    $emailerr = "*Invalid email format";
} elseif (arrayfirst(searchquery($usertype, "id", "schoolemail", $email)) == null) {
    $emailerr = "*Email not found";
} else {
    $email = $_POST['email'];
}

if (empty($_POST['password'])) {
    $passworderr = "*Please input a password";
} elseif (!password_verify($_POST['password'], arrayfirst(searchquery($usertype, "password", "schoolemail", $email)))){
    $passworderr = "*Incorrect password";
} else {
    $password = $_POST['password'];
}

$form = "";
$form .=
"
<form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
<table>
<tr><td>I am a</td><td>
<select name='usertype'>
	<option value=''>--- Select a user type ---</option>
	<option ";
    if(isset($_POST["usertype"]) && $_POST["usertype"] == "Students"){
        $form .= "selected='selected'";
    };
    $form .= " value='Students'>Student</option>
	<option ";
    if(isset($_POST["usertype"]) && $_POST["usertype"] == "Counsellors"){
        $form .= "selected='selected'";
    };
    $form .= " value='Counsellors'>Counsellor</option>
	<option ";
    if(isset($_POST["usertype"]) && $_POST["usertype"] == "Teachers"){
        $form .= "selected='selected'";
    };
    $form .= " value='Teachers'>Teacher</option>
</select>
</td><td>".$usertypeerr."</td></tr>
<tr><td>School email: </td><td> <input type='text' name='email' value='".$email."'></td><td>".$emailerr."</td></tr>
<tr><td>Password: </td><td> <input type='password' name='password' value='".$password."'></td><td>".$passworderr."</td></tr>
</table>

<input type='submit'>
</form>
";

echo $form;

if ($password != "") {
    $_SESSION['userid'] = arrayfirst(searchquery($usertype, 'id', 'schoolemail', $email));
    $_SESSION['usertype'] = $usertype;
    $_SESSION['cid'] = 3;
    $currentuser->getinfo();
}

echo "<a href='/CS-IA/home.php'>link</a>";
//TODO: make logout button, and logout when browser exited or session expires