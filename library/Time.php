<?php

class Time {

    public static function time_left($ptime) {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str);
            }
        }
    }

    public static function time_right($ptime) {
		/*
        $etime = $ptime - time();
        //echo $etime;
        if ($etime > 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ';
            }
        }*/
		$ptime = $ptime - time();
		$t = round($ptime);
		$d = $t/86400;
		$h = $t/3600%24;
		$m = $t/60%60;
		$s = $t%60;
		$result = [];
		if($d >= 1){
			//$result = sprintf('%02dd, %02dh, %02dm, %02ds.',$d,$h,$m,$s);
			// $result = sprintf('<span class="gold">%02d day</span>, <span class="gold">%02d hour</span>, <span class="gold">%02d minute</span>, <span class="gold">%02d second</span>',$d,$h,$m,$s);
			$result['day'] = $d;
			$result['h'] = $h;
			$result['m'] = $m;
			$result['s'] = $s;
		} elseif($h >= 1) {
			//$result = sprintf('%02dh, %02dm, %02ds.',$h,$m,$s);
			// $result = sprintf('<span class="gold">%02d hour</span>, <span class="gold">%02d minute</span>, <span class="gold">%02d second</span>', $h,$m,$s);
			$result['day'] = null;
			$result['h'] = $h;
			$result['m'] = $m;
			$result['s'] = $s;
		} elseif($m >= 1) {
			//$result = sprintf('%02dm, %02ds.',$m,$s);
			// $result = sprintf('<span class="gold">%02d minute</span>, <span class="gold">%02d second</span>', $m,$s);
			$result['day'] = null;
			$result['h'] = null;
			$result['m'] = $m;
			$result['s'] = $s;
		} elseif($s >= 1) {
			//$result = sprintf('%02d second.',$s);
			// $result = sprintf('<span class="gold">%02d second</span>', $s);
			$result['day'] = null;
			$result['h'] = null;
			$result['m'] = null;
			$result['s'] = $s;
		} else {
			$result = [];
		}
		return $result;
    }
}
