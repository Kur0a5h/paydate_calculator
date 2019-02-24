<?php

include 'MyPaydateCalculator.php';
use DevXyz\Challenge\KuroashEsmaili\PaydateCalculator;

$paydateOne = $_POST['paydateOne'];
$numberOfPaydates = $_POST['numberOfPaydates'];
$paydateModel = $_POST['paydateModel'];

$paydateCalculator = new PaydateCalculator( $paydateOne, $numberOfPaydates, $paydateModel );
echo $paydateCalculator->calculateNextPaydates( $paydateOne, $numberOfPaydates, $paydateModel );