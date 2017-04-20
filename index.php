<?php

require('vendor/autoload.php');

require('scrapper.php');


$scrapper = new Scrapper();
$scrapper->getMonsterDetail('Chicken_God');
