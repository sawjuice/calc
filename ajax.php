<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
require_once 'calc.class.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$expression = new Calc($_POST['expression']);

	$result = $expression->getResult();

	echo json_encode(['result'=>$result]);
}