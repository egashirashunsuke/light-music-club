<html>
    <head>
        <title>
        予約取り消し入力
        </title>
        <link href="test.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        
        <nav>
          <ol class="breadcrumb">
            <li><a href="http://ashitabokoma.starfree.jp/">ホーム</a></li>
            <li><a href="http://localhost:80/test.php">あしたぼコマ表</a></li>
            <li>音楽室予約の取り消し</li>
          </ol>
        </nav>
        
        <p style="text-align:center">
            <?php
            //ファイル名
            $day_data = $_REQUEST['daydata'];
            //時間割
            $time = $_REQUEST['num'];
            $hiduke = $_REQUEST['hiduke'];
            $yobi = $_REQUEST['yobi'];
            $band_name = $_REQUEST['band_name'];
        
            //時間枠
            //$time_sheet = array("09:00~10:30", "10:30~12:00", "12:00~13:30", "13:30~15:00", "15:00~16:30", "16:30~18:00", "18:00~19:30", "19:30~21:00");
            //コロナ用臨時タイムシート
            $time_sheet = array("09:00~10:00", "10:15~11:15", "11:30~12:30", "13:00~14:00", "14:15~15:15", "15:30~15:30", "16:45~17:45", "18:00~19:00");
        
            echo $hiduke."(".$yobi.")";
            
            ?>
        </p>
        <p style="text-align:center">
            <?php
            echo $time_sheet[$time];
            ?>
        </p>
        <p style="text-align:center">にはすでに</p>
        
        <p style="text-align:center">
            <?php
            
            echo "「".$band_name."」";
            ?>
        </p>
        
        <p style="text-align:center">が登録されています</p>
        
        
        <p style="text-align:center"><button onclick="location.href='http://localhost/test.php'">コマ表に戻る</button></p>
        
        
        <br>
        <br>
        
        <p style="text-align:center">削除するには管理パスワードを入力してください</p>
        
        
        <form action="test3-2.php" method="post">
            <p style="text-align:center">管理パスワード</p>
            <p style="text-align:center"><input type="text" name="password" align='center'></p>

            
            <?php
            //ファイル名
            $day_data = $_REQUEST['daydata'];
            //時間割
            $time = $_REQUEST['num'];
            
            echo "<input type='hidden' name='day_data' value='".$day_data."'>";
            echo "<input type='hidden' name='num' value='".$time."'>"
            ?>
            
            <p style="text-align:center"><input type="submit" value="削除" align='center'></p> 
        </form>
        
    </body>
</html>