<?php 
$num = $_GET["id"];

$txtarr = array();
$n1 = 0;
$filename = "Text.txt";
$handle = fopen($filename, "r");

while(!feof($handle)){
    $str = fgets($handle);
    if($n1 != $num){
        $str = str_replace("\n", "", $str);
        array_push($txtarr, $str);
    }
    $n1++;
}

print_r($txtarr);

$file = fopen("Text.txt", "w+");
$stt = "";
if(!empty($txtarr)){
    $stt = implode("\n", $txtarr);
}


fwrite($file, $stt);
fclose($file);
if(isset($_GET["orders"])){
    $url = "index.php?order=" . $_GET["orders"] . "&sc=" . $_GET["sc"];
    header('Location: ' . $url);
}else{
    header("location: index.php");
}


?>