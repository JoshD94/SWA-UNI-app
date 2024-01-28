<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();

$unicount = 0;
$uninames = [];
$unilocations = [];
$unidescs = [];
$uniphones = [];
$uniprices = [];
$unistarred = [];
$mystarred = [];
$mystarredids = [];
while (arrayfirst(searchquery("Universities", "name", "id", $unicount)) != null) {
    array_push($uninames, arrayfirst(searchquery("Universities", "name", "id", $unicount)));
    array_push($unilocations, arrayfirst(searchquery("Universities", "location", "id", $unicount)));
    array_push($unidescs, arrayfirst(searchquery("Universities", "description", "id", $unicount)));
    array_push($uniphones, arrayfirst(searchquery("Universities", "phone", "id", $unicount)));
    array_push($uniprices, arrayfirst(searchquery("Universities", "price", "id", $unicount)));
    array_push($unistarred, str2array(arrayfirst(searchquery("Universities", "starred", "id", $unicount))));
    $unicount += 1;
}
for ($m = 0; $m < count($unistarred); $m++) {
    for ($n = 0; $n < strlen($unistarred[$m][0]); $n++) {
        if (substr($unistarred[$m][0], $n, 1) == $currentuser->userid) {
            array_push($mystarred, arrayfirst(searchquery("Universities", "name", "id", $m)));
            break;
        }
    }
}

// echo print_r($uninames); echo "</br>";
// echo print_r($unilocations); echo "</br>";
// echo print_r($unidescs); echo "</br>";
// echo print_r($uniphones); echo "</br>";
// echo print_r($uniprices); echo "</br>";

$form = "";
$form .= "
<head>
<link href='universitylistpage.css' rel='stylesheet' type='text/css'>
</head>

<form action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . " method='post'>
</br>
<center>
<table width='100%'>
<tr class='menubar'>
<td width='320px'><p class='title'>Student University List</p></td>
<td class='menubartd'><a class='menubarlink' href='studenthomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentcollegepage.php'>College Profile</a></td>
<td class='menubartd'><a class='menubarlink' href='universitylistpage.php'>University List</a></td>
<td class='menubartd'><a class='menubarlink' href='documentspage.php'>Documents</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>

<div class='uniscroll'>";
for ($j = 0; $j < count($uninames); $j++) {
    $bgstyling = 'background-image: url("uniresources/' . $uninames[$j] . ' background.jpg"); background-repeat: none; background-size: cover;';
    $star = "Add to List";
    for ($p = 0; $p < count($mystarred); $p++) {
        if ($mystarred[$p] != null) {
            if ($uninames[$j] == $mystarred[$p]) {
                $star = "Remove";
            }
        }
    }
    $form .=
        "<div class='unidiv' style='" . $bgstyling . "'>
        <div class='info'>
        <table class='unitable'>
            <tr>
            <td rowspan='4'><img src='uniresources/" . $uninames[$j] . " logo.png' class='logoimg'></td>
            <td colspan='3'><a class='uniname'>" . $uninames[$j] . "</a></td>
            </tr>
            <tr>
            <td><a class='unilocation'>" . $unilocations[$j] . "</a></td>
            <td><a class='unilocation'>Phone: " . $uniphones[$j] . "</a></td>
            <td><a class='unilocation'>Est. Price: $" . $uniprices[$j] . "</a></td>
            </tr>
            <tr></tr>
            <tr><td colspan='3'><a class='unilocation'>" . $unidescs[$j] . "</a></td></tr>
        </table>
        </div>";

    if ($star == "Add to List") {
        $form .= "<button class='star' name='star" . $j . "'>" . $star . "</button>";
    } else {
        $form .= "<button class='star' name='unstar" . $j . "'>" . $star . "</button>";
    }

    $form .= "
        
    </div>";
}
$form .= "
</div>

<div class='mylistscroll'>
<a class='myunititle'>My University List</a>
";


for ($j = 0; $j < count($uninames); $j++) {
    for ($p = 0; $p < count($mystarred); $p++) {
        if ($mystarred[$p] != null) {
            if ($uninames[$j] == $mystarred[$p]) {

                // $columns = ["accepted", "rejected", "deferred", "pending", "attending"];
                // foreach ($columns as $column) {
                // }
                // $status = arrayfirst(searchquery("Status", ""));
                $form .= "
                <div class='unibar'>
                    " . $uninames[$j] . "
                    
                    <button name='unstar" . $j . "' class='closeunibar'>&#10005;</button>
                </div>
                ";
            }
        }
    }
}


// <select name='status".$mystarredids[$j]."' class='status'>
//                     <option value='Pending'>Pending</option>
//                     <option value='Accepted'>Accepted</option>
//                     <option value='Rejected'>Rejected</option>
//                     <option value='Deferred'>Deferred</option>
//                     <option value='Attending'>Attending</option>
//                     </select>
//                     <a style='float: right; margin-right:10px;'>Status: </a>

$form .= "
    </div>
";

ob_start();
echo $form;

for ($starcount = 0; $starcount < 100; $starcount++) {
    if (isset($_POST['star' . $starcount])) {
        $newstarred = arrayfirst(searchquery("Universities", "starred", "name", $uninames[$starcount]));
        if ($newstarred == null) {
            $newstarred .= $currentuser->userid;
        } else {
            $newstarred .= "," . $currentuser->userid;
        }
        updatevalue("Universities", "starred", $newstarred, "name", $uninames[$starcount]);
        header("Refresh:0");
    }
    if (isset($_POST['unstar' . $starcount])) {
        $newstarred = arrayfirst(searchquery("Universities", "starred", "name", $uninames[$starcount]));
        // for ($letter = 0; $letter < strlen($newstarred); $letter++) {
        //     if ($newstarred[$letter] == $currentuser->userid) {
        //         $index = $letter;
        //     }
        // }
        $updated = str_replace($currentuser->userid, "", $newstarred);
        echo $updated;
        updatevalue("Universities", "starred", $updated, "name", $uninames[$starcount]);
        header("Refresh:0");
    }
}

if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids) - 1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}
