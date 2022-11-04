<?php

namespace Interface;

interface FactoryInterface
{

    public function getId(): int;

    public function setId(int $id): FactoryInterface;

    public function getName(): string;

    public function setName(string $name): FactoryInterface;

    public function getStaffNumber(): int;

    public function setStaffNumber(int $staffNumber): FactoryInterface;

    public function getBranch(): string;

    public function setBranch(string $branch): FactoryInterface;

    public function getAddress(): string;

    public function setAddress(string $address): FactoryInterface;
}
