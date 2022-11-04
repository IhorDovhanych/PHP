<?php

namespace Model\Factory;

use Interface\FactoryCollectionInterface;
use Model\Factory;

class Repository
{
    public $dbh;
    public function __construct($dbh){
        $this->dbh = $dbh;
    }
    public function addFactory(string $userName, int $userStaffNumber, string $userBranch, string $userAddress){
        $this->dbh->query('INSERT INTO factoriesTable(name, staffNumber, branch, address) VALUES (' .
            "'" . $userName . "', " .
            "'" . $userStaffNumber . "', " .
            "'" . $userBranch . "', " .
            "'" . $userAddress . "')"
        );
    }
    public function readFactories()
    {
        return $this->dbh->query('SELECT * FROM factoriesTable')->fetchAll();
    }
    public function updateFactory(int $userId, string $userName, int $userStaffNumber, string $userBranch, string $userAddress){
        $this->dbh->query('UPDATE factoriesTable SET ' .
            'name = ' . $userName . ', ' .
            'staffNumber = ' . $userStaffNumber . ', ' .
            'branch = ' . $userBranch . ', ' .
            'address = ' . $userAddress . ' , ' .
            'WHERE id = ' . $userId);
    }

    public function deleteFactory($id){
        return $this->dbh->query("DELETE FROM factoriesTable WHERE id = " . $id);
    }
}
