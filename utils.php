<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("calendar.php");
date_default_timezone_set("Asia/Jakarta");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '/Applications/XAMPP/xamppfiles/htdocs/CS-IA/Exception.php';
require '/Applications/XAMPP/xamppfiles/htdocs/CS-IA/PHPMailer.php';
require '/Applications/XAMPP/xamppfiles/htdocs/CS-IA/SMTP.php';


class CurrentUser {
    public $usertype;
    public $userid;
    public function __construct(string $usertype, int $userid) {
        $this->userid = $userid;
        $this->usertype = $usertype;
    }
    function getinfo() {
        return $this->userid;
    }
}
$currentuser = new CurrentUser("", 0);

function sendquery(string $query) {
    //Connecting to mysql databse
    $serverName = "localhost";
    $username = "Comsci";
    $password = "password";
    $dbName = "CS-IA";

    $con = mysqli_connect($serverName, $username, $password, $dbName);

    if (mysqli_connect_errno()) {
        echo "Failed to connect";
        exit();
    }

    //Execute script
    $result = mysqli_query($con, $query);
    //Extracting data
    if (is_object($result)) {
        $result2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        if ($result2 != null) {
            return $result2;
        }
    }
    //Free memory of result variable
    //Closing connection
    mysqli_close($con);
}

function str2array($string) {
    return explode(", ", $string);
}

function arrayfirst($array) {
    if ($array != null) {
        return reset($array[0]);
    }
}

function printnestedarray($array) {
    $result = "";
    foreach ($array as $arrayitem) {
        foreach ($arrayitem as $item) {
            $result .= $item.", ";
        }
    } 
    echo $result;
}

