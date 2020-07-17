<?php 
setcookie("order", "", time()+300);
setcookie("sc", "", time()+300);

//若沒有上傳檔案
if(empty($_FILES["file"]["name"])){
    echo "<script>alert('匯入資料為空');
    location.href = 'index.php';
    </script>";
    exit;
}

//讀取上傳檔案
$inparr = array();
$n1 = 0;
$tmpname = "Input.txt";
move_uploaded_file($_FILES["file"]["tmp_name"], $tmpname);
$handle = fopen($tmpname, "r");
while(!feof($handle)){
    $inparr[$n1] = array();
    $str = fgets($handle);
    $str = str_replace("\n", "", $str);
    $inparr[$n1] = explode(",", $str);
    $n1++;
}
fclose($handle);

//判斷匯入資料

for($i = 0; $i < count($inparr); $i++){
    if(count($inparr[$i]) != 6 && count($inparr[$i]) != 1){ //判斷匯入資料格式
        echo "<script>alert('匯入資料格式錯誤');
        location.href = 'index.php';
        </script>";
        exit;
    }

    //判斷匯入檔案是否有雙引號
    if(isset($inparr[$i][1]) && isset($inparr[$i][2]) && isset($inparr[$i][3])){
        if(strpos($inparr[$i][1],'"') !== false || strpos($inparr[$i][2],'"') !== false || strpos($inparr[$i][3],'"') !== false){
            echo "<script>alert('匯入資料不可有雙引號');
                location.href = 'index.php';
                </script>";
                exit;
        }
    }else{
        if(empty($inparr[$i][0])){
            unset($inparr[$i]);
        break;
        }
        echo "<script>alert('匯入資料格式錯誤');
        location.href = 'index.php';
        </script>";
        exit;
    }

    for($j = 0; $j < count($inparr[$i]); $j++){//判斷資料有空白
        if(!isset($inparr[$i][$j])){
            echo "<script>alert('匯入資料有欄位空白');
            location.href = 'index.php';
            </script>";
            exit;
        }
    }

    if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{1}$/', $inparr[$i][0]) && $i != count($inparr) -1){ //判斷ISBN格式
        echo "<script>alert('匯入ISBN格式錯誤');
        location.href = 'index.php';
        </script>";
        exit;
    }else if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{1}$/', $inparr[$i][0]) && $i == count($inparr) -1 && count($inparr[$i]) == 1){
        unset($inparr[count($inparr)-1]);
    break;
    }


    if(isset($inparr[$i][4])){
        if(!preg_match('/^(0|[1-9][0-9]*)$/', $inparr[$i][4])){ //判斷定價格式
            echo "<script>alert('匯入定價格式錯誤');
            location.href = 'index.php';
            </script>";
           
            exit;
        }
    }else{
        echo "<script>alert('匯入定價格式錯誤');
            //location.href = 'index.php';
            </script>";
           
            exit;
    }

    if(!preg_match("/^[0-9]{4}-(0([1-9]{1})|(1[0-2]))-(([0-2]([0-9]{1}))|(3[0|1]))$/", $inparr[$i][5])){ //判斷發行日格式
        echo "<script>alert('匯入發行日格式錯誤');
        location.href = 'index.php';
        </script>";
        
        exit;
    }

}

//讀取原有記事本資料
$txtarr = array();
$n2 = 0;
$filename = "Text.txt";
$handle2 = fopen($filename, "r");
while(!feof($handle2)){
    $str2 = fgets($handle2);
    $str2 = str_replace("\n","",$str2);
    $txtarr[$n2] = $str2;
    $n2++;
}

$file = fopen("Text.txt", "w+");
$stt = "";
if(empty($txtarr[0][0])){
    for($nn = 0; $nn < count($inparr); $nn++){
        if($nn == (count($inparr)-1)){//資料最後一行 不加入換行符號
            $stt = $stt . $inparr[$nn][0] . "," . $inparr[$nn][1] . "," . $inparr[$nn][2] . "," . $inparr[$nn][3] . "," . $inparr[$nn][4] . "," . $inparr[$nn][5];
        }else{
            $stt = $stt . $inparr[$nn][0] . "," . $inparr[$nn][1] . "," . $inparr[$nn][2] . "," . $inparr[$nn][3] . "," . $inparr[$nn][4] . "," . $inparr[$nn][5] . "\n";
        }
    }
}else{
    for($k = 0; $k < count($inparr); $k++){
        $inp = $inparr[$k][0] . "," . $inparr[$k][1] . "," . $inparr[$k][2] . "," . $inparr[$k][3] . "," . $inparr[$k][4] . "," . $inparr[$k][5];
        array_push($txtarr, $inp);
    }
    $stt = implode("\n", $txtarr);
}

fwrite($file, $stt);
fclose($file);
header("location: index.php");

?>