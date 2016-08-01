<?php
/**
 * Created by PhpStorm.
 * User: yuan
 * Date: 16/8/1
 * Time: 17:06
 */
funcChop();
function funcChop() {
	$str = "Hello World";
	echo $str . "<br>";
	echo chop($str,"World!");
}