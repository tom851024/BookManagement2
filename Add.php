<html>
<!-- 新增資料頁面 -->
    <head>
        <title>Add Page</title>
    </head>

    <body>
        <form action="Insert2.php" method="POST" style="text-align:center;">
            <table border="1" align="center">
                <tr>
                    <td>ISBN</td>
                    <td><input type="text" name="Isbn" maxLength="13" required="required"  value="<?php if(isset($_COOKIE["isbn"])){echo $_COOKIE["isbn"];} ?>" /></td>
                </tr>
                <tr>
                    <td>出版社</td>
                    <td><input type="text" name="comp" maxLength="20" required="required" value="<?php if(isset($_COOKIE["comp"])){echo $_COOKIE["comp"];} ?>" /></td>
                </tr>
                <tr>
                    <td>書名</td>
                    <td><input type="text" name="book" maxLength="20" required="required" value="<?php if(isset($_COOKIE["book"])){echo $_COOKIE["book"];} ?>" /></td>
                </tr>
                <tr>
                    <td>作者</td>
                    <td><input type="text" name="aut" maxLength="20" required="required" value="<?php if(isset($_COOKIE["aut"])){echo $_COOKIE["aut"];} ?>" /></td>
                </tr>
                <tr>
                    <td>定價</td>
                    <td><input type="text" name="price" maxLength="20" required="required" value="<?php if(isset($_COOKIE["price"])){echo $_COOKIE["price"];} ?>" /></td>
                </tr>
                <tr>
                    <td>發行日</td>
                    <td><input type="text" name="date" maxLength="10" required="required" value="<?php if(isset($_COOKIE["date"])){echo $_COOKIE["date"];} ?>" /></td>
                </tr>
            </table>

            <input type="submit" value="Add" />
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