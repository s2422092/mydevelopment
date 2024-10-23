<?php
session_start();
if (!isset($_SESSION['uname'])) {
    // ユーザーネームがセッションにない場合はログインページにリダイレクト
    header("Location: login_job.php");
    exit;
}

$uname = $_SESSION['uname']; // ユーザーネームを取得
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ入力</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* アリスブルーの背景 */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #fff; /* 白い背景 */
            border: 2px solid blue; /* 境界線の色 */
            border-radius: 8px; /* 角を丸く */
            padding: 20px; /* 内側の余白 */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 影 */
            width: 400px; /* 幅を固定 */
            text-align: center; /* 中央寄せ */
        }

        .container h1 {
            color: blue;
            margin-bottom: 20px;
        }

        .input-group {
            margin: 10px 0;
        }

        .input-group label {
            display: block; /* ラベルをブロック要素に */
            margin-bottom: 5px; /* 下にスペース */
            color: #333;
        }

        .input-group input {
            width: 100%; /* 幅を100%に */
            padding: 10px; /* 内側の余白 */
            border: 1px solid #ccc; /* 境界線の色 */
            border-radius: 4px; /* 角を丸く */
            box-sizing: border-box; /* パディングを含めた計算 */
        }

        .error-message {
            color: red;
            margin: 10px 0;
        }

        .button-group {
            display: flex;
            justify-content: space-between; /* ボタンを左右に配置 */
            margin-top: 20px;
        }

        .button-group button {
            background-color: blue; /* ボタンの背景色 */
            color: white; /* ボタンの文字色 */
            border: none; /* ボーダーなし */
            border-radius: 4px; /* 角を丸く */
            padding: 10px 15px; /* 内側の余白 */
            cursor: pointer; /* カーソルをポインタに */
            transition: background-color 0.3s; /* ホバー効果のトランジション */
        }

        .button-group button:hover {
            background-color: darkblue; /* ホバー時の色 */
        }


    </style>

</head>

<body>

<?php
session_start();
$error = "";

if (isset($_POST["job_input_time"])) {
    $uname = trim($_POST["username"]);
    $job_start_time = trim($_POST["job_start_time"]);
    $job_end_time = trim($_POST["job_end_time"]);

    // データが入力されているかの確認
    if (empty($uname) || empty($job_start_time) || empty($job_end_time)) {
        $error = "未入力項目があります";
    } else {
        // 今日の日付を取得
        $today = date('Y-m-d');

        // 時間のみを含む日付を作成
        $start_time = DateTime::createFromFormat('Y-m-d H:i:s', "$today $job_start_time:00");
        $end_time = DateTime::createFromFormat('Y-m-d H:i:s', "$today $job_end_time:00");

        if (!$start_time || !$end_time) {
            $error = "日付のフォーマットが正しくありません。例: HH:MM:SS";
        } else {
            // 時間の差を計算
            $interval = $end_time->diff($start_time);
            $job_time = $interval->format('%H:%I:%S'); // 時間、分、秒の形式でフォーマット

            // データベースへの接続
            $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy")
                or die('Could not connect: ' . pg_last_error());

            // SQLへのリクエスト
            $query = "INSERT INTO job_time(uname, job_start_time, job_end_time, job_time) VALUES($1, $2, $3, $4)";
            $result = pg_query_params($dbconn, $query, array($uname, $job_start_time, $job_end_time, $job_time));

            if ($result) {
                // データ移行成功時のリダイレクト
                header('Location: home.php');
                exit;
            } else {
                // データベースエラー
                $error = "データベースエラー: " . pg_last_error($dbconn);
            }

            pg_close($dbconn);
        }
    }
}
?>


<div class="container">
    <h1>勤務時間の記入</h1>

    <h2>ようこそ, <?php echo htmlspecialchars($uname); ?>さん!</h2> <!-- ユーザーネームを表示 -->


    <?php if (!empty($error)): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="./data_input.php">
        <div class="input-group">
            <label for="username">username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="job_start_time">始業時間 (開始):</label>
            <input type="time" id="job_start_time" name="job_start_time" required>
        </div>
        <div class="input-group">
            <label for="job_end_time">就業時間 (終了):</label>
            <input type="time" id="job_end_time" name="job_end_time" required>
        </div>
        <div class="button-group">
            <button type="button" onclick="location.href='home.php'">戻る</button>
            <button type="submit" name="job_input_time">完了</button>
        </div>
    </form>
</div>
</body>
</html>
