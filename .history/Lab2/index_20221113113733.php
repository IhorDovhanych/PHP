<?php

function getSimpleData():array {
    $lines = file('./arrayData.txt', FILE_SKIP_EMPTY_LINES);
    $dict = [];
    foreach ($lines as $line){
        $lineArr = explode(' ', $line);

        $dict[] = [
            'id' => (int)$lineArr[0],
            'name' => $lineArr[1],
            'employees_count' => (int)$lineArr[2],
            'branch' => $lineArr[3],
            'address' => $lineArr[4]
        ];

    }
    return $dict;
}
function saveDataInFile($data,$factories, $id){
    $dataStr = getUniqueId($factories, $id).' '.$data['name'].' '.$data['employees_count'].' '.$data['branch'].' '.$data['address']."\n";
    file_put_contents('./arrayData.txt', "$dataStr", FILE_APPEND);
}
function saveDataInFileAfterSave($data,$factories,$id,$edit){
    $dataStr = '';
    for ($i = 0; $i < count($factories); $i++){

        if($factories[$i]['id'] == $edit){
            $factories[$i] = fullFillFactoryData($factories, $data);
            var_dump($factories[$i]);
            $dataStr .= $factories[$i]['id'].' '.$factories[$i]['name'].' '.$factories[$i]['employees_count'].' '.$factories[$i]['branch'].' '.$factories[$i]['address']."\n";
        }
        else{
        $dataStr .= $factories[$i]['id'].' '.$factories[$i]['title'].' '.$factories[$i]['employees_count'].' '.$factories[$i]['branch'].' '.$factories[$i]['address'];
    }}
    file_put_contents('./arrayData.txt', "$dataStr");
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

function sortByemployees_countInBranch(int $x, int $y, string $branch, $arr) {
    $newArr = [];
    for ($i = 0; $i < count($arr); $i++) {
        if ($branch == $arr[$i]["branch"] && $arr[$i]["employees_count"] >= $x && $arr[$i]["employees_count"] <= $y) {
            array_push($newArr, $arr[$i]);
        }
    }
    return $newArr;
}

function fullFillFactoryData($factories, $data):array {
    return [
        "id" => getUniqueId($factories, $data['id']),
        "title" => $data["title"],
        "employees_count" => $data["employees_count"],
        "branch" => $data["branch"],
        "address" => $data["address"]
    ];
}

function validateFactoryData($data,$factory):bool {
    if (empty($data["id"])
        || empty($data["title"])
        || empty($data["employees_count"])
        || empty($data["branch"])
        || empty($data["address"])) {
        return false;
    }
    if (
        $data['title'] == $factory['title'] &&
        $data['employees_count'] == (string)$factory['employees_count'] &&
        $data['branch'] == $factory['branch'] &&
        $data['address'] == $factory['address']){

        return false;
    }

    return true;
}




$_SESSION['factory'] = null;
// ^^^^^ uncomment for update list with new arrayData.txt data
$fourthPoint = $_GET['fourthPoint'];
if (isset($_SESSION['factory'])) {
    $factory = $_SESSION['factory'];
} else {
    $factory = getSimpleData();
}


if (!empty($_GET["edit"])) {
    if (validateFactoryData($_GET,end($factory))) {
        for ($i = 0; $i < count($factory); $i++) {
            if ($_GET["edit"] == $factory[$i]["id"]) {
                saveDataInFileAfterSave($_GET,$factory,$_GET['id'],$_GET['edit']);
                $factory[$i] = fullFillFactoryData($factory, $_GET);
                break;
            }
        }
    } else {
        //TODO: Error handling
    }
} elseif (array_key_exists('id', $_GET)) {
    if (validateFactoryData($_GET,end($factory))) {
        saveDataInFile($_GET,$factory,$_GET['id']);
        $factory[] = fullFillFactoryData($factory, $_GET);
    } else {
        //TODO: Error handling
    }
}

$_SESSION["factory"] = $factory;

echo "<table border='1px'>";
echo "<tr> <th>Id</th> <th>Title</th> <th>Employees count</th> <th>Branch</th> <th>Address</th> </tr>";
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


$arr = sortByemployees_countInBranch(150,300,"chemistry",$factory);
echo "Умови: <br> branch = chemistry <br> x = 150 <br> y = 300 <br>";
echo "<table border='1px'>";
echo "<tr> <th>Id</th> <th>Title</th> <th>Employees count</th> <th>Branch</th> <th>Address</th> </tr>";
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
    <input type="text"  name="title" placeholder="Name"> <br>
    <input type="number" name="employees_count" type="number" placeholder="Employees count"> <br>
    <input type="text" name="branch"  placeholder="Branch"> <br>
    <input type="text" name="address" placeholder="Address">
    <input type="submit" name="btn-ok" value="ok">


    <input type="hidden" name="fourthPoint" value="">
</form>






