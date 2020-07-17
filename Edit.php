<?php 
session_start();
$num = $_GET["id"];
//讀取檔案
$txtarr = array();
$n1 = 0;
$filename = "Text.txt";

$handle = fopen($filename, "r");
while(!feof($handle)){
    $str = fgets($handle);
    if($n1 == $num){
        $str = str_replace("\n","",$str); //不要讀入換行符號
        $txtarr = explode(",", $str);
    }
    $n1++;
}
?>
<html>
<!-- 更新修改頁面 -->
    <head>
        <title>Edit Page</title>
    </head>

    <body>
    <form action="Update2.php" method="POST" style="text-align:center;">
            <table border="1" align="center">
            
                <tr>
                    <td>ISBN</td>
                    <td><input type="text" name="Isbn" maxLength="13" required="required" value="<?php echo $txtarr[0]; ?>" /></td>
                </tr>
                <tr>
                    <td>出版社</td>
                    <td><input type="text" name="comp" maxLength="20" required="required" value="<?php echo $txtarr[1]; ?>" /></td>
                </tr>
                <tr>
                    <td>書名</td>
                    <td><input type="text" name="book" maxLength="20" required="required" value="<?php echo $txtarr[2]; ?>" /></td>
                </tr>
                <tr>
                    <td>作者</td>
                    <td><input type="text" name="aut" maxLength="20" required="required" value="<?php echo $txtarr[3]; ?>" /></td>
                </tr>
                <tr>
                    <td>定價</td>
                    <td><input type="text" name="price" maxLength="20" required="required" value="<?php echo $txtarr[4]; ?>" /></td>
                </tr>
                <tr>
                    <td>發行日</td>
                    <td><input type="text" name="date" maxLength="10" required="required" value="<?php echo $txtarr[5]; ?>" /></td>
                </tr>
                <?php
                if(isset($_GET["orders"])){
                ?>
                    <input type="hidden" name="orders" value="<?php echo $_GET["orders"];?>" />
                    <input type="hidden" name="sc" value="<?php echo $_GET["sc"];?>" />
                <?php } ?>
           
            </table>
            <input type="hidden" name="id" value="<?php echo $num; ?>" />
            <input type="submit" value="Edit" />
        </form>
        <p style="text-align:center;">
        <input type ="button" onclick="javascript:location.href='index.php'" value="Home"></input>
        </p>
    </body>

    <script>
        var getUrlString = location.href; //取得get參數
        var url = new URL(getUrlString);
        var isbn = url.searchParams.get('isbn');
        var price = url.searchParams.get('price');
        var date = url.searchParams.get('date');
        var sign = url.searchParams.get('sign');
        if(isbn == '1'){
            alert('ISBN格式輸入錯誤');
        }else if(price == '1'){
            alert('價格格式輸入錯誤');
        }else if(date == '1'){
            alert('發行日格式輸入錯誤');
        }else if(sign == '1'){
            alert('不可輸入雙引號或逗號');
        }
    </script>
</html>