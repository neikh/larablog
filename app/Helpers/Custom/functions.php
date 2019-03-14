<?php

    namespace App\Helpers\Custom;

    class Functions {

        public static function limit_text($text, $limit) {
            if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos = array_keys($words);
                $text = substr($text, 0, $pos[$limit]) . '...';
            }
            return $text;
        }

        public static function dateWritter($date){
            $dateDaySec = explode(" ", $date);
            $months = array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

            if (isset($dateDaySec[0]) AND isset($dateDaySec[1])){
                $bigDate = explode("-", $dateDaySec[0]);
                $lilDate = explode(":", $dateDaySec[1]);

                $year = (int)$bigDate[0];
                $month = (int)$bigDate[1];
                $day = (int)$bigDate[2];

                $hour = (int)$lilDate[0];
                $minute = (int)$lilDate[1];
                $second = (int)$lilDate[2];

                if ($day == 1){
                    $sup = "st";
                } elseif ($day == 2){
                    $sup = "nd";
                } else {
                    $sup = "th";
                }

                return $day."<sup>".$sup."</sup> ".$months[$month]." ".$year.", at ".$hour."h ".$minute."m ".$second."s";
            } else {
                return NULL;
            }
        }
    }
