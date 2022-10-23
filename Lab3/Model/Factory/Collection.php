<?php

namespace Model\Factory;

use Interface\FactoryCollectionInterface;
use Interface\FactoryInterface;

class Collection implements FactoryCollectionInterface
{

    public function __construct($factoryArr = [])
    {
        $this->factoryArr = $factoryArr;
    }

    public function getFactoryArr(){
        return $this->factoryArr;
    }
    public function setFactoryArr($factoryArr = []):FactoryCollectionInterface{
        $this->factoryArr = $factoryArr;
        return $this;
    }

    public function addFactory(FactoryInterface $factory): FactoryCollectionInterface
    {
        $this->factoryArr[] = $factory;
        return $this;
    }

    public function removeFactoryById(int $id): FactoryCollectionInterface
    {
        for ($i = 0; $i < count($this->factoryArr); $i++) {
            if ($this->factoryArr[$i]['id'] == $id) {
                unset($this->factoryArr[$i]);
            }
        }
        return $this;
    }

}
