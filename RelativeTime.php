<?php
/**
 * Description of RelativeTime
 *
 * @author Seth<sethkwakwa@gmail.com>
 * Forked from https://gist.github.com/mattytemple/3804571
 */

class RelativeTime {

    public $messages = array(
        'now' => 'now',
        'just_now' => 'Just Now',
        'mins_ago' => 'minute ago',
        '1_min_ago' => '1 minute ago',
        '1_hour_ago' => '1 hour ago',
        'hours_ago' => 'hours ago',
        'yesterday' => 'Yesterday',
        'days_ago' => 'days ago',
        'weeks_ago' => 'weeks ago',
        'last_month' => 'last month',
        'tomorrow' => 'tomorrow',
        'in_a_minute' => 'in a minute',
        'in_minute' => 'in {item} minute',
        'in_an_hour' => 'in an hour',
        'in_hour' => 'in {item} hour',
        'week' => 'week',
        'weeks' => 'weeks',
        'next_week' => 'next week',
        'next_month' => 'next month',
        'hour' => 'hour'
    );

    public function __construct($messages = array()) {
        $this->messages = (count($messages) > 0) ? $messages : $this->messages;
    }

   /***
    * 
    */
   public  function GetTime($ts) {
    if(!ctype_digit($ts)) {
        $ts = strtotime($ts);
    }
    $diff = time() - $ts;
        if ($diff == 0) {
            return $this->messages['now'];
            ;
        } elseif ($diff > 0) {
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 60)
                    return $this->messages['just_now'];
                if ($diff < 120)
                    return $this->messages['1_min_ago'];;
                if ($diff < 3600)
                    return floor($diff / 60) . $this->messages['mins_ago'];;
                if ($diff < 7200)
                    return $this->messages['1_hour_ago'];;
                if ($diff < 86400)
                    return floor($diff / 3600) . $this->messages['hours_ago'];;
            }
            if ($day_diff == 1) {
                return $this->messages['yesterday'];
            }
            if ($day_diff < 7) {
                return $day_diff . $this->messages['days_ago'];
            }
            if ($day_diff < 31) {
                return ceil($day_diff / 7) . $this->messages['weeks_ago'];
                ;
            }
            if ($day_diff < 60) {
                return $this->messages['last_month'];
                ;
            }
            return date('F Y', $ts);
        } else {
            $diff = abs($diff);
            $day_diff = floor($diff / 86400);
            if ($day_diff == 0) {
                if ($diff < 120) {
                    return $this->messages['in_a_minute'];
                    ;
                }
                if ($diff < 3600) {
                  
                    return str_replace("{item}", floor($diff / 60), $this->messages['in_minute']);
                }
                if ($diff < 7200) {
                    return $this->messages['in_an_hour'];
                }
                if ($diff < 86400) {
                    return str_replace("{item}", floor($diff / 3600), $this->messages['in_hours']);
                }
            }
            if ($day_diff == 1) {
                return $this->messages['tomorrow'];
            }
            if ($day_diff < 4) {
                return date('l', $ts);
            }
            if ($day_diff < 7 + (7 - date('w'))) {
                return $this->messages['next_week'];
            }
            if (ceil($day_diff / 7) < 4) {
                return str_replace("{item}", ceil($day_diff / 7), $this->messages['in_weeks']);
            }
            if (date('n', $ts) == date('n') + 1) {
                return $this->messages['next_month'];
            }
            return date('F Y', $ts);
        }
    }

}
