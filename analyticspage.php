<?php
include_once("/Applications/XAMPP/xamppfiles/htdocs/CS-IA/utils.php");
startSession();

$form = "";
$form .= "
<head>
<link href='studenthomepagestyle.css' rel='stylesheet' type='text/css'>
</head>

<form action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . " method='post'>
</br>
<center>
<table width='100%'>
<tr class='menubar'>
<td width='320px'><p class='title'>Counsellor Analytics Page</p></td>
<td class='menubartd'><a class='menubarlink' href='counsellorhomepage.php'>Home</a></td>
<td class='menubartd'><a class='menubarlink' href='studentpage.php'>Students</a></td>
<td class='menubartd'><a class='menubarlink' href='analyticspage.php'>Analytics</a></td>
<td class='menubartd2'><input type='submit' name='logout' class='menubarbtn' value='Logout'></input></td>
<td width='700px'></td>
</tr>
</table>";

$allstudents = [];
$teacherreqs = [];
$uniapplies = [];
$allstudentnames = [];
$allstudentscores = [];
$allstudentsats = [];
$allstudentacts = [];
for ($e = 1; $e < 300; $e++) {
    if (arrayfirst(searchquery("Students", "schoolemail", "id", $e)) != null) {
        array_push($allstudents, $e);
    }
}
$unicount = 0;
$unistarred = [];
$uniids = [];
while (arrayfirst(searchquery("Universities", "name", "id", $unicount)) != null) {
    array_push($unistarred, str2array(arrayfirst(searchquery("Universities", "starred", "id", $unicount))));
    array_push($uniids, $unicount);
    $unicount += 1;
}
foreach ($allstudents as $id) {
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
        array_push($teacherreqs, count($reqnames));
    } else {
        array_push($teacherreqs, 0);
    }
    $mystarred = [];
    for ($m = 0; $m < count($unistarred); $m++) {
        $stars = explode(",", $unistarred[$m][0]);
        foreach ($stars as $star) {
            if ($star == $id) {
                array_push($mystarred, arrayfirst(searchquery("Universities", "name", "id", $star)));
                break;
            }
        }
        // for ($n = 0; $n < strlen($unistarred[$m][0]); $n++) {
        //     if (substr($unistarred[$m][0], $n, 1) == $id) {
        //         array_push($mystarred, arrayfirst(searchquery("Universities", "name", "id", $m)));
        //         break;
        //     }
        // }
    }
    $hlscores = arrayfirst(searchquery("Students", "hlscores", "id", $id));
    $slscores = arrayfirst(searchquery("Students", "slscores", "id", $id));
    $totalscore = 0;
    $totalscore += (int)substr($hlscores, 0, 1) + (int)substr($hlscores, 3, 1) + (int)substr($hlscores, 6, 1);
    $totalscore += (int)substr($slscores, 0, 1) + (int)substr($slscores, 3, 1) + (int)substr($slscores, 6, 1);


    array_push($uniapplies, count($mystarred));
    array_push($allstudentscores, $totalscore);
    array_push($allstudentsats, (int)arrayfirst(searchquery("Students", "sat", "id", $id)));
    array_push($allstudentacts, (int)arrayfirst(searchquery("Students", "act", "id", $id)));
    array_push($allstudentnames, arrayfirst(searchquery("Students", "firstname", "id", $id)));
}

$uniscount = 1;
$allcountries = [];
$countryappliedcount = [];
while (arrayfirst(searchquery("Universities", "country", "id", $uniscount)) != null) {
    $country = arrayfirst(searchquery("Universities", "country", "id", $uniscount));
    if (!in_array($country, $allcountries)) {
        array_push($allcountries, $country);
        array_push($countryappliedcount, 0);
    }
    $uniscount += 1;
}



for ($g = 0; $g < count($uniids); $g++) {
    //count of unistarred gives number of apply per uni
    $uniapplied = count(explode(",", $unistarred[$g][0]));
    //uni's id used to get country name
    $uniid = $uniids[$g];
    //country name used to find index and increment
    $unicountry = arrayfirst(searchquery("Universities", "country", "id", $uniid));
    $uniindex = array_search($unicountry, $allcountries);
    $countryappliedcount[$uniindex] += $uniapplied;
}

