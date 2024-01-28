<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();
$_POST['pfp'] = arrayfirst(searchquery($currentuser->usertype, "profileimage", "id", $currentuser->userid));
if (!isset($_POST['firstname'])) {

    $_POST['firstname'] = $firstname = arrayfirst(searchquery($currentuser->usertype, "firstname", "id", $currentuser->userid));
    $_POST['middlename'] = $middlename = arrayfirst(searchquery($currentuser->usertype, "middlename", "id", $currentuser->userid));
    $_POST['lastname'] = $lastname = arrayfirst(searchquery($currentuser->usertype, "lastname", "id", $currentuser->userid));
    $_POST['schoolemail'] = $schoolemail = arrayfirst(searchquery($currentuser->usertype, "schoolemail", "id", $currentuser->userid));
    $_POST['personalemail'] = $personalemail = arrayfirst(searchquery($currentuser->usertype, "personalemail", "id", $currentuser->userid));
    $_POST['dob'] = $dob = arrayfirst(searchquery($currentuser->usertype, "dob", "id", $currentuser->userid));
    $_POST['sex'] = $sex = arrayfirst(searchquery($currentuser->usertype, "sex", "id", $currentuser->userid));
    $_POST['address'] = $address = arrayfirst(searchquery($currentuser->usertype, "address", "id", $currentuser->userid));
    $_POST['school'] = $school = arrayfirst(searchquery($currentuser->usertype, "school", "id", $currentuser->userid));
    $_POST['phone'] = $phone = arrayfirst(searchquery($currentuser->usertype, "phone", "id", $currentuser->userid));
    $_POST['citizenship'] = $citizenship = arrayfirst(searchquery($currentuser->usertype, "citizenship", "id", $currentuser->userid));
    $_POST['country'] = $country = arrayfirst(searchquery($currentuser->usertype, "country", "id", $currentuser->userid));
    $_POST['grade'] = $grade = arrayfirst(searchquery($currentuser->usertype, "grade", "id", $currentuser->userid));
    $_POST['graduation'] = $graduation = arrayfirst(searchquery($currentuser->usertype, "graduation", "id", $currentuser->userid));
    
    $_POST['hlsubjects'] = $hlsubjects = str2array(arrayfirst(searchquery($currentuser->usertype, "hlsubjects", "id", $currentuser->userid)));
    $_POST['slsubjects'] = $slsubjects = str2array(arrayfirst(searchquery($currentuser->usertype, "slsubjects", "id", $currentuser->userid)));
    $_POST['hlsubject1'] = $hlsubject1 = $hlsubjects[0];
    $_POST['hlsubject2'] = $hlsubject2 = $hlsubjects[1];
    $_POST['hlsubject3'] = $hlsubject3 = $hlsubjects[2];
    $_POST['slsubject1'] = $slsubject1 = $slsubjects[0];
    $_POST['slsubject2'] = $slsubject2 = $slsubjects[1];
    $_POST['slsubject3'] = $slsubject3 = $slsubjects[2];
    
    $_POST['hlscores'] = $hlscores = str2array(arrayfirst(searchquery($currentuser->usertype, "hlscores", "id", $currentuser->userid)));
    $_POST['slscores'] = $slscores = str2array(arrayfirst(searchquery($currentuser->usertype, "slscores", "id", $currentuser->userid)));
    $_POST['hlscore1'] = $hlscore1 = $hlscores[0];
    $_POST['hlscore2'] = $hlscore2 = $hlscores[1];
    $_POST['hlscore3'] = $hlscore3 = $hlscores[2];
    $_POST['slscore1'] = $slscore1 = $slscores[0];
    $_POST['slscore2'] = $slscore2 = $slscores[1];
    $_POST['slscore3'] = $slscore3 = $slscores[2];
    
    $_POST['accomplishments'] = $accomplishments = arrayfirst(searchquery($currentuser->usertype, "accomplishments", "id", $currentuser->userid));
    $_POST['activities'] = $activities = arrayfirst(searchquery($currentuser->usertype, "activities", "id", $currentuser->userid));
    $_POST['sat'] = $sat = arrayfirst(searchquery($currentuser->usertype, "sat", "id", $currentuser->userid));
    $_POST['act'] = $act = arrayfirst(searchquery($currentuser->usertype, "act", "id", $currentuser->userid));
    
    $_POST['firstnameerr'] = $_POST['middlenameerr'] = $_POST['lastnameerr'] = $_POST['schoolemailerr'] = $_POST['personalemailerr'] = $_POST['doberr'] = $_POST['sexerr'] = $_POST['addresserr'] = $_POST['schoolerr'] = $_POST['phoneerr'] = $_POST['citizenshiperr'] = $_POST['countryerr'] = $_POST['gradeerr'] = $_POST['graduationerr'] = $_POST['hlsubject1err'] = $_POST['hlsubject2err'] = $_POST['hlsubject3err'] = $_POST['slsubject1err'] = $_POST['slsubject2err'] = $_POST['slsubject3err'] = $_POST['hlscore1err'] = $_POST['hlscore2err'] = $_POST['hlscore3err'] = $_POST['slscore1err'] = $_POST['slscore2err'] = $_POST['slscore3err'] = $_POST['accomplishmentserr'] = $_POST['activitieserr'] = $_POST['saterr'] = $_POST['acterr'] = "";
} else {
    $_POST['firstnameerr'] = $_POST['middlenameerr'] = $_POST['lastnameerr'] = $_POST['schoolemailerr'] = $_POST['personalemailerr'] = $_POST['doberr'] = $_POST['sexerr'] = $_POST['addresserr'] = $_POST['schoolerr'] = $_POST['phoneerr'] = $_POST['citizenshiperr'] = $_POST['countryerr'] = $_POST['gradeerr'] = $_POST['graduationerr'] = $_POST['hlsubject1err'] = $_POST['hlsubject2err'] = $_POST['hlsubject3err'] = $_POST['slsubject1err'] = $_POST['slsubject2err'] = $_POST['slsubject3err'] = $_POST['hlscore1err'] = $_POST['hlscore2err'] = $_POST['hlscore3err'] = $_POST['slscore1err'] = $_POST['slscore2err'] = $_POST['slscore3err'] = $_POST['accomplishmentserr'] = $_POST['activitieserr'] = $_POST['saterr'] = $_POST['acterr'] = "";
    checkForm();
}

