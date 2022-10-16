<?php
function getSimpleData():array {
    $lines = file('./arrayData.txt');
    $dict = [];
    foreach ($lines as $line){
        $lineArr = explode(' ', $line);
        if(count($lineArr) != 5){
            $dict[] = [
                'id' => null,
                'name' => null,
                'staffNumber' => null,
                'branch' => null,
                'address' => null
            ];
        }
        else{
        $dict[] = [
            'id' => (int)$lineArr[0] or die('Error value'),
            'name' => $lineArr[1],
            'staffNumber' => (int)$lineArr[2] or die('Error value'),
            'branch' => $lineArr[3],
            'address' => $lineArr[4]
        ];
        }
    }

    return $dict;
}

function getUniqueId(array $factories, int $proposedId) {
    if (count($factories) == 0) {
        return $proposedId;
    }
    $max = $factories[0]['id'];
    foreach ($factories as $factory) {
        if ($factory['id'] > $max) {
            $max = $factory['id'];
        }
    }
    if ($proposedId > $max) {
        return $proposedId;
    }
    $max++;
    return $max;
}

function sortByStaffNumberInBranch(int $x, int $y, string $branch, $arr) {
    $newArr = [];
    for ($i = 0; $i < count($arr); $i++) {
        if ($branch == $arr[$i]["branch"] && $arr[$i]["staffNumber"] >= $x && $arr[$i]["staffNumber"] <= $y) {
            array_push($newArr, $arr[$i]);
        }
    }
    return $newArr;
}

function fullfillFactoryData($factories, $data):array {
    return [
        "id" => getUniqueId($factories, $data['id']),
        "name" => $data["name"],
        "staffNumber" => $data["staff"],
        "branch" => $data["branch"],
        "address" => $data["address"]
    ];
}

function validateFactoryData($data):bool {
    if (empty($data["id"])
        || empty($data["name"])
        || empty($data["staff"])
        || empty($data["branch"])
        || empty($data["address"])) {
        return false;
    }
    return true;
}

session_start();
//$_SESSION['factory'] = null;

$fourthPoint = $_GET['fourthPoint'];

if (isset($_SESSION['factory'])) {
    $factory = $_SESSION['factory'];
} else {
    $factory = getSimpleData();
}

if (!empty($_GET["edit"])) {
    if (validateFactoryData($_GET)) {
        for ($i = 0; $i < count($factory); $i++) {
            if ($_GET["edit"] == $factory[$i]["id"]) {
                $factory[$i] = fullfillFactoryData($factory, $_GET);
                break;
            }
        }
    } else {
        //TODO: Error handling
    }
} elseif (array_key_exists('id', $_GET)) {
    if (validateFactoryData($_GET)) {
        $factory[] = fullfillFactoryData($factory, $_GET);
    } else {
        //TODO: Error handling
    }
}

$_SESSION["factory"] = $factory;



echo "<h2>Таблиця всіх значень</h2>";
echo "<table border='1px'>";
echo "<tr> <th>Id</th> <th>Name</th> <th>Staff number</th> <th>Branch</th> <th>Address</th> </tr>";
for($i = 0; $i < count($factory); $i++){
    echo "<tr>";
    foreach ($factory[$i] as $key=>$value){
        if ($value != null) {
            echo "<td>$value</td>";
        }
    }

    echo "</tr>";
}
echo "</table>";


$arr = sortByStaffNumberInBranch(5,70,"Bakery",$factory);
echo "<h2>Таблиця всіх функції</h2>";
echo "Умови: <br> branch = Bakery <br> x = 5 <br> y = 70 <br>";
echo "<table border='1px'>";
echo "<tr> <th>Id</th> <th>Name</th> <th>Staff number</th> <th>Branch</th> <th>Address</th> </tr>";
for ($i = 0; $i < count($arr); $i++) {
    echo "<tr>";
    foreach ($arr[$i] as $key => $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>


<form method="get" action="">
    <p>Form</p>
    <input type="number" name="edit" placeholder="Type id for edit"> <br>
    <input type="number"  name="id" placeholder="Id"> <br>
    <input type="text"  name="name" placeholder="Name"> <br>
    <input type="number" name="staff" type="number" " placeholder="Staff number"> <br>
    <input type="text" name="branch"  placeholder="Branch"> <br>
    <input type="text" name="address" placeholder="Address">
    <input type="submit" name="btn-ok" value="ok">


    <input type="hidden" name="fourthPoint" value="">
</form>






