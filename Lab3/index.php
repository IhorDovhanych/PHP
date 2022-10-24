<?php

use Model\Factory;
use Model\Factory\Collection;
use Model\Factory\Repository;

function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');


$factory1 = new Factory(1, 'Dik', 50, 'bakery', 'Uzhorod');
$factory2 = new Factory(2, 'PoloninskiyHlib', 50, 'bakery', 'Uzhorod');

$factoryCollection = new Collection([$factory1, $factory2]);
$saveFactoryCollection = new Repository();
var_dump($saveFactoryCollection->loadDataFromFile('ok'));
//$saveFactoryCollection->createNewFile('ok');
//$saveFactoryCollection->storeDataToFile($factoryCollection,'ok');
