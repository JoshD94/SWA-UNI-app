<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();
$calendar = new Calendar($currentuser);

$form = "";
$form .= "
<head>
<link href='studenthomepagestyle.css' rel='stylesheet' type='text/css'>
</head>

<form action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . " method='post'>
<center>
<table width='100%'>
<tr class='menubar'>
<td width='320px'><p class='title'>Counsellor Home Page</p></td>
<td class='menubartd'><a class='menubarlink' href='counsellorhomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentpage.php'>Students</a></td>
<td class='menubartd'><a class='menubarlink' href='analyticspage.php'>Analytics</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>

<table class='addeventtable'><tr><td class='calendartd'>
<link href='style.css' rel='stylesheet' type='text/css'>
<link href='calendar.css' rel='stylesheet' type='text/css'>
<div class='content home'>" . $calendar . "</div>
</td>

<td class='addeventtd'>
<div class='addevent'>
</br>
<a class='myunititle'>Add Event</a></br>
<div style='text-align: left; padding: 20px;'>
Title: <input type='text' placeholder='title' class='addeventinput' name='eventtitle'></input></br>
Date: <input type='date' class='addeventinput' name='eventdate'></input></br>
Days: <input type='text' class='addeventinput' name='eventdays'></input></br>
Color: <select  class='addeventinput' name='eventcolor'>
<option value='red'>Red</option>
<option value='blue'>Blue</option>
<option value='yellow'>Yellow</option>
</select>
</br></br><center><input type='submit' name='addeventbtn' value='Add Event' class='submitbtn2'></input></center>
</div>
</div></td></tr></table>";

if (isset($_POST['addeventbtn'])) {
    $title = $_POST['eventtitle'];
    $date = $_POST['eventdate'];
    if ($_POST['eventdays'] == "") {
        $days = 1;
    } else {
        $days = (int) $_POST['eventdays'];
    }
    $color = $_POST['eventcolor'];
    sendquery("INSERT INTO `Events`(`date`, `title`, `days`, `color`, `creatorid`, `receiverid`, `receivertype`, `info`) VALUES ('".$date."','".$title."',".$days.",'".$color."',".$currentuser->userid.",".$currentuser->userid.",'Counsellors','')");
    header("Location:counsellorhomepage.php");
}


ob_start();
echo $form;


if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids) - 1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}
