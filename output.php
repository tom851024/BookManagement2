<?php
session_start();
$boo = true; 

$txtarr = array();
$n1 = 0;
$filename = "Text.txt";

    $handle = fopen($filename, "r");
    while(!feof($handle)){
        $txtarr[$n1] = array();
        $str = fgets($handle);
        $str = str_replace("\n","",$str); //不要讀入換行符號
        $txtarr[$n1] = explode(",", $str);
        $n1++;
    }

if(!empty($txtarr[0][1])){
    $filename = "Text.txt";
   
    header("Content-Type: application/force-download"); //下載輸出檔案
    header("Content-Disposition: attachment; filename=".$filename); 
    readfile($filename);
    
    exit; //不加此exit會造成下載文件中有html標籤

}else{
    $boo = false;
}

?>
<html>
<body>
    <?php if(!$boo){ ?>
        無檔案可匯出!
        <input type ="button" onclick="javascript:location.href='index.php'" value="Home"></input>
    <?php }else{ ?>

    <?php } ?>
</body>
<html>