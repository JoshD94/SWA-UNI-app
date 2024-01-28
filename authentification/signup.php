<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
// https://tryphp.w3schools.com/showphp.php?filename=demo_form_validation_complete

//define variables and set empty
$firstname = $middlename = $lastname = $schoolemail = $personalemail = $dob = $sex = $address = $school = $phone = $citizenship = $country = $grade = $graduation = $hlsubject1 = $hlsubject2 = $hlsubject3 = $slsubject1 = $slsubject2 = $slsubject3 = $hlscore1 = $hlscore2 = $hlscore3 = $slscore1 = $slscore2 = $slscore3 = $accomplishments = $activities = $sat = $act = $password = $confirmpassword = "";
$firstnameerr = $middlenameerr = $lastnameerr = $schoolemailerr = $personalemailerr = $doberr = $sexerr = $addresserr = $schoolerr = $phoneerr = $citizenshiperr = $countryerr = $gradeerr = $graduationerr = $hlsubject1err = $hlsubject2err = $hlsubject3err = $slsubject1err = $slsubject2err = $slsubject3err = $hlscore1err = $hlscore2err = $hlscore3err = $slscore1err = $slscore2err = $slscore3err = $accomplishmentserr = $activitieserr = $saterr = $acterr = $passworderr = $confirmpassworderr = "";
$passwordmatch = FALSE;
$_POST['password'] = "";
$_POST['confirmpassword'] = "";

if (empty($_POST['firstname'])) {
    $firstnameerr = "First name required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['firstname']))) {
    $firstnameerr = "Only letters and white space allowed";    
} else {
    $firstname = test_input($_POST['firstname']);
}

if (empty($_POST['middlename'])) {
    $middlenameerr = "";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['middlename']))) {
    $middlenameerr = "Only letters and white space allowed";
} else {
    $middlename = test_input($_POST['middlename']);
}

if (empty($_POST['lastname'])) {
    $lastnameerr = "Last name required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['lastname']))){
    $lastnameerr = "Only letters and white space allowed";
} else {
    $lastname = test_input($_POST['lastname']);
}

if (empty($_POST['schoolemail'])) {
    $schoolemailerr = "School email required";
} elseif (!filter_var(test_input($_POST['schoolemail']), FILTER_VALIDATE_EMAIL)){
    $schoolemailerr = "Invalid email format";
} else {
    $schoolemail = test_input($_POST['schoolemail']);
}

if (empty($_POST['personalemail'])) {
    $personalemailerr = "Personal email required";
} elseif (!filter_var(test_input($_POST['personalemail']), FILTER_VALIDATE_EMAIL)){
    $personalemailerr = "Invalid email format";
} else {
    $personalemail = test_input($_POST['personalemail']);
    $personalemailerr = "";
}

if (empty($_POST['dob'])) {
    $doberr = "Date of birth required";
} elseif(!validateDate($_POST['dob'])){
    $doberr = "Enter a valid date";
} else {
    $dob = test_input($_POST['dob']);
    $doberr = "";
}

if (empty($_POST['sex'])) {
    $sexerr = "Sex required";
} else {
    $sex = test_input($_POST['sex']);
    if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['lastname']))) {
        $sexerr = "Only letters and white space allowed";
      }
}

if (empty($_POST['address'])) {
    $addresserr = "Address required";
} else {
    $address = test_input($_POST['address']);
    if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['address']))) {
        $addresserr = "Only letters and white space allowed";
      }
}

if (empty($_POST['school'])) {
    $schoolerr = "School name required";
} else {
    $school = test_input($_POST['school']);
    if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['school']))) {
        $schoolerr = "Only letters and white space allowed";
      }
}

if (empty($_POST['phone'])) {
    $phoneerr = "Phone number required";
} elseif (!is_numeric($_POST['phone'])){
    $phoneerr = "Only numbers allowed in phone number";
} else {
    $phone = test_input($_POST['phone']);
    $phoneerr = "";
}

if (empty($_POST['citizenship'])) {
    $citizenshiperr = "Citizenship required";
} else {
    $citizenship = test_input($_POST['citizenship']);
    if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['citizenship']))) {
        $citizenshiperr = "Only letters and white space allowed";
      }
}

if (empty($_POST['country'])) {
    $countryerr = "Country required";
} else {
    $country = test_input($_POST['country']);
    if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['country']))) {
        $countryerr = "Only letters and white space allowed";
      }
}

if (empty($_POST['grade'])) {
    $gradeerr = "Current grade required";
} else {
    $grade = test_input($_POST['grade']);
    if (!is_numeric($_POST['grade'])) {
        $gradeerr = "Please input a grade in numbers";
      }
}