$form .= plotBarGraph($uniapplies, $allstudentnames, "Number of Universities Applying", "Applications", "Students");
$form .= plotBarGraph($countryappliedcount, $allcountries, "Countries Applied", "Applied", "Country");
$form .= plotBarGraph($teacherreqs, $allstudentnames, "Completed Recommendation Letters", "Recommendations", "Student");
$form .= "<a class='bigtitle'>Other Stats</a>";
$form .= plotBarGraph($allstudentscores, $allstudentnames, "Total IB Scores", "IB Score", "Student");
$form .= plotBarGraph($allstudentsats, $allstudentnames, "SAT Scores", "SAT Score", "Student");
$form .= plotBarGraph($allstudentacts, $allstudentnames, "ACT Scores", "ACT Score", "Student");

ob_start();
echo $form;

if (isset($_POST['logout'])) {
    $loginids = searchquery("Logins", "loginid", "userid", $currentuser->userid);
    $loginid = $loginids[count($loginids) - 1]["loginid"];
    updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $loginid);
    header("Location:loginpage.php");
    exit;
}

function plotBarGraph($data, $datanames, $title, $datalabel, $datanameslabel)
{
    $form = "";
    $highest = $data[0];
    foreach ($data as $d) {
        if ($d > $highest) {
            $highest = $d;
        }
    }
    if ($highest != 0) {
        $form .= "<div style='margin: 30px; padding: 20px; box-shadow: 0px 0px 10px black;'><a class='myunititle' style='margin: 20px;'>" . $title . "</a>";
        $form .= "<table class='biggertable'><tr><td class='tableleft'>" . makeTable($data, $datanames, $datalabel, $datanameslabel) . "</td><td style='float: left; margin-left: 30px;'><table style='border-bottom: solid black 2px; border-left: solid black 2px;'>
    <tr>";
        foreach ($data as $d) {
            if ($d != 0) {
                $form .= "<td style='border: none; padding: 0px; width: 100px; height: 300px; position: relative;'><div style='background-color: " . rand_color() . "; width: 50px; height: " . ($d / $highest * 270) . "px; position: absolute; bottom: 0px; right: 25px;' class='bargraph'><div style='position: relative; top: 0px; left: 20%; width: 10px; padding-top: 10px; color: white; font-weight: bold;'>" . $d . "</div></div></td>";
            } else {
                $form .= "<td style='border: none; padding: 0px; width: 100px; height: 300px; position: relative;'><div style='background-color: " . rand_color() . "; width: 50px; height: " . ($d / $highest * 270) . "px; position: absolute; bottom: 0px; right: 25px;'></div></td>";
            }
        }
        $form .= "</tr><tr>";
        foreach ($datanames as $n) {
            $form .= "<td style='border: none; padding: 0px; position: relative;'><div style='text-align: center;'>" . $n . "</div></td>";
        }
        $form .= "<td rowspan='0'></td></tr></table></td></tr></table><a></br>".$datanameslabel."</a></div>";
    }
    return $form;
}

function makeTable($data, $datanames, $datalabel, $datanameslabel)
{
    $form = "";
    $form .= "
    <table class='maketable'>
    <tr><td>" . $datalabel . "</td><td>" . $datanameslabel . "</td></td>";

    for ($b = 0; $b < count($data); $b++) {
        $form .= "<tr>";
        $form .= "<td>" . $data[$b] . "</td>" . "<td>" . $datanames[$b] . "</td>";
        $form .= "</tr>";
    }

    $form .= "
    </table>
    ";
    return $form;
}

// function plotPieChart($data, $datanames, $title, $color) {
//     $form = "";
//     $total = 0;
//     foreach ($data as $d) {
//         $total += $d;
//     }

//     $form .= "<div style='width: 300px; height: 300px; border: solid black 1px;'><a class='myunititle' style='margin: 20px;'>".$title."</a>";
//     $form .= "<div style='width: 200px; height: 200px; border: solid black 1px; border-radius: 50%; background-image: ";
//     $degcount = 90;
//     $degree = 0;
//     $string = "";
//     for ($v = 0; $v < count($data); $v++) {
//         if ($v == 0) {
//             $degree += $degcount;
//             $string .= "linear-gradient(".$degree."deg, transparent 50%, ".rand_color()." 50%)";
//         } else {
//             $degree += $data[$v]/$total * 360;
//             $string = "linear-gradient(".$degree."deg, transparent 50%, ".rand_color()." 50%), " . $string;
//         }
//     }
//     $form .= $string . ";'>";


//     $form .= "</div></div></div>";
//     return $form;
// }

function rand_color()
{
    return '#' . str_pad(dechex(random_int(0, 555555)), 6, '0', STR_PAD_LEFT);
}
