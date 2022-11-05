<?php

/*На сервері зберігається список студентів Товарів (Id, Назва,
Країна виробника, Ціна). Розробити Web сторінку для перегляду всього
списку товарів. Розмістити біля кожного товару кнопку для вилучення
його даних.
 * */

class Goods{
    public int $id, $price;
    public string $name,$country;
    public function __construct(int $id, string $name, string $country, int $price){
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->price = $price;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getCountry(){
        return $this->country;
    }
    public function getPrice(){
        return $this->price;
    }
}
class GoodsCollection{
    public array $goodList;
    public function __construct($goodsList = []){
        $this->goodsList = $goodsList;
    }
    public function getGoodsList(){
        return $this->goodsList;
    }
    public function AddGoods(Goods $goods){
        $this->goodList[] = $goods;
    }
}

$goods1 = new Goods(1,'condoms','Brazil','100');
$goods2 = new Goods(2,'cock','USA','30');
$arr = [$goods1, $goods2];
$goodsList = new GoodsCollection($arr);
$count = count($goodsList->getGoodsList());
function DeleteGoods($arr, $id){
    return [
        array_splice($arr,$id)
    ];
}

function ShowData($arr,$delete){
    for($i = 0; $i < count($arr); $i++){
        echo $arr[$i]->getId() . ", " .
            $arr[$i]->getName() . ", " .
            $arr[$i]->getCountry() . ", " .
            $arr[$i]->getPrice() . ", " .
            "<button onclick='$delete'>Delete</button>";
    }
}

ShowData($goodsList->getGoodsList(), DeleteGoods($goodsList->getGoodsList(), 1));

?>

