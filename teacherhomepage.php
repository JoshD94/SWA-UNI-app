<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();

$allrequests = [];
$allrequests = searchquery("Requests", "id", "touserid", $currentuser->userid);
$allmyreq = [];

if ($allrequests != null) {
    for ($q = 0; $q < count($allrequests); $q++) {
        array_push($allmyreq, $allrequests[$q]['id']);
    }
}

if (!isset($_POST['firstname'])) {
    $_POST["firstname"] = arrayfirst(searchquery("Teachers", "firstname", "id", $currentuser->userid));
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
<td width='7000px'><p class='title'>Teacher Home Page</p></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>

<table>
<tr><td>
<a>First name: </a>
<input type='text' class='otherinput2' name='firstname' value='".$_POST["firstname"]."'></input>
<input type='submit' name='submitname' value='Change' class='uploadbtn'></input>
</td></tr><tr><td><center>
<a>(This will be the name your students see)</a></center></td></tr>
</table>

<div class='uploadlist2'>
<a class='filetitle'>Recommendation Letter Requests</a>
<table>
";

foreach ($allmyreq as $req) {
    $studentid = arrayfirst(searchquery("Requests", "fromuserid", "id", $req));
    $studentname = arrayfirst(searchquery("Students", "firstname", "id", $studentid));
    $studentgrade = arrayfirst(searchquery("Students", "grade", "id", $studentid));
    $reqdone = "Sent on ".arrayfirst(searchquery("Requests", "datesent", "id", $req));
    $reqcolor = "style='background-color: #FFCCCB;'";
    if (arrayfirst(searchquery("Requests", "filepath", "id", $req)) != "") {
        $reqdone = "Completed on ".arrayfirst(searchquery("Requests", "datereceived", "id", $req));
        $reqcolor = "style='background-color: #7feb7f;'";
    }
    $form .= "
    <tr><td>
    <div class='filebar' ".$reqcolor.">
    <a href='".str_replace("#", "%23", htmlspecialchars(arrayfirst(searchquery("Requests", "filepath", "id", $req))))."' target='_blank'>".$studentname."\tG".$studentgrade."</a>
    <a>".$reqdone."</a>
    </div></td><td>
    <input type='file' id='uploadreq' name='uploadreq".$req."' class='choosebtn2'></input>
    </td>
    <td>
    <button name='uploadreqbtn".$req."' class='uploadbtn'>Upload</button>
    </td>
    ";
}

$form .= "</table></div>";

ob_start();
echo $form;

for ($t = 0; $t < 100; $t++) {
    if (isset($_POST['uploadreqbtn'.$t]) && isset($_POST['uploadreq'.$t]) && $_POST['uploadreq'.$t] != null) {
        updatevalue("Requests", "filepath", "documents/".$_POST['uploadreq'.$t], "id", $t);
        updatevalue("Requests", "datereceived", date("Y-m-d,h:i:s"), "id", $t);
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

if (isset($_POST['submitname'])) {
    updatevalue("Teachers", "firstname", $_POST['firstname'], "id", $currentuser->userid);
    header("Refresh:0");
}