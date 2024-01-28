<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();

$allstudents = [];
$allemails = [];
for ($e = 1; $e < 300; $e++) {
    if (arrayfirst(searchquery("Students", "schoolemail", "id", $e)) != null) {
        array_push($allstudents, $e);
        array_push($allemails, arrayfirst(searchquery("Students", "schoolemail", "id", $e)));
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
<td width='320px'><p class='title'>Counsellor Student Page</p></td>
<td class='menubartd'><a class='menubarlink' href='counsellorhomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentpage.php'>Students</a></td>
<td class='menubartd'><a class='menubarlink' href='analyticspage.php'>Analytics</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>


<div class='studentlist'>
<a class='myunititle'>All Students</a>
";

foreach ($allstudents as $id) {
    $firstname = arrayfirst(searchquery("Students", "firstname", "id", $id));
    $lastname = arrayfirst(searchquery("Students", "lastname", "id", $id));
    $grade = arrayfirst(searchquery("Students", "grade", "id", $id));
    $pfp = arrayfirst(searchquery("Students", "profileimage", "id", $id));
    $teacherreqs = [];
    $teacherreqcount = 0;

    $unicount = 0;
    $unistarred = [];
    $mystarred = [];
    while (arrayfirst(searchquery("Universities", "name", "id", $unicount)) != null) {
        array_push($unistarred, str2array(arrayfirst(searchquery("Universities", "starred", "id", $unicount))));
        $unicount += 1;
    }
    for ($m = 0; $m < count($unistarred); $m++) {
        for ($n = 0; $n < strlen($unistarred[$m][0]); $n++) {
            if (substr($unistarred[$m][0], $n, 1) == $id) {
                array_push($mystarred, arrayfirst(searchquery("Universities", "name", "id", $m)));
                break;
            }
        }
    }

    if (searchquery("Requests", "id", "fromuserid", $id) != null) {
        $allrequests = searchquery("Requests", "id", "fromuserid", $id);
        $reqnames = [];
        for ($q = 0; $q < count($allrequests); $q++) {
            $reqid = $allrequests[$q]['id'];
            $teacherid = arrayfirst(searchquery("Requests", "touserid", "id", $reqid));
            if (arrayfirst(searchquery("Requests", "filepath", "id", $reqid)) != "") {
                array_push($reqnames, arrayfirst(searchquery("Teachers", "firstname", "id", $teacherid)));
            }
        }
        $teacherreqs = $reqnames;
        $teacherreqcount = count($allrequests);
    }

    $uploaded = "<a style='color: red;'>None</a>";
    if (searchquery("Transcripts", "filepath", "studentid", $id) != null) {
        $uploaded = "<a style='color: green;' href='".arrayfirst(searchquery("Transcripts", "filepath", "studentid", $id))."' target='_blank'>Uploaded</a>";
    }

    $form .= "<div class='studentdiv'>
    <table class='studentdivtable'>
    <tr>
    <td rowspan='4' width='100px'><img src='".$pfp."' class='logoimg'></td><td><b>".$firstname."\t".$lastname."</b>\t<a style='float: right; padding-right:5px;'>G".$grade."</a></td>
    </tr>
    <tr>
    <td>Applying to ".count($mystarred)." universities</td>
    </tr>
    <tr>
    <td>Completed teacher recs: ".count($teacherreqs)."/".$teacherreqcount."</td>
    </tr>
    <tr>
    <td>Transcript: ".$uploaded."</td>
    </tr>
    </table>
    </div>";
}

$form .= "</div>

<div class='notifdiv'>

<table>
<tr>
<td><center><a class='myunititle'>Send Reminder</a></center></br></td>
</tr>
<tr><td>
<center>
To: <select name='target'>
<option value='all'> All Students </option>";

for ($y = 0; $y < count($allstudents); $y++) {
    $sname = arrayfirst(searchquery("Students", "firstname", "id", $allstudents[$y]));
    $sgrade = arrayfirst(searchquery("Students", "grade", "id", $allstudents[$y]));
    $form .= "<option value='".$allstudents[$y]."'> ".$sname."\t(G".$sgrade.") </option>";
}

$form .= "
</select>
</center>
</td></tr>
<tr><td>
<textarea name='remindertext' class='remindertext' placeholder='Type your message here'></textarea>
</td></tr>
<tr><td><center>
<button name='sendreminder' class='uploadbtn'>Send</button>
</center></td></tr>
</table>
</div>

<div class='transcriptdiv'>
<table>
<tr>
<td><center><a class='myunititle'>Upload Transcripts</a></center></br></td>
</tr>
<tr><td>
<center>
To: <select name='target2'>
<option value='none'> Select Student </option>";

for ($y = 0; $y < count($allstudents); $y++) {
    $sname = arrayfirst(searchquery("Students", "firstname", "id", $allstudents[$y]));
    $sgrade = arrayfirst(searchquery("Students", "grade", "id", $allstudents[$y]));
    $form .= "<option value='".$allstudents[$y]."'> ".$sname."\t(G".$sgrade.") </option>";
}

$form .= "
</select>
</center>
</td></tr>
<tr><td><center>
</br>
<input type='file' id='transcript' name='transcript' class='imginput'></input>
<button name='uploadtranscript' class='uploadbtn'>Upload</button>
</center></td></tr>
</table>
</div>
";

ob_start();
echo $form;

if (isset($_POST['uploadtranscript']) && $_POST['transcript'] != null && $_POST['target2'] != "none") {
    sendquery("INSERT INTO `Transcripts`(`studentid`, `filepath`, `date`) VALUES ('".$_POST['target2']."','documents/".$_POST['transcript']."','".date("Y-m-d,h:i:s")."')");
    header("Refresh:0");
}

if (isset($_POST['sendreminder']) && $_POST['remindertext'] != "") {
    if ($_POST['target'] == "all") {
        for ($g = 0; $g < count($allstudents); $g++) {
            sendquery("INSERT INTO `Notifications`(`userid`, `text`) VALUES ('".$allstudents[$g]."','".$_POST['remindertext']."')");
            sendEmail2($allemails[$g], $_POST['remindertext']);
            header("Refresh: 0");
        }
    } else {
        sendquery("INSERT INTO `Notifications`(`userid`, `text`) VALUES ('".$_POST['target']."','".$_POST['remindertext']."')");
        $targetemail = arrayfirst(searchquery("Students", "schoolemail", "id", $_POST['target']));
        if (sendEmail2($targetemail, $_POST['remindertext'])) {
            echo "<script>alert('Notification sent. Click OK to continue.')</script>";
        } else {
            echo "<script>alert('Failed to send notification')</script>";
        }
        header("Refresh: 0");
    }
}






if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids)-1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}
