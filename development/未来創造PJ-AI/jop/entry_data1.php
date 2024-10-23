<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ入力</title>
    <style>
        /* スタイルを必要に応じて追加 */

        body {
    background: linear-gradient(to right, #d1eaff, #91c5f9); /* グラデーションを設定 */
    margin: 0; /* マージンをリセット */
    font-family: Arial, sans-serif; /* フォントを設定 */
}

.ba- {
    border-radius: 40px; /* ボーダーの半径を設定 */
    background-color: aqua; /* 背景色を設定 */
    width: 100%; /* 幅を設定 */
    max-width: 1000px; /* 最大幅を設定 */
    padding: 8px; /* 内側の余白を追加 */
    margin: 20px auto; /* 自動的に中央に配置 */
    text-align: left; /* 左揃え */
    padding-left: 60px; /* 左側のパディングを追加して移動 */
    border:2px solid white
}

.users {
    position: absolute; /* 絶対位置指定に変更 */
    top: 50%; /* 垂直方向で50% */
    left: 50%; /* 水平方向で50% */
    width: 35%; /* 幅を設定 */
    background: aliceblue; /* 背景色 */
    border: 2px solid rgb(255, 255, 255); /* 境界線の太さと色を指定 */
    border-radius: 5px; /* 角を丸くするオプション */
    padding: 5px; /* 内側の余白を追加 */
    transform: translate(-50%, -50%); /* 中央に配置するために移動 */
    background-color: aliceblue; /* 背景色 */
    text-align: center; /* テキストを中央揃え */
}

.users input {
    border-radius: 10px; /* 角を丸くする */
    margin: 10px 0; /* 上下に10pxのマージンを追加 */
    padding: 8px; /* 内側の余白を追加 */
    width: 60%; /* 幅を調整 */
    border-radius: 10px; /* 角を丸くする */
    padding: 8px; /* 内側の余白を追加 */
    border: 1px solid #ccc; /* 枠線のスタイル */
    box-sizing: border-box; /* 幅の計算にパディングとボーダーを含める */
}

label {
    display: block; /* ラベルをブロック要素にして、行の幅いっぱいに表示 */
    margin-bottom: 5px; /* ラベルと入力フィールドの間に余白を追加 */
}

.form-group {
    margin-bottom: 15px; /* 各入力フィールドの間に余白を追加 */
}
.circle-container {
    display: flex; /* フレックスボックスを使用して、子要素を配置 */
    justify-content: center; /* 円を水平方向に中央揃え */
    margin-bottom: 20px; /* 円のコンテナの下に20ピクセルのマージンを追加 */
}
.circle-container-item {
            display: flex;
            flex-direction: column; /* Stack label and circle vertically */
            align-items: center; /* Center items horizontally */
            margin: 0 20px; /* Add horizontal margin */
        }


        .circle {
            width: 50px;
            height: 50px;
            background-color: rgb(227, 246, 246);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            margin-bottom: 10px; /* Space between circle and label */
        }

.circle-1 {
    background-color: rgb(87, 85, 240); /* 円1の色 */
    color: rgb(255, 255, 255);
}

.circle-2 {
    background-color: rgb(87, 85, 240); /* 円2の色 */
    color: rgb(255, 255, 255);
    
}

.circle-3 {
    background-color: rgb(227, 246, 246); /* 円3の色 */
}

.form-group select {
    width: 60%; /* 幅を100%に設定して親要素にフィットさせる */
    height: 40px; /* 高さを40ピクセルに設定（必要に応じて調整） */
    padding: 8px; /* 内側の余白を追加 */
    border-radius: 10px; /* 角を丸くする */
    border: 1px solid #ccc; /* 枠線のスタイルを指定 */
    box-sizing: border-box; /* パディングやボーダーを含めた幅の計算をする */
}


button {
            padding: 10px; /* ボタンの内側の余白 */
            background-color: rgb(87, 85, 240); /* ボタンの背景色 */
            color: white; /* ボタンの文字色 */
            border: none; /* ボタンの枠線をなしに */
            border-radius: 5px; /* ボタンの角を丸くする */
            cursor: pointer; /* カーソルをポインターに */
            margin-top: 10px; /* 上にマージンを追加 */
            width: 50%; /* 幅を100%に */
        }

button:hover {
            background-color: rgb(70, 70, 210); /* ホバー時の色 */
        }
    </style>
</head>
<body>
<?php
session_start();
$error = "";

if (isset($_POST['entry_data1'])) {
    $uname=trim($_POST['uname']);
    $job_place = trim($_POST['job_place']);
    $job_name = trim($_POST['job_name']);
    $genre = trim($_POST['genre']);
    $area = trim($_POST['area']);

    // エラーチェック
    if (empty($uname) || empty($job_place) || empty($job_name) || empty($genre) || empty($area)) {
        $error = "未入力項目があります";
    } else {
        // データベース接続
        $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy")
        or die('Could not connect: ' . pg_last_error());

        // SQLインジェクション対策のためにプレースホルダーを使用
        $query = "INSERT INTO entry_data1(uname, job_place, job_name, genre, area) VALUES ($1, $2, $3, $4, $5)";
        $result = pg_query_params($dbconn, $query, array($uname, $job_place, $job_name, $genre, $area));

        if ($result) {
            // データ移行成功時のリダイレクト
            header('Location: entry_data1.php');
            exit;
        } else {
            // データベースエラー
            $error = "データベースエラー: " . pg_last_error($dbconn);
        }
        pg_close($dbconn);
    }
}
?>


<div class="ba-">
            <h1>バイト情報 1</h1>
        </div>

        <div class="circle-container">
            <div class="circle-container-item">
                <div class="circle circle-1" id="1">1</div>
                <label for="1">ユーザー登録</label>
            </div>
            
            <div class="circle-container-item">
                <div class="circle circle-2" id="2">2</div>
                <label>バイト情報 1</label>
            </div>
    
            <div class="circle-container-item">
                <div class="circle circle-3" id="3">3</div>
                <label>バイト情報 2</label> <!-- 修正 -->
            </div>
        </div>
    
    <form action="entry_data2.php" method="POST">
       
    <div class="users">
                <div class="form-group">
                    <label for="uname">username</label>
                    <input type="text" id="uname" name="uname" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="job_place">バイト先:</label>
                    <input type="text" id="job_place" name="job_place" placeholder="バイト先（任意）" required>
                </div>

                <div class="form-group">
                    <label for="job_name">バイト名:</label>
                    <input type="text" id="job_name" name="job_name" placeholder="バイト名（任意）" required>
                </div>
                
                <div class="form-group">
                    <label for="genre">ジャンル:</label>
                    <select id="genre" name="genre" required>
                        <option value="food_service">飲食業</option>
                        <option value="retail">販売業</option>
                        <option value="service_industry">サービス業</option>
                        <option value="education">教育関係</option>
                        <option value="office_job">事務職</option>
                        <option value="logistics">物流業</option>
                        <option value="other">その他</option>
                    </select>
                </div>

                    <div class="form-group">
                    <label for="area">場所:</label>
                    <select id="area" name="area" required>
                        <option value="" disabled selected>場所（任意）</option>
                        <option value="hokkaido">北海道</option>
                        <option value="aomori">青森県</option>
                        <option value="iwate">岩手県</option>
                        <option value="miyagi">宮城県</option>
                        <option value="akita">秋田県</option>
                        <option value="yamagata">山形県</option>
                        <option value="fukushima">福島県</option>
                        <option value="ibaraki">茨城県</option>
                        <option value="tochigi">栃木県</option>
                        <option value="gunma">群馬県</option>
                        <option value="saitama">埼玉県</option>
                        <option value="chiba">千葉県</option>
                        <option value="tokyo">東京都</option>
                        <option value="kanagawa">神奈川県</option>
                        <option value="niigata">新潟県</option>
                        <option value="toyama">富山県</option>
                        <option value="ishikawa">石川県</option>
                        <option value="fukui">福井県</option>
                        <option value="yamanashi">山梨県</option>
                        <option value="nagano">長野県</option>
                        <option value="gifu">岐阜県</option>
                        <option value="shizuoka">静岡県</option>
                        <option value="aichi">愛知県</option>
                        <option value="mie">三重県</option>
                        <option value="shiga">滋賀県</option>
                        <option value="kyoto">京都府</option>
                        <option value="osaka">大阪府</option>
                        <option value="hyogo">兵庫県</option>
                        <option value="nara">奈良県</option>
                        <option value="wakayama">和歌山県</option>
                        <option value="tottori">鳥取県</option>
                        <option value="shimane">島根県</option>
                        <option value="okayama">岡山県</option>
                        <option value="hiroshima">広島県</option>
                        <option value="yamaguchi">山口県</option>
                        <option value="tokushima">徳島県</option>
                        <option value="kagawa">香川県</option>
                        <option value="ehime">愛媛県</option>
                        <option value="kochi">高知県</option>
                        <option value="fukuoka">福岡県</option>
                        <option value="saga">佐賀県</option>
                        <option value="nagasaki">長崎県</option>
                        <option value="kumamoto">熊本県</option>
                        <option value="oita">大分県</option>
                        <option value="miyazaki">宮崎県</option>
                        <option value="kagoshima">鹿児島県</option>
                        <option value="okinawa">沖縄県</option>
                    </select>
                </div>
                <button type="submit" name="entry_data1">完了</button>

            </div>
    </form>

    <?php
    // エラーメッセージを表示
    if (!empty($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
</div>
</body>
</html>
