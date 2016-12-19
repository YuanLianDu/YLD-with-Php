<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 16/12/19
 * Time: 11:46
 */

function closureInFunction() {
	$closure = function($str) {
		echo $str;
	};
	return $closure('closureInFunction');
}

//closureInFunction();


function returnClosureInFunction() {
	$closure = function($str) {
		echo $str;
	};

	return $closure;
}

/*$getClosure = returnClosureInFunction();
$getClosure('return Closure In Function');*/

/*function invokeClosureFunction($func,$content) {
		$func($content);
}

$closure = function($content) {
	echo $content;
};

invokeClosureFunction($closure,'closure function can as parameter');*/

function echoStr(){
	$num = 1;

	$invokeOutsideParam = function () use(&$num) {
		echo $num;
		$num ++;
	};

	return $invokeOutsideParam;
}

$echostr = echoStr();
$echostr();
$echostr();