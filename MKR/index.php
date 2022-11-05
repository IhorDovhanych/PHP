<?php

/*На сервері зберігається список студентів Товарів (Id, Назва,
Країна виробника, Ціна). Розробити Web сторінку для перегляду всього
списку товарів. Розмістити біля кожного товару кнопку для вилучення
його даних.
 * */

class Repository
{
    public $dbh;
    public function __construct($dbh){
        $this->dbh = $dbh;
    }
    public function addGoods(string $userName, string $userCountry, int $userPrice ){
        $this->dbh->query('INSERT INTO goodsTable(name, country, price) VALUES (' .
            "'" . $userName . "', " .
            "'" . $userCountry . "', " .
            "'" . $userPrice . "')"
        );
    }
    public function readGoods()
    {
        return $this->dbh->query('SELECT * FROM goodsTable')->fetchAll();
    }
    public function updateGoods(int $userId, string $userName, string $userCountry, int $userPrice){
        $this->dbh->query('UPDATE factoriesTable SET ' .
            'name = ' . $userName . ', ' .
            'country = ' . $userCountry . ', ' .
            'price = ' . $userPrice . ', ' .
            'WHERE id = ' . $userId);
    }

    public function deleteGoods($id){
        return $this->dbh->query("DELETE FROM goodsTable WHERE id = " . $id);
    }
}
$dbh = new PDO('mysql:host=localhost;dbname=Goods', 'root', '');
$goods = new Repository($dbh);
?>
<table border="1px solid">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>country</th>
        <th>price</th>
        <th>operation</th>
    </tr>
<?php
//$goods->addGoods("Bread", "Brazil", 40);
//for($i = 0; $i < count($goods->readGoods()); $i++){
//    $id = $goods->readGoods()[$i]['id'];
//    echo "<form method='post'> <tr>";
//    echo '<td>' . $id . '</td>';
//    echo '<td>' . $goods->readGoods()[$i]['name'] . '</td>';
//    echo '<td>' . $goods->readGoods()[$i]['country'] . '</td>';
//    echo '<td>' . $goods->readGoods()[$i]['price'] . '</td>';
//    echo '<td>' . "<input type='submit' name='btn$id' id='btn$id' value='DELETE$id'/>" . '</td>';
//    echo "</tr> </form>";
//    foreach($goods->readGoods() as $value){
//        if(array_key_exists("btn$id", $_POST)){
//            $goods->deleteGoods($id);
//        }
//    }
//}
foreach ($goods->readGoods() as $value){
    $id = $value['id'];
    if(array_key_exists("btn$id", $_POST)){
        $goods->deleteGoods($id);
    }
}
foreach ($goods->readGoods() as $value){
    $id = $value['id'];
    echo "<form method='post'> <tr>";
    echo '<td>' . $id . '</td>';
    echo '<td>' . $value['name'] . '</td>';
    echo '<td>' . $value['country'] . '</td>';
    echo '<td>' . $value['price'] . '</td>';
    echo '<td>' . "<input type='submit' name='btn$id' id='btn$id' value='DELETE$id'/>" . '</td>';
    echo "</tr> </form>";
}

?>
</table>

