<html>
    <head>
        <title>
        予約ログ
        </title>
        <link href="test.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav>
          <ol class="breadcrumb">
            <li><a href="http://ashitabokoma.starfree.jp/">ホーム</a></li>
            <li><a href="http://localhost:80/test.php">あしたぼコマ表</a></li>
            <li>予約ログ</li>
          </ol>
        </nav>
        <!--<p style="text-align:left">
        <button onclick="location.href='http://localhost:80/test.php'">カレンダーに戻る</button>
        </p>-->
        
        
        <?php
            
        $row = 1;
        $handle = fopen("log.csv", "r");
        // 1行ずつfgetcsv()関数を使って読み込む
        while ($data = fgetcsv($handle)){
            foreach ($data as $value) {
            echo $value." ,";
            }
            echo "<br>";
        }
        
        fclose($handle);
        ?>
    
    </body>
</html>