function checkEmptyString(array $values) {
    foreach ($values as $value) {
        if ($value == "") {
            return FALSE;
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

// FUNCTION EXAMPLES:
// searchquery("Counsellors", "firstname", "school", "Sinarmas World Academy")
// addstudentquery("David", "Shane", "Goh", "23davidg@swa-jkt.com", "david@gmail.com", "2005-1-01", "male", "Jakarta", "Sinarmas World Academy", "8111399275", "password", "qwertyuiop", "Indonesia", "Indonesia", 11, "2023", "Math, Physics, Chemistry", "Chinese, English, Economics", "7, 7, 7", "6, 6, 6", "Math olimpiades", "Badminton Club", "1340", "26");
// addcounsellorquery("Stanislav", "Karel", "Sousek", "stanislav_sousek@swa-jkt.com", "stan@gmail.com", "1990-1-01", "male", "Jakarta", "Sinarmas World Academy", "7499567233", "password", "poiuytrewq");
// addcounsellorquery("Test1", "Test2", "Test3", "test@swa-jkt.com", "test@gmail.com", "1990-01-01", "male", "test address", "SWA", "08111833945", password_hash("password", PASSWORD_DEFAULT), "abcdefg");
// addteacherquery("Myungok", "", "Lee", "myungkl@swa-jkt.com", "marie@gmail.com", "1990-1-01", "female", "BSD", "Sinarmas World Academy", "3744995522877", "password", "mnbvcxz", "Math");
// updatevalue("Counsellors", "firstname", "Stanislav", "middlename", "Karel");
// deleteobject("Counsellors", "lastname", "BOB");
// $hash = password_hash($password, PASSWORD_DEFAULT);
// echo var_dump(password_verify("password", arrayfirst(searchquery("Counsellors", "password", "firstname", "Testy"))));

//MYSQL FUNCTIONS
function searchquery(string $table, string $fromcolumn, string $incolumn, string $searchkey) {
    if ($fromcolumn === "*") {
        return sendquery('SELECT * FROM `'.$table.'` WHERE `'.$incolumn.'` = "'.$searchkey.'"');
    } else {
        return sendquery('SELECT `'.$fromcolumn.'` FROM `'.$table.'` WHERE `'.$incolumn.'` = "'.$searchkey.'"');
    }
}

function geteventid(string $table, int $userid, string $usertype ) {
    return sendquery('SELECT `id` FROM `'.$table.'` WHERE `receiverid` = "'.$userid.'" AND `receivertype` = "'.$usertype.'"');
}

function addstudentquery(string $firstname, string $middlename, string $lastname, string $schoolemail, string $personalemail, string $dob, string $sex, string $address, string $school, string $phone, string $password, string $profileimage, string $citizenship, string $country, int $grade, string $graduation, string $hlsubjects, string $slsubjects, string $hlscores, string $slscores, string $accomplishments, string $activities, string $sat, string $act) {
    sendquery('INSERT INTO `Students`(`firstname`, `middlename`, `lastname`, `schoolemail`, `personalemail`, `dob`, `sex`, `address`, `school`, `phone`, `password`, `profileimage`, `citizenship`, `country`, `grade`, `graduation`, `hlsubjects`, `slsubjects`, `hlscores`, `slscores`, `accomplishments`, `activities`, `sat`, `act`) VALUES ("'.$firstname.'","'.$middlename.'","'.$lastname.'","'.$schoolemail.'","'.$personalemail.'","'.$dob.'","'.$sex.'","'.$address.'","'.$school.'","'.$phone.'","'.$password.'","'.$profileimage.'","'.$citizenship.'","'.$country.'",'.$grade.',"'.$graduation.'","'.$hlsubjects.'","'.$slsubjects.'","'.$hlscores.'","'.$slscores.'","'.$accomplishments.'","'.$activities.'","'.$sat.'","'.$act.'")');
}

function addcounsellorquery(string $firstname, string $middlename, string $lastname, string $schoolemail, string $personalemail, string $dob, string $sex, string $address, string $school, string $phone, string $password, string $profileimage) {
    sendquery('INSERT INTO `Counsellors`(`firstname`, `middlename`, `lastname`, `schoolemail`, `personalemail`, `dob`, `sex`, `address`, `school`, `phone`, `password`, `profileimage`) VALUES ("'.$firstname.'","'.$middlename.'","'.$lastname.'","'.$schoolemail.'","'.$personalemail.'","'.$dob.'","'.$sex.'","'.$address.'","'.$school.'","'.$phone.'","'.$password.'","'.$profileimage.'")');
}

function addteacherquery(string $firstname, string $middlename, string $lastname, string $schoolemail, string $personalemail, string $dob, string $sex, string $address, string $school, string $phone, string $password, string $profileimage, string $subject) {
    sendquery('INSERT INTO `Teachers`(`firstname`, `middlename`, `lastname`, `schoolemail`, `personalemail`, `dob`, `sex`, `address`, `school`, `phone`, `password`, `profileimage`, `subject`) VALUES ("'.$firstname.'","'.$middlename.'","'.$lastname.'","'.$schoolemail.'","'.$personalemail.'","'.$dob.'","'.$sex.'","'.$address.'","'.$school.'","'.$phone.'","'.$password.'","'.$profileimage.'","'.$subject.'")');
}

function updatevalue($table, $column, $value, $columnsearch, $search) {
    sendquery('UPDATE `'.$table.'` SET `'.$column.'` = "'.$value.'" WHERE `'.$columnsearch.'` = "'.$search.'"');
}

function deleteobject($table, $columnsearch, $search) {
    sendquery('DELETE FROM `'.$table.'` WHERE `'.$columnsearch.'` = "'.$search.'"');
}

function addCalendarEvent(string $txt, string $date, int $creatorid, int $receiverid, string $receivertype, string $info, int $days, string $color) {
    sendquery('INSERT INTO `Events`(`date`, `title`, `days`, `color`, `creatorid`, `receiverid`, `receivertype`, `info`) VALUES ("'.$date.'","'.$txt.'",'.$days.',"'.$color.'",'.$creatorid.','.$receiverid.',"'.$receivertype.'","'.$info.'")');
}

function addlogin(string $usertype, int $userid, string $logintime, string $logouttime) {
    sendquery('INSERT INTO `Logins`(`usertype`, `userid`, `logintime`, `logouttime`) VALUES ("'.$usertype.'","'.$userid.'","'.$logintime.'","'.$logouttime.'")');
}

function startSession() {
    $i = 1;
    $finished = false;
    $latest = 0;
    while (!$finished) {
        if (searchquery("Logins", "logintime", "loginid", $i) == null) {
            $finished = true;
        } else if (arrayfirst(searchquery("Logins", "logouttime", "loginid", $i)) == null) {
            //check for timeout and set timeout
            if (timeDifference($i) > 60) {
                updatevalue("Logins", "logouttime", date("Y-m-d,h:i:s"), "loginid", $i);
            } else {
                if ($latest == 0) {
                    $latest = $i;
                } else if (timeDifference($i) < timeDifference($latest)) {
                    $latest = $i;
                }
            }
        }
        $i += 1;
    }
    $logintype = "";
    if (arrayfirst(searchquery("Logins", "usertype", "loginid", $latest)) == "counsellor") {
        $logintype = "Counsellors";
    } else if (arrayfirst(searchquery("Logins", "usertype", "loginid", $latest)) == "teacher") {
        $logintype = "Teachers";
    } else if (arrayfirst(searchquery("Logins", "usertype", "loginid", $latest)) == "student") {
        $logintype = "Students";
    }
    global $currentuser;
    $actualuserid = arrayfirst(searchquery("Logins", "userid", "loginid", $latest));
    if ($latest != null) {
        $currentuser = new CurrentUser($logintype, $actualuserid);
    } else {
        header("Location: loginpage.php");
    }
}

function timeDifference(int $id) {
    $current_time = strtotime(date("Y-m-d,h:i:s"));
    $from_time = strtotime(arrayfirst(searchquery("Logins", "logintime", "loginid", $id)));
    $difference = round(abs($current_time - $from_time) / 60,2);
    return $difference;
}

function sendEmail($address, $otp) {
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Mailer = 'smtp';
    try {
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'joshuacomsci123@gmail.com';
        $mail->Password = 'zbacxibbmbtpnnuj';
        //Recipients
        $mail->IsHTML(true);
        $mail->AddAddress($address);
        $mail->SetFrom('joshuacomsci123@gmail.com', 'SWA UniAPP');
        $mail->Subject = 'OTP For Your SWA UniAPP Password';
        $content = '
        <html>
        <body foreground-color="blue">
        <center><h1>Your OTP</h1></center>
        <center><h2>'.$otp.'</h2></center>
        <center><h3>Input your OTP in the <a href="http://localhost/CS-IA/forgotpasswordpage.php" style="text-decoration: none;">Forgot Password Page</a> to change your SWA UniAPP password</h3></center>
        </body>
        </html>
        ';
        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    } catch (exception $e){
        return false;
    }
}

function sendEmail2($address, $msg) {
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Mailer = 'smtp';
    try {
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Host = 'smtp.gmail.com';
        $mail->Username = 'joshuacomsci123@gmail.com';
        $mail->Password = 'zbacxibbmbtpnnuj';
        //Recipients
        $mail->IsHTML(true);
        $mail->AddAddress($address);
        $mail->SetFrom('joshuacomsci123@gmail.com', 'SWA UniAPP');
        $mail->Subject = 'New Notification in SWA UniApp';
        $content = '
        <html>
        <body foreground-color="blue">
        <center><h2>Notification from your counsellor</h2></center>
        <center><h3>'.$msg.'</h3></center>
        </body>
        </html>
        ';
        $mail->MsgHTML($content);
        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    } catch (exception $e){
        return false;
    }
}

function generateOTP() {
    return rand(1000, 9999);
}

function findUserTypeFromEmail($email) {
    if (arrayfirst(searchquery("Students", "id", "schoolemail", $email)) != null) {
        return "Students";
    } else if (arrayfirst(searchquery("Counsellors", "id", "schoolemail", $email)) != null) {
        return "Counsellors";
    } else if (arrayfirst(searchquery("Teachers", "id", "schoolemail", $email)) != null) {
        return "Teachers";
    } else {
        return "";
    }
}

function showPassword($id) {
    echo "
    <script>
    function showPassword() {
        var x = document.getElementById('".$id."');
        if (x.type === 'password') {
            x.type = 'text';
        } else {
            x.type = 'password';
        }
    }
    </script>
    ";
    // need javascript id on the password textfield
    // checkbox needs showPassword() onclick function
    // the form must be in "" quotes
    // <tr><td colspan='2' align='center' height='10px'><input type='checkbox' onclick='showPassword()'>Show Password</td></tr>
    // ".showPassword("password")."
}