if (empty($_POST['graduation'])) {
    $graduationrr = "Graduation required";
} else {
    $graduation = test_input($_POST['graduation']);
    if (!is_numeric($_POST['graduation'])) {
        $graduationerr = "Please input a valid year";
      }
}

if (empty($_POST['hlsubject1'])) {
    $hlsubject1err = "Hl Subject required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['hlsubject1']))){
    $hlsubject1err = "Only letters and white space allowed";
} else {
    $hlsubject1 = test_input($_POST['hlsubject1']);
    $hlsubject1err = "";
}

if (empty($_POST['hlsubject2'])) {
    $hlsubject2err = "Hl Subject required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['hlsubject2']))){
    $hlsubject2err = "Only letters and white space allowed";
} else {
    $hlsubject2 = test_input($_POST['hlsubject2']);
    $hlsubject2err = "";
}

if (empty($_POST['hlsubject3'])) {
    $hlsubject3err = "Hl Subject required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['hlsubject3']))){
    $hlsubject3err = "Only letters and white space allowed";
} else {
    $hlsubject3 = test_input($_POST['hlsubject3']);
    $hlsubject3err = "";
}

if (empty($_POST['slsubject1'])) {
    $slsubject1err = "Sl Subject required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['slsubject1']))){
    $slsubject1err = "Only letters and white space allowed";
} else {
    $slsubject1 = test_input($_POST['slsubject1']);
    $slsubject1err = "";
}

if (empty($_POST['slsubject2'])) {
    $slsubject2err = "Sl Subject required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['slsubject2']))){
    $slsubject2err = "Only letters and white space allowed";
} else {
    $slsubject2 = test_input($_POST['slsubject2']);
    $slsubject2err = "";
}

if (empty($_POST['slsubject3'])) {
    $slsubject3err = "Sl Subject required";
} elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['slsubject3']))){
    $slsubject3err = "Only letters and white space allowed";
} else {
    $slsubject3 = test_input($_POST['slsubject3']);
    $slsubject3err = "";
}

if (empty($_POST['hlscore1'])) {
    $hlscore1err = "HL score required";
} else {
    $hlscore1 = test_input($_POST['hlscore1']);
    if ($_POST['hlscore1'] > 7 || $_POST['hlscore1'] < 0) {
        $hlscore1err = "Please input score between 0-7";
      }
}

if (empty($_POST['hlscore2'])) {
    $hlscore2err = "HL score required";
} else {
    $hlscore2 = test_input($_POST['hlscore2']);
    if ($_POST['hlscore2'] > 7 || $_POST['hlscore2'] < 0) {
        $hlscore2err = "Please input score between 0-7";
      }
}

if (empty($_POST['hlscore3'])) {
    $hlscore3err = "HL score required";
} else {
    $hlscore3 = test_input($_POST['hlscore3']);
    if ($_POST['hlscore3'] > 7 || $_POST['hlscore3'] < 0) {
        $hlscore3err = "Please input score between 0-7";
      }
}

if (empty($_POST['slscore1'])) {
    $slscore1err = "SL score required";
} else {
    $slscore1 = test_input($_POST['slscore1']);
    if ($_POST['slscore1'] > 7 || $_POST['slscore1'] < 0) {
        $slscore1err = "Please input score between 0-7";
      }
}

if (empty($_POST['slscore2'])) {
    $slscore2err = "SL score required";
} else {
    $slscore2 = test_input($_POST['slscore2']);
    if ($_POST['slscore2'] > 7 || $_POST['slscore2'] < 0) {
        $slscore2err = "Please input score between 0-7";
      }
}

if (empty($_POST['slscore3'])) {
    $slscore3err = "SL score required";
} else {
    $slscore3 = test_input($_POST['slscore3']);
    if ($_POST['slscore3'] > 7 || $_POST['slscore3'] < 0) {
        $slscore3err = "Please input score between 0-7";
      }
}

if (empty($_POST['accomplishments'])) {
    $accomplishmentserr = "";
} else {
    $accomplishments = test_input($_POST['accomplishments']);
}

if (empty($_POST['activities'])) {
    $activitieserr = "";
} else {
    $activities = test_input($_POST['activities']);
}

if (empty($_POST['sat'])) {
    $saterr = "";
} else {
    $sat = test_input($_POST['sat']);
    if (!is_numeric($_POST['sat'])) {
        $saterr = "Please input a number";
      }
}

