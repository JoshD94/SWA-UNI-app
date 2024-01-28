<?php
// https://codeshack.io/event-calendar-php/
include_once("utils.php");

class Calendar {
    private $active_year, $active_month, $active_day, $currentView, $currentuser;
    private $events = [];

    public function __construct($user, $date = null) {
        $user->getinfo();
        $this->currentuser = $user;
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
        $this->currentView = TRUE;
    }

    public function setMonth($date) {
        if (date('Y', strtotime($date)) == $this->active_year && date('m', strtotime($date)) == $this->active_month) {
            $this->currentView = TRUE;
        } else {
            $this->currentView = FALSE;
            $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
            $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        }
    }

    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function __toString() {
        //get id of events
        $idlist = geteventid("Events", $this->currentuser->userid, $this->currentuser->usertype);
        //loop through ids to get events and add to array, addevent function
        if (!is_null($idlist)) {
            foreach ($idlist as $item) {
                $this->events[] = [arrayfirst(searchquery("Events", "title", "id", (string) $item['id'])), arrayfirst(searchquery("Events", "date", "id", (string) $item['id'])), intval(searchquery("Events", "days", "id", (string) $item['id'])), arrayfirst(searchquery("Events", "color", "id", (string) $item['id']))];
            }
        }
        if ($this->currentuser->usertype == "Students") {
            //include the uni deadlines in mystarred
            $unicount = 0;
            $unistarred = [];
            $mystarred = [];
            while (arrayfirst(searchquery("Universities", "name", "id", $unicount)) != null) {
                array_push($unistarred, str2array(arrayfirst(searchquery("Universities", "starred", "id", $unicount))));
                $unicount += 1;
            }
            for ($m = 0; $m < count($unistarred); $m++) {
                for ($n = 0; $n < strlen($unistarred[$m][0]); $n++) {
                    if (substr($unistarred[$m][0], $n, 1) == $this->currentuser->userid) {
                        array_push($mystarred, $m);
                        break;
                    }
                }
            }
            foreach ($mystarred as $uni) {
                $title = arrayfirst(searchquery("Universities", "name", "id", $uni)) . " deadline";
                $date = arrayfirst(searchquery("Universities", "deadline", "id", $uni));
                $days = 1;
                $color = "purple";
                $this->events[] = [$title, $date, $days, $color];
            }
        } else if ($this->currentuser->usertype == "Counsellors") {
            //include all unis
            $unicount = 0;
            $unistarred = [];
            while (arrayfirst(searchquery("Universities", "name", "id", $unicount)) != null) {
                array_push($unistarred, $unicount);
                $unicount += 1;
            }
            foreach ($unistarred as $uni) {
                $title = arrayfirst(searchquery("Universities", "name", "id", $uni)) . " deadline";
                $date = arrayfirst(searchquery("Universities", "deadline", "id", $uni));
                $days = 1;
                $color = "purple";
                $this->events[] = [$title, $date, $days, $color];
            }
        }
        
        echo "</br>";

        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day && $this->currentView) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event '.$event[3].'">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

}
