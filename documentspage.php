<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();

$allmydocs = [];
$allmydocs = searchquery("Documents", "id", "fromuserid", $currentuser->userid);
$allmydocids = [];

if ($allmydocs != null) {
    for ($q = 0; $q < count($allmydocs); $q++) {
        array_push($allmydocids, $allmydocs[$q]['id']);
    }    
}

$allrequests = [];
$allrequests = searchquery("Requests", "id", "fromuserid", $currentuser->userid);
$allmyreq = [];

if ($allrequests != null) {
    for ($q = 0; $q < count($allrequests); $q++) {
        array_push($allmyreq, $allrequests[$q]['id']);
    }    
}

$allteachers = [];
$teachercount = 1;
while (arrayfirst(searchquery("Teachers", "firstname", "id", $teachercount)) != null) {
    array_push($allteachers, $teachercount);
    $teachercount += 1;
}

$form = "";
$form .= "
<head>
<link href='studenthomepagestyle.css' rel='stylesheet' type='text/css'>
</head>

<script>
function openfile(src) {
    window.open(src);
}
</script>

<form action=".htmlspecialchars($_SERVER["PHP_SELF"])." method='post'>
</br>
<center>
<table width='100%'>
<tr class='menubar'>
<td width='320px'><p class='title'>Student Documents Page</p></td>
<td class='menubartd'><a class='menubarlink' href='studenthomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentcollegepage.php'>College Profile</a></td>
<td class='menubartd'><a class='menubarlink' href='universitylistpage.php'>University List</a></td>
<td class='menubartd'><a class='menubarlink' href='documentspage.php'>Documents</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>

<div class='uploadlist'>
<input type='file' id='choosebtn' name='choosebtn' class='choosebtn'></input>
<button name='uploadfile' class='uploadbtn'>Upload</button>
</br>
<a class='filetitle'>Your Files</a>";

foreach ($allmydocids as $ids) {
    $name = substr(arrayfirst(searchquery("Documents", "filepath", "id", $ids)), 10);
    $form .= "
    <div class='filebar' onclick='openfile(`".arrayfirst(searchquery("Documents", "filepath", "id", $ids))."`)'>
    ".$name."
    <button name='delete".$ids."' class='closeunibar'>&#10005;</button>
    </div>
    ";
}

$form .= "</div>
<div class='uploadlist'>
<a class='filetitle'>Recommendation Letters</a>";

foreach ($allmyreq as $req) {
    $teacherid = arrayfirst(searchquery("Requests", "touserid", "id", $req));
    $teachername = arrayfirst(searchquery("Teachers", "firstname", "id", $teacherid));
    $reqdone = "Sent on ".arrayfirst(searchquery("Requests", "datesent", "id", $req));
    $reqcolor = "style='background-color: #FFCCCB;'";
    if (arrayfirst(searchquery("Requests", "filepath", "id", $req)) != "") {
        $reqdone = "Completed on ".arrayfirst(searchquery("Requests", "datereceived", "id", $req));
        $reqcolor = "style='background-color: #7feb7f;'";
    }
    $form .= "
    <div class='filebar' ".$reqcolor.">
    ".$teachername."<a class='reqdone'>".$reqdone."</a>
    </div>
    ";
}

$form .= "


<select name='teacher'>
<option value='none'> Select a teacher </option>";

for ($y = 0; $y < count($allteachers); $y++) {
    $tname = arrayfirst(searchquery("Teachers", "firstname", "id", $allteachers[$y]));;
    $form .= "<option value='".$allteachers[$y]."'> ".$tname." </option>";
}

$form .="
</select>
<button name='reqteacher' class='uploadbtn'>Request</button>
</div>
";


ob_start();
echo $form;

if (isset($_POST['uploadfile'])) {
    sendquery("INSERT INTO `Documents`(`userid`, `filepath`, `fromuserid`) VALUES ('".$currentuser->userid."','documents/".$_POST['choosebtn']."','".$currentuser->userid."')");
    header("Refresh:0");
}

for ($t = 0; $t < 100; $t++) {
    if (isset($_POST['delete'.$t])) {
        sendquery("DELETE FROM `Documents` WHERE `id`=".$t);
        header("Refresh:0");
    }
}

if (isset($_POST['reqteacher'])) {
    $teacherreqid = $_POST['teacher'];
    sendquery("INSERT INTO `Requests`(`fromuserid`, `touserid`, `filepath`, `datesent`, `datereceived`) VALUES ('".$currentuser->userid."','".$teacherreqid."','','".date("Y-m-d,h:i:s")."','')");
    header("Refresh:0");
}

if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids)-1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}
