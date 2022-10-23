<?php

namespace Interface;

interface FactoryCollectionInterface
{

    public function addFactory(FactoryInterface $factory): FactoryCollectionInterface;

    public function removeFactoryById(int $id): FactoryCollectionInterface;
}
