<?php

namespace Model;

use Interface\FactoryInterface;

class Factory implements FactoryInterface
{
    public function __construct(int $id = 0, string $name = "none", int $staffNumber = 1, string $branch = "none", string $address = "none")
    {
        $this->id = $id;
        $this->name = $name;
        $this->staffNumber = $staffNumber;
        $this->branch = $branch;
        $this->address = $address;
    }

    public function getFromBranchWithNumber(string $branch, int $x, int $y, array $args)
    {
        $arr = array();
        for ($i = 0; $i < count($args); $i++) {
            if ($args[$i]->branch == $branch) {
                if ($args[$i]->staffNumber >= $x && $args[$i]->staffNumber <= $y) {

                    array_push($arr, $args[$i]);
                }
            }
        }
        return $arr;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): FactoryInterface
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): FactoryInterface
    {
        $this->name = $name;
        return $this;
    }

    public function getStaffNumber(): int
    {
        return $this->staffNumber;
    }

    public function setStaffNumber(int $staffNumber): FactoryInterface
    {
        $this->staffNumber = $staffNumber;
        return $this;
    }

    public function getBranch(): string
    {
        return $this->branch;
    }

    public function setBranch(string $branch): FactoryInterface
    {
        $this->branch = $branch;
        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): FactoryInterface
    {
        $this->address = $address;
        return $this;
    }


}
