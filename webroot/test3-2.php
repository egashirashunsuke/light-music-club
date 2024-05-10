<html>
    <head>
        <title>
        予約取り消し確認
        </title>
        <link href="test.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <nav>
          <ol class="breadcrumb">
            <li><a href="http://ashitabokoma.starfree.jp/">ホーム</a></li>
            <li><a href="http://localhost:80/test.php">あしたぼコマ表</a></li>
            <li>音楽室予約取り消し</a></li>
            <li>音楽室予約取り消し完了</li>
          </ol>
        </nav>
        
        <?php
        //値の受け取り
        $day_data = $_POST['day_data'];
        $num = $_POST['num'];
        $password = $_POST['password'];
        
        
        $file_name = "$day_data".".csv";
        
        //日付ファイルの情報読み出し
        $handle = fopen("day_data/".$file_name, "r");
        //バンド名
        $data = fgetcsv($handle);
        //責任者
        $data2 = fgetcsv($handle);
        //パスワード
        $data3 = fgetcsv($handle);
        fclose($handle);
        
        //新しい配列の作成
        $new_data = [];
        $new_data2 = [];
        $new_data3 = [];
        
        //パスワードが合っていたとき
        if ($password == $data3[$num]){
            for($i=0; $i<8; $i++){
            //当該ナンバーを削除
                if($i == $num){
                    $new_data[] = 0;
                    $new_data2[] = 0;
                    $new_data3[] = 0;
                }else{
                    $new_data[] = $data[$i];
                    $new_data2[] = $data2[$i];
                    $new_data3[] = $data3[$i];
                }
            }
            echo "<p style='text-align:center'>削除に成功しました</p>";
        }else{
            //値はそのまま
            $new_data = $data;
            $new_data2 = $data2;
            $new_data3 = $data3;
            echo "<p style='text-align:center'>パスワードが間違っています　最初からやり直してください</p>";
        }
        
        
        
        $list = array($new_data, $new_data2, $new_data3);

        //ファイルの書き出し
        $fp = fopen("day_data/".$file_name, 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        ?>
        <p style="text-align:center">
        <button onclick="location.href='http://localhost/test.php'">コマ表に戻る</button>
        </p>
        <p style="text-align:center">
        <img src="s-cyai2.jpg">    
        </p>
    </body>
</html>