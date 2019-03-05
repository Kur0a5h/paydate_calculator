<?php

include 'MyPaydateCalculator.php';
use DevXyz\Challenge\KuroashEsmaili\PaydateCalculator;

$paydateOne = $_POST['paydateOne'];
$numberOfPaydates = $_POST['numberOfPaydates'];
$paydateModel = $_POST['paydateModel'];

echo $paydateOne;
$paydateCalculator = new PaydateCalculator( $paydateOne, $numberOfPaydates, $paydateModel );
echo $paydateCalculator->calculateNextPaydates( $paydateModel, $paydateOne, $numberOfPaydates );