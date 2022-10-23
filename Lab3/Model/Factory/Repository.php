<?php

namespace Model\Factory;

use Interface\FactoryCollectionInterface;
use Model\Factory;

class Repository
{
    public function createNewFile(string $fileName){
        $file = fopen("./$fileName.txt",'w+');
        fclose($file);
    }
    public function loadDataFromFile(string $fileName): FactoryCollectionInterface
    {
        $lines = file("./$fileName.txt", FILE_SKIP_EMPTY_LINES);
        $dict = new Collection([]);
        foreach ($lines as $line) {
            $lineArr = explode(' ', $line);

            $dict->addFactory(new Factory((int)$lineArr[0], $lineArr[1], (int)$lineArr[2], $lineArr[3], $lineArr[4]));
        }
        return $dict;
    }

    public function storeDataToFile(FactoryCollectionInterface $factoryCollection, string $fileName)
    {
        $dataStr = '';
        for($i = 0; $i < count($factoryCollection->getFactoryArr()); $i++){
            $dataStr .= $factoryCollection->getFactoryArr()[$i]->getId() . ' ' .
                $factoryCollection->getFactoryArr()[$i]->getName() . ' ' .
                $factoryCollection->getFactoryArr()[$i]->getStaffNumber() . ' ' .
                $factoryCollection->getFactoryArr()[$i]->getBranch() . ' ' .
                $factoryCollection->getFactoryArr()[$i]->getAddress() . "\n";
        }
        file_put_contents("./$fileName.txt", "$dataStr", FILE_APPEND);
    }
}
