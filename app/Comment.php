<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

	public function comment()
	{
		return $this->belongsTo('App\Post');
    }

    public function dateWritter($date){
		$dateDaySec = explode(" ", $date);

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

			return $day."<sup>".$sup."</sup> ".$this->month($month)." ".$year.", at ".$hour."h ".$minute."m ".$second."s";
		} else {
			return NULL;
		}
	}

	public function month($m){
		$month = array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

		return $month[$m];
	}
}
