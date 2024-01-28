<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();
$calendar = new Calendar($currentuser);

$form = "";
$form .= "
<head>
<link href='studenthomepagestyle.css' rel='stylesheet' type='text/css'>
</head>

<form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
<center>
<table width='100%'>
<tr class='menubar'>
<td width='320px'><p class='title'>Student Home Page</p></td>
<td class='menubartd'><a class='menubarlink' href='studenthomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentcollegepage.php'>College Profile</a></td>
<td class='menubartd'><a class='menubarlink' href='universitylistpage.php'>University List</a></td>
<td class='menubartd'><a class='menubarlink' href='documentspage.php'>Documents</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>

<table><tr><td>
<link href='style.css' rel='stylesheet' type='text/css'>
<link href='calendar.css' rel='stylesheet' type='text/css'>
<div class='content home'>".$calendar."</div>
</td><td>
<table class='notifstable'>
<tr><td><p class='header'>Notifications</p></td></tr>
";

$notifs = searchquery("Notifications", "text", "userid", $currentuser->getinfo());
if ($notifs != null) {
    foreach ($notifs as $n) {
        $form.= "<tr><td>".$n['text']."</br></br></td></tr>";
    }
}

$form .="
</table>
</td></tr></table>
</center>
";
ob_start();
echo $form;

if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids)-1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}


// <table class='reminders'>
// <tr><td><p class='header'>Upcoming</p></td></tr>
// ";

// $ids = searchquery("Events", "id", "receiverid", $currentuser->userid);
// if ($ids != null) {
//     foreach ($ids as $i) {
//         $info = arrayfirst(searchquery("Events", "info", "id", $i["id"]));
//         $title = arrayfirst(searchquery("Events", "title", "id", $i["id"]));
//         $date = arrayfirst(searchquery("Events", "date", "id", $i["id"]));
//         $form .= "
//         <tr><td>
//         ".$date." | ".$title.": ".$info."
//         </td></tr>
//         ";
//     }
// }


// $form .= "
// </table>