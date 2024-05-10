<!&#8211;拙い知識で作ったやつなので、可読性めっちゃ低くて申し訳ないけど頑張ってね！！！　変態糞学生->
<!--xamppでローカルサーバーを立ててトライアンドエラー-->
<html>
    <head>
       <title>
        あしたぼコマ表
        </title>
        <link href="test.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <!--参考サイトhttps://rilaks.jp/blog/breadcrumb-design/-->
        <!--test.cssで調整した-->
        <nav>
          <ol class="breadcrumb">
            <li><a href="http://ashitabokoma.starfree.jp/">ホーム</a></li>
            <li>あしたぼコマ表</li>
          </ol>
        </nav>
                <p style="text-align:center">
            <font size="7">
                ２週間分のコマ表
            </font>
            
        </p>
        <p style="text-align:center">
            <img src="s-animal.jpg">
            <button onclick="location.href='http://localhost:80/help.php'" style="width:150px;height:70px">使い方の表示</button>
            <img src="s-animal_dance.jpg">
        </p>
        
        
        <?php
        //表示するコマの数
        $koma_su = 8;        
        //時間枠
        $time_sheet = array("09:00~10:30", "10:30~12:00", "12:00~13:30", "13:30~15:00", "15:00~16:30", "16:30~18:00", "18:00~19:30", "19:30~21:00");
        //コロナ用臨時タイムシート
        //$time_sheet = array("09:00~10:00", "10:15~11:15", "11:30~12:30", "13:00~14:00", "14:15~15:15", "15:30~16:30", "16:45~17:45", "18:00~19:00");
        
        //ファイルの存在チェック（なければ当該ディレクトリに作成）
        function mkfile($file_name, $directory){
            if (file_exists($directory."/".$file_name)){
                echo "";
            }else{
                touch($directory."/".$file_name);
                $fp = fopen($directory."/".$file_name, 'w');
                $temp_list = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                fputcsv($fp, $temp_list);
                fputcsv($fp, $temp_list);
                fputcsv($fp, $temp_list);
                fclose($fp);
            }
        }
        
        
        //現在の年月を取得
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $week = array("土", "日", "月", "火", "水", "木", "金");

        //祝日判定する
        //参考サイトhttps://www.start-point.net/blog/web/php/calendar/
        //内閣府のホームページにある祝日のcsvをダウンロードして使用する
        //CSVファイルの読み込み
        $file = new SplFileObject("syukujitsu.csv"); 
        $file->setFlags(SplFileObject::READ_CSV); 	
        $syuku_array = array();
        foreach ($file as $line) {
            //▼祝日の名前がない場合は無視(空行を読み込まない処理）
            if(isset($line[1])){
                //$line[0]に日付がはいっている
                $date = date("Y-m-d",strtotime($line[0]));
                //$line[1]に祝日の名前が入っている		
                $name = $line[1];
                $syuku_array[$date] = $name;
            }
        }
        //UNIXタイムスタンプを取得
        $time_stamp = time() - 24*60*60;

        //表の作成
        echo "<table border='1' align='center'>";
        
        //時間割
        echo "<tr><td></td>";
        for ($i=0; $i<$koma_su; $i++){
            echo "<td align='center'>", $time_sheet[$i], "</td>";
        }
        echo "</tr>";
            
        for ($i=0; $i<=14; $i++){
            echo "<tr>";
            //祝日かそうでないかを判定するフラグを設定する
            $syuku_flag=false;
            //日付の表示
            $w = $week[(date('w') + $i) % 7];
            //日曜日なら赤で表示
            if ($w == "日"){
                echo "<td style='background-color:#ff69b4' align='center'>", date('Y/m/d', $time_stamp), "  (", $w, ")", "</td>";              
            }else if(array_key_exists(date('Y-m-d', $time_stamp),$syuku_array)){//祝日なら
                echo "<td style='background-color:#ff69b4' align='center'>", date('Y/m/d', $time_stamp), "  (", $w, ")", "</td>";
                $syuku_flag=true;//祝日ならフラグをtrueにする。このフラグはtest2.phpの条件分岐で使用する
            }else if ($w == "土"){
                echo "<td style='background-color:#87cefa' align='center'>", date('Y/m/d', $time_stamp), "  (", $w, ")", "</td>";
            //}else if ($w == "水"){
                //echo "<td style='background-color:#FFFF00' align='center'>", date('Y/m/d', $time_stamp), "  (", $w, ")", "</td>";
            }else{
                echo "<td align='center'>", date('Y/m/d', $time_stamp), "  (", $w, ")", "</td>";
            }
            
            
        
            //日付のファイルが存在しているかチェックする（存在していなければ作成）
            $temp = $day+$i;
            //$file_name = "$year"."$month"."$temp".".csv";
            $day_data = date('Ymd', $time_stamp); 
            $file_name = "$day_data".".csv";
            $directory = "day_data";
            mkfile($file_name, $directory);
            
            
            //日付ファイルの情報読み出し
            $handle = fopen($directory."/".$file_name, "r");
            $data = fgetcsv($handle);
            $data2 = fgetcsv($handle);
            $data3 = fgetcsv($handle);
            
            
            $hiduke = date('Y/m/d', $time_stamp);
            
            
            for ($j=0; $j<$koma_su; $j++){
                //奇数のときのみ網掛け
                if($i == 1){//今日の予約の背景をオレンジに
                    echo "<td style='background-color:#ffe4b5' align='center'>";
                }else if ($w == "水" && $j > 4){
                    echo "<td style='background-color:#dcdcdc' align='center'>";
                //}else if($i % 2 == 0){
                    //echo "<td style='background-color:#dcdcdc' align='center'>";
                }else{
                    echo "<td align='center'>";
                }
                
                //バンド名の表示
                //リンクを作成
                //echo $data[$j]."<br>";
                //パスワードが存在した場合test2-2にリンク
                $band_name = $data[$j];
                if($data[$j] != '0'){
                    echo "<A href='test2-2.php?daydata=".$day_data."&num=".$j."&hiduke=".date('Y/m/d', $time_stamp)."&yobi=".$w."&band_name=".$band_name."'>".$data[$j]."</A>";
                }else{
                    echo "<A href='test2.php?daydata=".$day_data."&syuku_flag=".$syuku_flag."&num=".$j."&hiduke=".$hiduke."&yobi=".$w."'>".$data[$j]."</A>";
                }
                echo "<br>";
                //責任者の表示
                echo $data2[$j];
                
                echo "</td>";
            }
            
            echo "</tr>";
            
            
            //土曜日の場合のみ時間割の再表示
            if ($w == "土" and $i != 0 and $i != 14){
                //時間割の再表示
                echo "<tr><td></td>";
                for ($k=0; $k<$koma_su; $k++){
                    echo "<td align='center'>", $time_sheet[$k], "</td>";
                }
                echo "</tr>";    
            }
            

            //日付(タイムスタンプ)の更新
            $time_stamp = $time_stamp + 60*60*24;
            
        }
        echo "</table>";
        ?>
        
        <p style="text-align:right">
        <button onclick="location.href='http://localhost:80/log.php'">予約ログの表示</button>
        </p>
        
        <p style="text-align:left">
            <font size="3">
       ※ライブ3週間前からはバンド練習の人優先でお願いします。<br>
       ※水曜日の16：30以降は吹奏楽部が使うので、特別な許可がない限り使用できません。<br>
       ※平日の16時半以前のコマは3日前までに学務での予約が必須です。<br>
       ※休日のコマは終日3日前に学務での予約が必須です。
        </font>
        </p>
    </body>
</html>









