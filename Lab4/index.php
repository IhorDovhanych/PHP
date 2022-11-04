<?php

use Model\Factory;
use Model\Factory\Collection;
use Model\Factory\Repository;



$dbh = new PDO('mysql:host=localhost;dbname=Factories', 'root', '');

function myAutoloader($class_name)
{
    if (!class_exists($class_name)) {
        include $class_name . '.php';
    }
}

spl_autoload_register('myAutoloader');


$factory1 = new Factory(1, "Dik", 50, "bakery", "Uzhorod");
$factory2 = new Factory(2, 'PoloninskiyHlib', 50, 'bakery', 'Uzhorod');

$factoryCollection = new Collection([$factory1, $factory2]);
$saveFactoryCollection = new Repository($dbh);

//$saveFactoryCollection->addFactory(
//    $factory1->getName(),
//    $factory1->getStaffNumber(),
//    $factory1->getBranch(),
//    $factory1->getAddress()
//);

//$saveFactoryCollection->deleteFactory(2);
var_dump($saveFactoryCollection->readFactories());
//$saveFactoryCollection->createNewFile('ok');
//$saveFactoryCollection->storeDataToFile($factoryCollection,'ok');
