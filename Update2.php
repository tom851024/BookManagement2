<?php 
$num = $_POST["id"];
if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{1}$/', $_POST["Isbn"])){
    if(preg_match('/^(0|[1-9][0-9]*)$/', $_POST["price"])){
        if(preg_match("/^[0-9]{4}-(0([1-9]{1})|(1[0-2]))-(([0-2]([0-9]{1}))|(3[0|1]))$/", $_POST["date"])){
            if(strpos($_POST["comp"],'"') !== false || strpos($_POST["book"],'"') !== false || strpos($_POST["aut"],'"') !== false || strpos($_POST["aut"],',') !== false || strpos($_POST["book"],',') !== false || strpos($_POST["comp"],',') !== false){ 
                header('Location: Edit.php?sign=1&id=' . $num);
            }else{
                //讀取檔案
                $txtarr = array();
                $n1 = 0;
                $filename = "Text.txt";
                $handle = fopen($filename, "r");
                while(!feof($handle)){
                    $str = fgets($handle);
                    $str = str_replace("\n","",$str); //不要讀入換行符號
                    $txtarr[$n1] = $str;
                    $n1++;
                }

                
                $inp = $_POST["Isbn"] . "," . $_POST["comp"] . "," . $_POST["book"] . "," . $_POST["aut"] . "," . $_POST["price"] . "," . $_POST["date"];
                $txtarr[$num] = $inp;
            
                    
                //將修改的資料寫入txt檔案中
                $file = fopen("Text.txt", "w+");
                $stt = "";
                
                $stt = implode("\n", $txtarr);
                
                fwrite($file, $stt);
                fclose($file);

                if(isset($_POST["orders"])){
                    $url = "index.php?order=" . $_POST["orders"] . "&sc=" . $_POST["sc"];
                    header('Location: ' . $url);
                }else{
                    header('Location: index.php');
                }

            }
        }else{
            header('Location: Edit.php?date=1&id=' . $num);
        }
    }else{
        header('Location: Edit.php?price=1&id=' . $num);
    }
}else{
    header('Location: Edit.php?isbn=1&id=' . $num);
}

?>