if (empty($_POST['act'])) {
    $acterr = "";
} else {
    $act = test_input($_POST['act']);
    if (!is_numeric($_POST['act'])) {
        $sacterr = "Please input a number";
      }
}

if (empty($_POST['password'])) {
    $passworderr = "Please input a password";
} else {
    $password = $_POST['password'];
    if (strlen($_POST['password']) < 8 || !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['password']) || str_contains($_POST['password'], "123456789")) {
        $passworderr = "Password must be at least 8 characters long with a symbol and number";
      }
}

if ($_POST['confirmpassword'] != $_POST['password']) {
    $confirmpassworderr = "Password does not match";
    $passwordmatch = FALSE;
} elseif (empty($_POST['confirmpassword']) || empty($_POST['password'])){
    $confirmpassworderr = "";
    $passwordmatch = FALSE;
} else {
    $confirmpassword = $_POST['confirmpassword'];
    $confirmpassworderr = "";
    $passwordmatch = TRUE;
}

if (isset($_POST['reset'])) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = NULL;
    }
    $firstname = $middlename = $lastname = $schoolemail = $personalemail = $dob = $sex = $address = $school = $phone = $citizenship = $country = $grade = $graduation = $hlsubject1 = $hlsubject2 = $hlsubject3 = $slsubject1 = $slsubject2 = $slsubject3 = $hlscore1 = $hlscore2 = $hlscore3 = $slscore1 = $slscore2 = $slscore3 = $accomplishments = $activities = $sat = $act = $password = $confirmpassword = "";
    $firstnameerr = $middlenameerr = $lastnameerr = $schoolemailerr = $personalemailerr = $doberr = $sexerr = $addresserr = $schoolerr = $phoneerr = $citizenshiperr = $countryerr = $gradeerr = $graduationerr = $hlsubject1err = $hlsubject2err = $hlsubject3err = $slsubject1err = $slsubject2err = $slsubject3err = $hlscore1err = $hlscore2err = $hlscore3err = $slscore1err = $slscore2err = $slscore3err = $accomplishmentserr = $activitieserr = $saterr = $acterr = $passworderr = $confirmpassworderr = "";
}

$form = "

<form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
<table>
<tr><span class='error'>* required field</span></tr>

<tr><td>First name: </td><td> <input type='text' name='firstname' value='".$firstname."'></td><td>*".$firstnameerr."</td></tr>
<tr><td>Middle name: </td><td> <input type='text' name='middlename' value='".$middlename."'></td><td>".$middlenameerr."</td></tr>
<tr><td>Last name: </td><td> <input type='text' name='lastname' value='".$lastname."'></td><td>*".$lastnameerr."</td></tr>
<tr><td>School email: </td><td> <input type='text' name='schoolemail' value='".$schoolemail."'l'></td><td>*".$schoolemailerr."</td></tr>
<tr><td>Personal email: </td><td> <input type='text' name='personalemail' value='".$personalemail."'></td><td>*".$personalemailerr."</td></tr>
<tr><td>Date of birth: </td><td> <input type='text' name='dob' value='".$dob."'></td><td>*".$doberr."</td></tr>
<tr><td>Sex: </td><td> <input type='text' name='sex'value='".$sex."'><td>*".$sexerr."</td></tr>
<tr><td>Address: </td><td> <input type='text' name='address' value='".$address."'></td><td>*".$addresserr."</td></tr>
<tr><td>School: </td><td> <input type='text' name='school' value='".$school."'></td><td>*".$schoolerr."</td></tr>
<tr><td>Phone number: </td><td> <input type='text' name='phone' value='".$phone."'></td><td>*".$phoneerr."</td></tr>
<tr><td>Citizenship: </td><td> <input type='text' name='citizenship' value='".$citizenship."'> </td><td>*".$citizenshiperr."</td></tr>
<tr><td>Country: </td><td> <input type='text' name='country' value='".$country."'></td><td>*".$countryerr."</td></tr>
<tr><td>Current grade: </td><td> <input type='text' name='grade' value='".$grade."'></td><td>*".$gradeerr."</td></tr>
<tr><td>Graduation year: </td><td> <input type='text' name='graduation' value='".$graduation."''></td><td>".$graduationerr."</td></tr>
<tr><td>HL Subject 1: <input type='text' name='hlsubject1' value='".$hlsubject1."'' size='9'> </td><td>*".$hlsubject1err."</td><td> Score: <input type='text' name='hlscore1'  value='".$hlscore1."'size='4'></td><td>*".$hlscore1err."</td></trd>
<tr><td>HL Subject 2: <input type='text' name='hlsubject2' value='".$hlsubject2."'' size='9'> </td><td>*".$hlsubject2err."</td><td> Score: <input type='text' name='hlscore2'  value='".$hlscore2."'size='4'></td><td>*".$hlscore2err."</td></trd>
<tr><td>HL Subject 3: <input type='text' name='hlsubject3' value='".$hlsubject3."'' size='9'> </td><td>*".$hlsubject3err."</td><td> Score: <input type='text' name='hlscore3'  value='".$hlscore3."'size='4'></td><td>*".$hlscore3err."</td></trd>
<tr><td>SL Subject 1: <input type='text' name='slsubject1' value='".$slsubject1."'' size='9'> </td><td>*".$slsubject1err."</td><td> Score: <input type='text' name='slscore1'  value='".$slscore1."'size='4'></td><td>*".$slscore1err."</td></trd>
<tr><td>SL Subject 2: <input type='text' name='slsubject2' value='".$slsubject2."'' size='9'> </td><td>*".$slsubject2err."</td><td> Score: <input type='text' name='slscore2'  value='".$slscore2."'size='4'></td><td>*".$slscore2err."</td></trd>
<tr><td>SL Subject 3: <input type='text' name='slsubject3' value='".$slsubject3."'' size='9'> </td><td>*".$slsubject3err."</td><td> Score: <input type='text' name='slscore3'  value='".$slscore3."'size='4'></td><td>*".$slscore3err."</td></trd>
<tr><td>Accomplishments: </td><td> <input type='text' name='accomplishments' value='".$accomplishments."'></td><td>*".$accomplishmentserr."</td></tr>
<tr><td>Activities: </td><td> <input type='text' name='activities' value='".$activities."''></td><td>*".$activitieserr."</td></tr>
<tr><td>SAT score: </td><td> <input type='text' name='sat' value='".$sat."'</td><td>*".$saterr."</td></tr>
<tr><td>ACT score: </td><td> <input type='text' name='act' value='".$act."'</td><td>*".$acterr."</td></tr>
<tr><td>Password: </td><td> <input type='password' name='password' value='".$password."'></td><td>*".$passworderr."</td></tr>
<tr><td>Confirm password: </td><td> <input type='password' name='confirmpassword' value='".$confirmpassword."'></td><td>*".$confirmpassworderr."</td></tr>

