<?php 
//新增功能
setcookie("isbn", $_POST["Isbn"], time()+300);
setcookie("comp", $_POST["comp"], time()+300);
setcookie("book", $_POST["book"], time()+300);
setcookie("aut", $_POST["aut"], time()+300);
setcookie("price", $_POST["price"], time()+300);
setcookie("date", $_POST["date"], time()+300);



if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{1}$/', $_POST["Isbn"])){
    if(preg_match('/^(0|[1-9][0-9]*)$/', $_POST["price"])){
        if(preg_match("/^[0-9]{4}-(0([1-9]{1})|(1[0-2]))-(([0-2]([0-9]{1}))|(3[0|1]))$/", $_POST["date"])){

            //檢查是否有逗號或雙引號
            if(strpos($_POST["comp"],'"') !== false || strpos($_POST["book"],'"') !== false || strpos($_POST["aut"],'"') !== false || strpos($_POST["aut"],',') !== false || strpos($_POST["book"],',') !== false || strpos($_POST["comp"],',') !== false){ 
                header('Location: Add.php?sign=1&id=' . $num);
            }else{
                $txtarr = array();
                $n1 = 0;
                $filename = "Text.txt";
                $handle = fopen($filename, "r");

                while(!feof($handle)){
                    $str = fgets($handle);
                    $str = str_replace("\n", "", $str);
                    $txtarr[$n1] = $str;
                    $n1++;
                }
                
                $inputStr = $_POST["Isbn"] . "," . $_POST["comp"] . "," . $_POST["book"] . "," . $_POST["aut"] . "," . $_POST["price"] . "," . $_POST["date"];
                array_push($txtarr, $inputStr);

                //清除暫存cookie
                setcookie("isbn", "");
                setcookie("comp", "");
                setcookie("book", "");
                setcookie("aut", "");
                setcookie("price", "");
                setcookie("date", "");


                //將新增的資料寫入Text.txt中
                $file = fopen("Text.txt", "w+");
                $stt = "";
                if(!empty($txtarr[0][0])){
                    $stt = implode("\n", $txtarr);
                }else{
                    $stt = $inputStr;
                }
               
                echo $stt;
                fwrite($file, $stt);
                fclose($file);
                header('Location: index.php');
            }
        }else{
            header('Location: Add.php?date=1');
        }
    }else{
        header('Location: Add.php?price=1');
    }
}else{
    header('Location: Add.php?isbn=1');
}
?>