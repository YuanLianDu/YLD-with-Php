<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 16/12/26
 * Time: 11:09
 */

/*function  transTime($ustime)
{
	$ytime = date("Y-m-d H:i", $ustime);
	$rtime = date("n月j日 H:i", $ustime);
	$htime = date("H:i", $ustime);
	$time = time() - $ustime;
	$todaytime = strtotime("today");
	$time1 = time() - $todaytime;
	if ($time < 60) {
		$str = '刚刚';
	}else if ($time < 60 * 60) {
		$min = floor($time / 60);
		$str = $min . '分钟前';
	}else if ($time < $time1) {
		$str = '今天 ' . $htime;
	}else {
		$str = $rtime;
	}
	return $str;
}


var_dump(transTime('2016-12-26 03:01:52'));*/
function dumpTime()
{
	var_dump(date('Y-m-d H:i:s',time()));
	var_dump(date('d/m/Y H:i:s',time()));
	var_dump(date('d/m/y',time()));
	var_dump(date('g:i A',time()));
	var_dump(date('G:ia',time()));
	var_dump(date('g:ia \o\n l jS F Y',time()));
}
//dumpTime();

//时间差
function timeInterval() {
	$time = strtotime('2016-11-11 13:10:11');
	$timeOne = strtotime('2016-11-01 12:00:00');

	$interval = $time - $timeOne;
	$sec = $interval%60;
	$minu  = floor($interval/3600/24);
	$hour = floor($interval%(3600*24)/3600);
	$day = floor($interval/(3600*24));
	echo $day.'day'.$hour.'hour'.$minu.'minu'.$sec.'sec';
}

function timeIntervalByDateObject() {

	$timestamp = '1478833871';
	$datetime = new DateTime(date('Y-m-d H:i:s', $timestamp));
	$datetime_now = new DateTime();
	$interval = $datetime_now->diff($datetime);
//	var_dump($interval);
	echo $interval->days.'day'.$interval->h.'hour'.$interval->i.'minu'.$interval->s.'sec';
}

timeIntervalByDateObject();