function checkForm() {
    $invalid = false;
    if ($_POST['firstname'] == "") {
        $_POST["firstnameerr"] = "First name required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['firstname']))) {
        $_POST["firstnameerr"] = "Only letters and white space allowed";
        $invalid = true;
    }
    
    if ($_POST['middlename'] == "") {
        $_POST["middlenameerr"] = "";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['middlename']))) {
        $_POST["middlenameerr"] = "Only letters and white space allowed";
        $invalid = true;
    }
    
    if ($_POST['lastname'] == "") {
        $_POST["lastnameerr"] = "Last name required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['lastname']))){
        $_POST["lastnameerr"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['lastname'] = test_input($_POST['lastname']);
    }
    
    if ($_POST['schoolemail'] == "") {
        $_POST["schoolemailerr"] = "School email required";
        $invalid = true;
    } elseif (!filter_var(test_input($_POST['schoolemail']), FILTER_VALIDATE_EMAIL)){
        $_POST["schoolemailerr"] = "Invalid email format";
        $invalid = true;
    } else {
        $_POST['schoolemail'] = test_input($_POST['schoolemail']);
    }
    
    if ($_POST['personalemail'] == "") {
        $_POST["personalemailerr"] = "Personal email required";
        $invalid = true;
    } elseif (!filter_var(test_input($_POST['personalemail']), FILTER_VALIDATE_EMAIL)){
        $_POST["personalemailerr"] = "Invalid email format";
        $invalid = true;
    } else {
        $_POST['personalemail'] = test_input($_POST['personalemail']);
        $_POST["personalemailerr"] = "";
    }
    
    if ($_POST['dob'] == "") {
        $_POST["doberr"] = "Date of birth required";
        $invalid = true;
    } elseif(!validateDate($_POST['dob'])){
        $_POST["doberr"] = "Enter a valid date";
        $invalid = true;
    } else {
        $_POST['dob'] = test_input($_POST['dob']);
        $_POST["doberr"] = "";
    }
    
    if ($_POST['sex'] == "") {
        $_POST["sexerr"] = "Sex required";
        $invalid = true;
    } else {
        $_POST['sex'] = test_input($_POST['sex']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['sex']))) {
            $_POST["sexerr"] = "Only letters and white space allowed";
            $invalid = true;
        }
    }
    
    if ($_POST['address'] == "") {
        $_POST["addresserr"] = "Address required";
        $invalid = true;
    }
    
    if ($_POST['school'] == "") {
        $_POST["schoolerr"] = "School name required";
        $invalid = true;
    } else {
        $_POST['school'] = test_input($_POST['school']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['school']))) {
            $_POST["schoolerr"] = "Only letters and white space allowed";
            $invalid = true;
          }
    }
    
    if ($_POST['phone'] == "") {
        $_POST["phoneerr"] = "Phone number required";
        $invalid = true;
    } elseif (!is_numeric($_POST['phone'])){
        $_POST["phoneerr"] = "Only numbers allowed in phone number";
        $invalid = true;
    } else {
        $_POST['phone'] = test_input($_POST['phone']);
        $_POST["phoneerr"] = "";
    }
    
    if ($_POST['citizenship'] == "") {
        $_POST["citizenshiperr"] = "Citizenship required";
        $invalid = true;
    }
    
    if ($_POST['country'] == "") {
        $_POST["countryerr"] = "Country required";
        $invalid = true;
    } else {
        $_POST['country'] = test_input($_POST['country']);
        if (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['country']))) {
            $_POST["countryerr"] = "Only letters and white space allowed";
            $invalid = true;
          }
    }
    
    if ($_POST['grade'] == "") {
        $_POST["gradeerr"] = "Current grade required";
        $invalid = true;
    } else {
        $_POST['grade'] = test_input($_POST['grade']);
        if (!is_numeric($_POST['grade'])) {
            $_POST["gradeerr"] = "Please input a grade in numbers";
            $invalid = true;
          }
    }
    
    if ($_POST['graduation'] == "") {
        $_POST["graduationerr"] = "Graduation required";
        $invalid = true;
    } else {
        $_POST['graduation'] = test_input($_POST['graduation']);
        if (!is_numeric($_POST['graduation'])) {
            $_POST["graduationerr"] = "Please input a valid year";
            $invalid = true;
          }
    }
    
    if ($_POST['hlsubject1'] == "") {
        $_POST["hlsubject1err"] = "Hl Subject required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['hlsubject1']))){
        $_POST["hlsubject1err"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['hlsubject1'] = test_input($_POST['hlsubject1']);
        $_POST["hlsubject1err"] = "";
    }
    
    if ($_POST['hlsubject2'] == "") {
        $_POST["hlsubject2err"] = "Hl Subject required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['hlsubject2']))){
        $_POST["hlsubject2err"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['hlsubject2'] = test_input($_POST['hlsubject2']);
        $_POST["hlsubject2err"] = "";
    }
    
    if ($_POST['hlsubject3'] == "") {
        $_POST["hlsubject3err"] = "Hl Subject required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['hlsubject3']))){
        $_POST["hlsubject3err"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['hlsubject3'] = test_input($_POST['hlsubject3']);
        $_POST["hlsubject3err"] = "";
    }
    
    if ($_POST['slsubject1'] == "") {
        $_POST["slsubject1err"] = "Sl Subject required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['slsubject1']))){
        $_POST["slsubject1err"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['slsubject1'] = test_input($_POST['slsubject1']);
        $_POST["slsubject1err"] = "";
    }
    
    if ($_POST['slsubject2'] == "") {
        $_POST["slsubject2err"] = "Sl Subject required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['slsubject2']))){
        $_POST["slsubject2err"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['slsubject2'] = test_input($_POST['slsubject2']);
        $_POST["slsubject2err"] = "";
    }
    
    if ($_POST['slsubject3'] == "") {
        $_POST["slsubject3err"] = "Sl Subject required";
        $invalid = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/",test_input($_POST['slsubject3']))){
        $_POST["slsubject3err"] = "Only letters and white space allowed";
        $invalid = true;
    } else {
        $_POST['slsubject3'] = test_input($_POST['slsubject3']);
        $_POST["slsubject3err"] = "";
    }
    
    if ($_POST['hlscore1'] == "") {
        $_POST["hlscore1err"] = "HL score required";
        $invalid = true;
    } else {
        $_POST['hlscore1'] = test_input($_POST['hlscore1']);
        if ($_POST['hlscore1'] > 7 || $_POST['hlscore1'] < 0) {
            $_POST["hlscore1err"] = "Please input score between 0-7";
            $invalid = true;
          }
    }
    
    if ($_POST['hlscore2'] == "") {
        $_POST["hlscore2err"] = "HL score required";
        $invalid = true;
    } else {
        $_POST['hlscore2'] = test_input($_POST['hlscore2']);
        if ($_POST['hlscore2'] > 7 || $_POST['hlscore2'] < 0) {
            $_POST["hlscore2err"] = "Please input score between 0-7";
            $invalid = true;
          }
    }
    
    if ($_POST['hlscore3'] == "") {
        $_POST["hlscore3err"] = "HL score required";
        $invalid = true;
    } else {
        $_POST['hlscore3'] = test_input($_POST['hlscore3']);
        if ($_POST['hlscore3'] > 7 || $_POST['hlscore3'] < 0) {
            $_POST["hlscore3err"] = "Please input score between 0-7";
            $invalid = true;
          }
    }
    
    if ($_POST['slscore1'] == "") {
        $_POST["slscore1err"] = "SL score required";
        $invalid = true;
    } else {
        $_POST['slscore1'] = test_input($_POST['slscore1']);
        if ($_POST['slscore1'] > 7 || $_POST['slscore1'] < 0) {
            $_POST["slscore1err"] = "Please input score between 0-7";
            $invalid = true;
          }
    }
    
    if ($_POST['slscore2'] == "") {
        $_POST["slscore2err"] = "SL score required";
        $invalid = true;
    } else {
        $_POST['slscore2'] = test_input($_POST['slscore2']);
        if ($_POST['slscore2'] > 7 || $_POST['slscore2'] < 0) {
            $_POST["slscore2err"] = "Please input score between 0-7";
            $invalid = true;
          }
    }
    
    if ($_POST['slscore3'] == "") {
        $_POST["slscore3err"] = "SL score required";
        $invalid = true;
    } else {
        $_POST['slscore3'] = test_input($_POST['slscore3']);
        if ($_POST['slscore3'] > 7 || $_POST['slscore3'] < 0) {
            $_POST["slscore3err"] = "Please input score between 0-7";
            $invalid = true;
          }
    }
    
    if ($_POST['accomplishments'] == "") {
        $_POST["accomplishmentserr"] = "";
    } else {
        $_POST['accomplishments'] = test_input($_POST['accomplishments']);
    }
    
    if ($_POST['activities'] == "") {
        $_POST["activitieserr"] = "";
    } else {
        $_POST['activities'] = test_input($_POST['activities']);
    }
    
    if ($_POST['sat'] == "") {
        $_POST["saterr"] = "";
    } else {
        $_POST['sat'] = test_input($_POST['sat']);
        if (!is_numeric($_POST['sat'])) {
            $_POST["saterr"] = "Please input a number";
            $invalid = true;
          }
    }
    
    if ($_POST['act'] == "") {
        $_POST["acterr"] = "";
    } else {
        $_POST['act'] = test_input($_POST['act']);
        if (!is_numeric($_POST['act'])) {
            $_POST["acterr"] = "Please input a number";
            $invalid = true;
          }
    }

    if ($invalid) {
        return false;
    } else {
        return true;
    }
}

$form = "";
$form .= "
<head>
<link href='studenthomepagestyle.css' rel='stylesheet' type='text/css'>
</head>

<form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
</br>
<center>
<table width='100%'>
<tr class='menubar'>
<td width='320px'><p class='title'>Student College Profile</p></td>
<td class='menubartd'><a class='menubarlink' href='studenthomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentcollegepage.php'>College Profile</a></td>
<td class='menubartd'><a class='menubarlink' href='universitylistpage.php'>University List</a></td>
<td class='menubartd'><a class='menubarlink' href='documentspage.php'>Documents</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>


<table class='grouping'>
<tr><td>
<table class='profiletable'>
<tr><td>First name: </td><td> <input type='text' class='otherinput' name='firstname' value='".$_POST["firstname"]."'></td><td>".$_POST["firstnameerr"]."</td></tr>
<tr><td>Middle name: </td><td> <input type='text' class='otherinput' name='middlename' value='".$_POST["middlename"]."'></td><td>".$_POST["middlenameerr"]."</td></tr>
<tr><td>Last name: </td><td> <input type='text' class='otherinput' name='lastname' value='".$_POST["lastname"]."'></td><td>".$_POST["lastnameerr"]."</td></tr>
<tr><td>School email: </td><td> <input type='text' class='otherinput' name='schoolemail' value='".$_POST["schoolemail"]."'l'></td><td>".$_POST["schoolemailerr"]."</td></tr>
<tr><td>Personal email: </td><td> <input type='text' class='otherinput' name='personalemail' value='".$_POST["personalemail"]."'></td><td>".$_POST["personalemailerr"]."</td></tr>
<tr><td>Date of birth: </td><td> <input type='text' class='otherinput' name='dob' value='".$_POST["dob"]."'></td><td>".$_POST["doberr"]."</td></tr>
<tr><td>Sex: </td><td> <input type='text' class='otherinput' name='sex'value='".$_POST["sex"]."'><td>".$_POST["sexerr"]."</td></tr>
<tr><td>Address: </td><td> <input type='text' class='otherinput' name='address' value='".$_POST["address"]."'></td><td>".$_POST["addresserr"]."</td></tr>
<tr><td>School: </td><td> <input type='text' class='otherinput' name='school' value='".$_POST["school"]."'></td><td>".$_POST["schoolerr"]."</td></tr>
<tr><td>Phone number: </td><td> <input type='text' class='otherinput' name='phone' value='".$_POST["phone"]."'></td><td>".$_POST["phoneerr"]."</td></tr>
<tr><td>Citizenship: </td><td> <input type='text' class='otherinput' name='citizenship' value='".$_POST["citizenship"]."'> </td><td>".$_POST["citizenshiperr"]."</td></tr>
<tr><td>Country: </td><td> <input type='text' class='otherinput' name='country' value='".$_POST["country"]."'></td><td>".$_POST["countryerr"]."</td></tr>
<tr><td>Current grade: </td><td> <input type='text' class='otherinput' name='grade' value='".$_POST["grade"]."'></td><td>".$_POST["gradeerr"]."</td></tr>
<tr><td>Graduation year: </td><td> <input type='text' class='otherinput' name='graduation' value='".$_POST["graduation"]."''></td><td>".$_POST["graduationerr"]."</td></tr>
<tr><td>Accomplishments: </td><td> <input type='text' class='otherinput' name='accomplishments' value='".$_POST["accomplishments"]."'></td><td>".$_POST["accomplishmentserr"]."</td></tr>
<tr><td>Activities: </td><td> <input type='text' class='otherinput' name='activities' value='".$_POST["activities"]."''></td><td>".$_POST["activitieserr"]."</td></tr>
<tr><td>SAT score: </td><td> <input type='text' class='otherinput' name='sat' value='".$_POST["sat"]."'</td><td>".$_POST["saterr"]."</td></tr>
<tr><td>ACT score: </td><td> <input type='text' class='otherinput' name='act' value='".$_POST["act"]."'</td><td>".$_POST["acterr"]."</td></tr>
</table>
</td>

<td>
<table class='profiletable'>
<tr><td colspan='2'>
<img src='".$_POST["pfp"]."' class='pfp' id='pfpsrc' name='pfpsrc'></img>
</td>
</tr>
<tr><td colspan='4'><a>Change Profile Image</a></td></tr>
<tr>
<td colspan='4'>
<form method='POST' action='' enctype='multipart/form-data' id='pfpform' name='pfppost'>
<input type='file' id='pfp' name='pfpinput' onchange='setpfp()' class='imginput'></input>
</form>
</td>
</tr>

<tr><td>HL Subject 1: <input type='text' class='subjectinput' name='hlsubject1' value='".$_POST['hlsubject1']."'' size='9'> </td><td>".$_POST['hlsubject1err']."</td><td> Score: <input type='text' name='hlscore1'  value='".$_POST['hlscore1']."'size='4' class='scoreinput'></td><td>".$_POST['hlscore1err']."</td></tr>
<tr><td>HL Subject 2: <input type='text' class='subjectinput' name='hlsubject2' value='".$_POST['hlsubject2']."'' size='9'> </td><td>".$_POST['hlsubject2err']."</td><td> Score: <input type='text' name='hlscore2'  value='".$_POST['hlscore2']."'size='4' class='scoreinput'></td><td>".$_POST['hlscore2err']."</td></tr>
<tr><td>HL Subject 3: <input type='text' class='subjectinput' name='hlsubject3' value='".$_POST['hlsubject3']."'' size='9'> </td><td>".$_POST['hlsubject3err']."</td><td> Score: <input type='text' name='hlscore3'  value='".$_POST['hlscore3']."'size='4' class='scoreinput'></td><td>".$_POST['hlscore3err']."</td></tr>
<tr><td>SL Subject 1: <input type='text' class='subjectinput' name='slsubject1' value='".$_POST['slsubject1']."'' size='9'> </td><td>".$_POST['slsubject1err']."</td><td> Score: <input type='text' name='slscore1'  value='".$_POST['slscore1']."'size='4' class='scoreinput'></td><td>".$_POST['slscore1err']."</td></tr>
<tr><td>SL Subject 2: <input type='text' class='subjectinput' name='slsubject2' value='".$_POST['slsubject2']."'' size='9'> </td><td>".$_POST['slsubject2err']."</td><td> Score: <input type='text' name='slscore2'  value='".$_POST['slscore2']."'size='4' class='scoreinput'></td><td>".$_POST['slscore2err']."</td></tr>
<tr><td>SL Subject 3: <input type='text' class='subjectinput' name='slsubject3' value='".$_POST['slsubject3']."'' size='9'> </td><td>".$_POST['slsubject3err']."</td><td> Score: <input type='text' name='slscore3'  value='".$_POST['slscore3']."'size='4' class='scoreinput'></td><td>".$_POST['slscore3err']."</td></tr>
</table>
</td></tr>
<tr><td colspan='2'>
<input type='submit' name='submitcollegeprofile' value='Update Profile' class='submitbtn'></input>
</td></tr>
</table>

</form>
<script>
function setpfp() {
    document.getElementById('pfpsrc').src = 'resources/' + document.getElementById('pfp').value.slice(12);
    document.getElementById('pfpform').submit();
}
document.getElementById('pfpsrc').src = document.getElementById('pfpsrc').src + '';
</script>
";

ob_start();
echo $form;



if (isset($_POST['submitcollegeprofile'])) {
    if (checkForm()) {
        updatevalue($currentuser->usertype, "firstname", $_POST['firstname'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "middlename", $_POST['middlename'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "lastname", $_POST['lastname'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "schoolemail", $_POST['schoolemail'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "personalemail", $_POST['personalemail'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "dob", $_POST['dob'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "sex", $_POST['sex'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "address", $_POST['address'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "school", $_POST['school'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "phone", $_POST['phone'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "citizenship", $_POST['citizenship'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "country", $_POST['country'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "grade", $_POST['grade'], "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "graduation", $_POST['graduation'], "id", $currentuser->userid);
        
        $hlsub = $_POST['hlsubject1'] . ", " . $_POST['hlsubject2'] . ", " . $_POST['hlsubject3'];
        $slsub = $_POST['slsubject1'] . ", " . $_POST['slsubject2'] . ", " . $_POST['slsubject3'];
        $hlscr = $_POST['hlscore1'] . ", " . $_POST['hlscore2'] . ", " . $_POST['hlscore3'];
        $slscr = $_POST['slscore1'] . ", " . $_POST['slscore2'] . ", " . $_POST['slscore3'];
        updatevalue($currentuser->usertype, "hlsubjects", $hlsub, "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "slsubject", $slsub, "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "hlscores", $hlscr, "id", $currentuser->userid);
        updatevalue($currentuser->usertype, "slscores", $slscr, "id", $currentuser->userid);
        echo('<script>alert("Your profile has been updated successfully");</script>');
    }
    if ($_POST['pfpinput'] != null) {
        $src = 'resources/' . $_POST['pfpinput'];
        updatevalue($currentuser->usertype, "profileimage", $src, "id", $currentuser->userid);
        header("Refresh:0");
    }
}

if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids)-1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}