";


$form .= "

<tr><td><input type='submit'></td><td><input type='submit' name='reset' value='Reset'></td></tr>
</table>
</form>

";

echo($form);
if ($passwordmatch) {
    // addstudentquery($_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['schoolemail'], $_POST['personalemail'], $_POST['dob'], $_POST['sex'], $_POST['address'], $_POST['school'], $_POST['phone'], $_POST['password'], "imagehere", $_POST['citizenship'], $_POST['country'], intval($_POST['grade']), $_POST['graduation'], $_POST['hlsubject1'].", ".$_POST['hlsubject2'].", ".$_POST['hlsubject3'], $_POST['slsubject1'].", ".$_POST['slsubject2'].", ".$_POST['slsubject3'], $_POST['hlscore1'].", ".$_POST['hlscore2'].", ".$_POST['hlscore3'], $_POST['slscore1'].", ".$_POST['slscore2'].", ".$_POST['slscore3'], $_POST['accomplishments'], $_POST['activities'], $_POST['sat'], $_POST['act']);
    // addstudentquery("David", "Shane", "Goh", "23davidg@swa-jkt.com", "david@gmail.com", "2005-1-01", "male", "Jakarta", "Sinarmas World Academy", "8111399275", "password", "qwertyuiop", "Indonesia", "Indonesia", "11", "2023", "Math, Physics, Chemistry", "Chinese, English, Economics", "7, 7, 7", "6, 6, 6", "Math olimpiades", "Badminton Club", "1340", "26");
    $hlsubjects = $hlsubject1.", ".$hlsubject2.", ".$hlsubject3;
    $slsubjects = $slsubject1.", ".$slsubject2.", ".$slsubject3;
    $hlscores = $hlscore1.", ".$hlscore2.", ".$hlscore3;
    $slscores = $slscore1.", ".$slscore2.", ".$slscore3;
    //addstudentquery($firstname, $middlename, $lastname, $schoolemail, $personalemail, $dob, $sex, $address, $school, $phone, password_hash($password, PASSWORD_DEFAULT), "imagehere", $citizenship, $country, $grade, $graduation, $hlsubjects, $slsubjects, $hlscores, $slscores, $accomplishments, $activities, $sat, $act);
    echo "User created";
}