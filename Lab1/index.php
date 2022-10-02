<?php
session_start();
$_SESSION["factory"] = null;


$fourthPoint = $_GET[fourthPoint];
if(isset($_SESSION["factory"])) {
    $factory = $_SESSION["factory"];
}else {
    $factory = [
        [
            "id" => 1,
            "name" => "Jabil",
            "staffNumber" => 100,
            "branch" => "ChinaProducts",
            "address" => "Uzhhorod"
        ],
        [
            "id" => 2,
            "name" => "Dik",
            "staffNumber" => 50,
            "branch" => "Bakery",
            "address" => "Uzhhorod"
        ],
        [
            "id" => 3,
            "name" => "PolonunskiyHlib",
            "staffNumber" => 80,
            "branch" => "Bakery",
            "address" => "Uzhhorod"
        ],
        [
            "id" => 4,
            "name" => "Olivye",
            "staffNumber" => 20,
            "branch" => "Restaurant",
            "address" => "Uzhhorod"
        ],
        [
            "id" => 5,
            "name" => "Dastor",
            "staffNumber" => 300,
            "branch" => "Market",
            "address" => "Uzhhorod"
        ]
    ];
}
function getId($factory){
    for($i = 0; $i < count($factory); $i++){
        if($_GET["id"] == $factory[$i]["id"]){
            $max = $factory[0]["id"];
           for($j = 0; $j < count($factory); $j++){
               if($factory[$j]["id"] > $max){
                   $max = $factory[$j]["id"];
               }
           }
           $max++;
           return $max;
        }
        }
        return $_GET["id"];
}


if($_GET["edit"] != null){
    for($i = 0; $i < count($factory); $i++){
        if($_GET["edit"] == $factory[$i]["id"]){
            $factory[$i] = ["id" => getId($factory),
                "name" => $_GET["name"],
                "staffNumber" => $_GET["staff"],
                "branch" => $_GET["branch"],
                "address" => $_GET["address"]];
            $_SESSION["factory"] = $factory;
            break;
        }
    }

}
else{
    if($_GET["id"] == null){
        $_GET["id"] = 1;
    }
    if($_GET["name"] == null){
        $_GET["name"] = "Shop";
    }
    if($_GET["staff"] == null){
        $_GET["staff"] = 100;
    }
    if($_GET["branch"] == null){
        $_GET["branch"] = "Shop";
    }
    if($_GET["address"] == null){
        $_GET["address"] = "Uzhhorod";
    }

    $factory[] = ["id" => getId($factory),
        "name" => $_GET["name"],
        "staffNumber" => $_GET["staff"],
        "branch" => $_GET["branch"],
        "address" => $_GET["address"]];
    $_SESSION["factory"] = $factory;
}

function sortByStaffNumberInBranch(int $x, int $y, string $branch, $arr){
    $newArr = [];
    for($i = 0; $i < count($arr); $i++){
        if($branch == $arr[$i]["branch"] && $arr[$i]["staffNumber"] >= $x && $arr[$i]["staffNumber"] <= $y){
                array_push($newArr, $arr[$i]);

        }
    }
    return $newArr;
}



echo "<h2>Таблиця всіх значень</h2>";
echo "<table border='1px'>";
echo "<tr> <th>Id</th> <th>Name</th> <th>Staff number</th> <th>Branch</th> <th>Address</th> </tr>";
for($i = 0; $i < count($factory); $i++){
    echo "<tr>";
    foreach ($factory[$i] as $key=>$value){
        if($value != null){
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






