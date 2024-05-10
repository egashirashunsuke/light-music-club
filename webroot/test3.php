<html>
    <head>
        <title>
        予約確認
        </title>
        <link href="test.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <nav>
          <ol class="breadcrumb">
            <li><a href="http://ashitabokoma.starfree.jp/">ホーム</a></li>
            <li><a href="http://localhost:80/test.php">あしたぼコマ表</a></li>
            <li>音楽室予約</a></li>
            <li>音楽室予約完了</li>
          </ol>
        </nav>
        
        <?php
        //値の受け取り
        $day_data = $_POST['day_data'];
        $band_name = $_POST['band_name'];
        $name = $_POST['seki_name'];
        $num = $_POST['num'];
        $password = $_POST['password'];
        
        $file_name = "$day_data".".csv";
        
        //すでに登録されているかの確認
        $handle = fopen("day_data/".$file_name, "r");
        $temp = fgetcsv($handle);
        $temp2 = fgetcsv($handle);
        $temp3 = fgetcsv($handle);
        fclose($handle);
        $flag = 0;
        
        
        if($temp[$num] != '0'){
            //登録されていたら拒否
            echo "<p style='text-align:center'>予約に失敗しました</p>";
            echo "<p style='text-align:center'>すでに誰かが登録しています</p>";
            $band_name = $temp[$num];
            $name = $temp2[$num];
            $password = $temp3[$num];
            $img_flag = 1;
        }else if($band_name=='' or $name=='' or $password==''){
            echo "<p style='text-align:center'>予約に失敗しました</p>";
            echo "<p style='text-align:center'>必ず３つすべての値を入力してください</p>";
            $band_name = 0;
            $name = 0;
            $password = 0;
            $img_flag = 1;
        }else if( preg_match('/^\s*$/u', $band_name) or preg_match('/^\s*$/u', $name) or preg_match('/^\s*$/u', $password)){
            echo "<p style='text-align:center'>不正な入力を検出しました</p>";
            echo "<p style='text-align:center'>空白(スペース)のみの入力は受け付けておりません</p>";
            $band_name = $temp[$num];
            $name = $temp2[$num];
            $password = $temp3[$num];
            $img_flag = 1;
        }else{
            $img_flag = 0;
            $flag = 1;
            echo "<p style='text-align:center'>予約を受け付けました</p>";
            echo "<p style='text-align:center'>ありがとうございました</p>";
        }
        
        
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
        
        for($i=0; $i<8; $i++){
            if($i == $num){
                $new_data[] = $band_name;
                $new_data2[] = $name;
                $new_data3[] = $password;
            }else{
                $new_data[] = $data[$i];
                $new_data2[] = $data2[$i];
                $new_data3[] = $data3[$i];
            }
        }
        
        $list = array($new_data, $new_data2, $new_data3);

        //ファイルの書き出し
        $fp = fopen("day_data/".$file_name, 'w');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        
        //予約ログの書き出し
        //ファイルの書き出し
        if($flag == 1){
            $fp = fopen("log.csv", 'a');
            $hoge = array($day_data, $num, $band_name, $name);
            fputcsv($fp, $hoge);
            fclose($fp);
        }
        
        
        ?>
        
        <p style="text-align:center">
        <button onclick="location.href='http://localhost/test.php'">コマ表に戻る</button>
        </p>
        
        <p style="text-align:center">
        <?php
            $img_num =mt_rand(1, 65536);
            if($img_num == 1){
                echo "<img src='kanta_furo.jpg'>";
            }else if( 1 < $img_num  &&  $img_num < 656){
                echo "<img src='siba.jpg'>";
            }else if( 656 < $img_num  &&  $img_num < 1966){
                echo "<img src='s-41135.jpg'>";
            }else{
                echo "<img src='s-cyai2.jpg'>";
            }
         ?>
        </p>
    </body>
</html>