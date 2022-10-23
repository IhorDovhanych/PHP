<?php

use Model\Factory;
use Model\Factory\Collection;
use Model\Factory\Repository;

$factory = new Factory(1, 'Dik', 50, 'bakery', 'Uzhorod');

var_dump($factory->getId());