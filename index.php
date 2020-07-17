<html>
<?php 
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
    



 //清除暫存cookie
 setcookie("isbn", "");
 setcookie("comp", "");
 setcookie("book", "");
 setcookie("aut", "");
 setcookie("price", "");
 setcookie("date", "");

?>

<?php 
//排序
    //給予排序陣列ID
    for($xx = 0; $xx < count($txtarr); $xx++){
        array_push($txtarr[$xx], $xx);
    }
if(isset($_GET["order"]) && isset($_GET["sc"]) && !empty($txtarr[0][0])){
    
    $sc = $_GET["sc"]; //升序 降序

    if($_GET["order"] == '0'){ //出版社排序      
        if($sc == '0'){
            usort($txtarr, "comSortAsc");
        }else{
            usort($txtarr, "comSortDesc");
        }
    
    }

    if($_GET["order"] == '1'){ //書名排序      
        if($sc == '0'){
            usort($txtarr, "bookSortAsc");
        }else{
            usort($txtarr, "bookSortDesc");
        }
    
    }

    if($_GET["order"] == '2'){ //作者排序      
        if($sc == '0'){
            usort($txtarr, "autSortAsc");
        }else{
            usort($txtarr, "autSortDesc");
        }
    
    }



    if($_GET["order"] == '3'){ //價格排序
        
        if($sc == '0'){
            usort($txtarr, "priceSortAsc");
        }else{
            usort($txtarr, "priceSortDesc");
        }
    }


    if($_GET["order"] == '4'){ //日期排序
        
        if($sc == '0'){
            usort($txtarr, "dateSortAsc");
        }else{
            usort($txtarr, "dateSortDesc");
        }
    }

    setcookie("order", $_GET["order"], time()+300);
    setcookie("sc", $_GET["sc"], time()+300);
    $_GET["orders"] = 1;
}

function comSortAsc($a, $b){//出版社升序
    $aa = iconv('UTF-8', 'GBK', $a[1]);  
    $bb = iconv('UTF-8', 'GBK', $b[1]);
   
    if($aa == $bb){
        return 0;
    }else if($aa > $bb){
        return -1;
    }else{
        return 1;
    }
}

function comSortDesc($a, $b){//出版社降序
    $aa = iconv('UTF-8', 'GBK', $a[1]);  //轉換成中文代碼
    $bb = iconv('UTF-8', 'GBK', $b[1]);
   
    if($aa == $bb){
        return 0;
    }else if($aa > $bb){
        return 1;
    }else{
        return -1;
    }
    
}


function bookSortAsc($a, $b){//書名升序
    $aa = iconv('UTF-8', 'GBK', $a[2]);  
    $bb = iconv('UTF-8', 'GBK', $b[2]);
   
    if($aa == $bb){
        return 0;
    }else if($aa > $bb){
        return -1;
    }else{
        return 1;
    }
}

function bookSortDesc($a, $b){//書名降序
    $aa = iconv('UTF-8', 'GBK', $a[2]);  //轉換成中文代碼
    $bb = iconv('UTF-8', 'GBK', $b[2]);
   
    if($aa == $bb){
        return 0;
    }else if($aa > $bb){
        return 1;
    }else{
        return -1;
    }
    
}


function autSortAsc($a, $b){//作者升序
    $aa = iconv('UTF-8', 'GBK', $a[3]);  
    $bb = iconv('UTF-8', 'GBK', $b[3]);
   
    if($aa == $bb){
        return 0;
    }else if($aa > $bb){
        return -1;
    }else{
        return 1;
    }
}

function autSortDesc($a, $b){//作者降序
    $aa = iconv('UTF-8', 'GBK', $a[3]);  //轉換成中文代碼
    $bb = iconv('UTF-8', 'GBK', $b[3]);
   
    if($aa == $bb){
        return 0;
    }else if($aa > $bb){
        return 1;
    }else{
        return -1;
    }
    
}



function priceSortAsc($a, $b){//價格升序
    return $a[4] - $b[4];
}

function priceSortDesc($a, $b){//價格降序
    return -($a[4] - $b[4]);
}


function dateSortAsc($a, $b){//日期升序
    return strtotime($a[5]) - strtotime($b[5]);
}
function dateSortDesc($a, $b){//日期降序
    return -(strtotime($a[5]) - strtotime($b[5]));
}

?>


<head>
    <title>Index Page</title>
    <script>
//取得排序cookie
   <?php if(isset($_COOKIE["order"]) && isset($_COOKIE["sc"])){ ?>
    window.onload=function(){
        <?php if(isset($_POST["order"]) && isset($_POST["order"])){ ?>

        <?php } ?>
        var order = <?php echo $_GET["order"] ?>;
        var sc = <?php echo $_GET["sc"] ?>;
        var obj = document.getElementById("order");
        var obj2 = document.getElementById("sc");
        var opts=obj.getElementsByTagName("option");
        var opts2=obj2.getElementsByTagName("option");

        opts[order].selected = true;
        opts2[sc].selected = true;
    }
<?php } ?>
</script>
</head>

<body>
<form action="Upload3.php" method="POST" enctype="multipart/form-data">
    匯入資料：<input type="file" name="file" accept=".txt" />
    <input type="submit" name="submit" value="上傳檔案" />
    </form>
    
    資料匯出: <input type="button" value="匯出" onclick="javascript:location.href='output.php'" />
    <p nowrap style="text-align:right;">
    <form action="index.php?orders=1" method="GET" style="text-align:right;">
        排序
        <select name="order" id="order">
            <option value="0">出版社</option>
            <option value="1">書名</option>
            <option value="2">作者</option>
            <option value="3">定價</option>
            <option value="4">發行日</option>
        </select>
        方向
        <select name="sc" id="sc">
            <option value="0">ASC</option>
            <option value="1">DESC</option>
        </select>
        <?php
        if(isset($_GET["orders"])){
            $orders = 1;
        }else{$orders = 0;}
        ?>
        <input type="submit" value="排序" />
    </form>
    </p>


    <table width="100%" border="1">
         <tr>
            <th width="20%">ISBN</th>
            <th width="15%">出版社</th>
            <th width="20%">書名</th>
            <th width="15%">作者</th>
            <th width="10%">定價</th>
            <th width="10%">發行日</th>
            <th width="10%">編輯/刪除</th>
        </tr>

        <?php for($i = 0; $i < count($txtarr); $i++){ 
                if(!empty($txtarr[0][0])){
            ?>
        <tr>
            <?php for($j = 0; $j < 6; $j++){ ?>
                <td><?php echo $txtarr[$i][$j] ?></td>
            <?php } ?>
            <?php
            if(isset($_GET["order"]) && isset($_GET["sc"])){
                $urlEdit = "Edit.php?id=" . $txtarr[$i][6] . "&orders=" . $_GET["order"] . "&sc=" . $_GET["sc"];
                $urlDel = "Delete2.php?id=" . $txtarr[$i][6] . "&orders=" . $_GET["order"] . "&sc=" . $_GET["sc"];
            }else{
                $urlEdit = "Edit.php?id=" . $txtarr[$i][6];
                $urlDel = "Delete2.php?id=" . $txtarr[$i][6];
            }
           
            ?>
            <td>
            <input type ="button" onclick="javascript:location.href='<?php echo $urlEdit ?>'" value="EDIT"></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type ="button" onclick="javascript:location.href='<?php echo $urlDel ?>'" value="DEL"></input>
            </td>
        </tr>
        <?php }} ?>
    </table>


    <p style="text-align:center;">
    <input type ="button" onclick="javascript:location.href='Add.php'" value="Add"></input>
    </p>
</body>


</html>