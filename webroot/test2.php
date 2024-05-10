<html>
    <head>
        <title>
        予約入力
        </title>
        <link href="test.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        
        <nav>
          <ol class="breadcrumb">
            <li><a href="http://ashitabokoma.starfree.jp/">ホーム</a></li>
            <li><a href="http://localhost:80/test.php">あしたぼコマ表</a></li>
            <li>音楽室予約</li>
          </ol>
        </nav>
        
        <p style="text-align:center">現在</p>
        
        
        <p style="text-align:center">
            <?php
            //ファイル名
            $day_data = $_REQUEST['daydata'];
            //時間割
            $syuku_flag = $_REQUEST['syuku_flag'];
            $time = $_REQUEST['num'];
            $hiduke = $_REQUEST['hiduke'];
            $yobi = $_REQUEST['yobi'];
        
            
            //時間枠
            $time_sheet = array("09:00~10:30", "10:30~12:00", "12:00~13:30", "13:30~15:00", "15:00~16:30", "16:30~18:00", "18:00~19:30", "19:30~21:00");
            //コロナ用臨時タイムシート
            //$time_sheet = array("09:00~10:00", "10:15~11:15", "11:30~12:30", "13:00~14:00", "14:15~15:15", "15:30~15:30", "16:45~17:45", "18:00~19:00");
        
            echo $hiduke."(".$yobi.")";
            
            ?>
        </p>
        <p style="text-align:center">
            <?php
            echo $time_sheet[$time];
            ?>
        </p>
        <p style="text-align:center">が選択されています</p>

<!--htmlのタグを使って色を変えて中央揃えにしている。htmlの慣習が分からないからとりあえずこれで-->
        <div style="text-align:center">
        <font color="blue">
        <?php
        if ($yobi == '水' && $time >4){
            echo 'この時間は特別な許可が必要です';
            echo "<br/>";
        }
        ?>
        </font>
        </div>
        
        <div style="text-align:center">
        <font color="red">
        <?php
        if ($yobi === '土' || $yobi === '日' || $syuku_flag==true){  //休日のコマの場合
            echo '三日前までに学務への予約と休日利用の申請を行ってください';
        }else{  //平日のコマの場合
            if ($time < 5){//15:30までのコマの場合
                echo '三日前までに学務への予約をしてください';
            }
        }
        ?>
        </font>
        </div>
        
        <p style="text-align:center"><button onclick="location.href='http://localhost/test.php'">コマ表に戻る</button></p>
        
        <br>
        <br>
        <p style="text-align:center">新規予約</p>
        
        <form action="test3.php" method="post">
            <p style="text-align:center">バンド名</p>
            <p style="text-align:center"><input type="text" name="band_name" align='center'></p>
            <p style="text-align:center">責任者</p>
            <p style="text-align:center"><input type="text" name="seki_name" align='center'></p>
            <p style="text-align:center">管理パスワード</p>
            <p style="text-align:center"><input type="text" name="password" align='center'></p>
            
            <?php
            echo "<input type='hidden' name='day_data' value='".$day_data."'>";
            echo "<input type='hidden' name='num' value='".$time."'>"
            ?>
            
            <p style="text-align:center"><input type="submit" value="確認" align='center'></p> 
        </form>
        
    </body>
</html>