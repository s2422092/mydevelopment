<?php
session_start();
if (!isset($_SESSION['uname'])) {
    // ユーザーネームがセッションにない場合はログインページにリダイレクト
    header("Location: login_job.php");
    exit;
}

$uname = $_SESSION['uname']; // ユーザーネームを取得

// データベースへの接続
$dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy")
    or die('Could not connect: ' . pg_last_error());

// SQLクエリの作成
$query = "
    SELECT 
        jd.job_id, 
        jd.uname, 
        jd.wage, 
        jd.wage_date, 
        jd.train_cost, 
        jd.lunch_costs, 
        jd.lunch_time, 
        jd.break_duration, 
        jd.break_time, 
        jd.wageup, 
        jd.wageup_start_time, 
        jd.wageup_end_time, 
        jt.job_start_time, 
        jt.job_end_time, 
        jt.job_time 
    FROM 
        job_details jd
    INNER JOIN 
        job_time jt ON jd.job_id = jt.id;
";

// クエリの実行
$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <style>
        body {
            background: linear-gradient(to right, #d1eaff, #91c5f9);
            margin: 0;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: rgb(8, 84, 236);
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav li {
            text-align: center;
            padding: 10px 20px;
            cursor: pointer;
            transition: background 0.3s;
        }

        nav li:hover {
            background: rgba(255, 255, 255, 0.7);
        }

        .hedder {
            color: white;
            font-size: 1.5rem;
        }

        .job_money {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .job_money h1 {
            margin-bottom: 10px;
        }

        .job_money h3 {
            font-size: 2rem;
            color: rgb(8, 84, 236);
        }

        .job_result {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .job_result p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <nav class="hedder">
        <ul>
            <li><a href="main.html">ホーム</a></li>
            <li><a href="output.html">表示</a></li>
            <li><a href="logout.html">ログアウト</a></li>
        </ul>
    </nav>

    <div class="job_money">
        <h1>今月の総給料</h1>
        <h3 id="money">1000</h3>
        <label for="money">円</label>
    </div>

    <div class="job_result">
        <h2>ジョブ情報</h2>
        <?php
        // 結果の出力
        if (pg_num_rows($result) == 0) {
            echo '<p>No data found.</p>';
        } else {
            while ($line = pg_fetch_assoc($result)) {
                echo "<div class='result'>";
                echo "<p>Job ID: {$line['job_id']}</p>";
                echo "<p>Username: {$line['uname']}</p>";
                echo "<p>Wage: {$line['wage']}</p>";
                echo "<p>Wage Date: {$line['wage_date']}</p>";
                echo "<p>Train Cost: {$line['train_cost']}</p>";
                echo "<p>Lunch Costs: {$line['lunch_costs']}</p>";
                echo "<p>Lunch Time: {$line['lunch_time']}</p>";
                echo "<p>Break Duration: {$line['break_duration']}</p>";
                echo "<p>Break Time: {$line['break_time']}</p>";
                echo "<p>Wage Up: {$line['wageup']}</p>";
                echo "<p>Wage Up Start Time: {$line['wageup_start_time']}</p>";
                echo "<p>Wage Up End Time: {$line['wageup_end_time']}</p>";
                echo "<p>Job Start Time: {$line['job_start_time']}</p>";
                echo "<p>Job End Time: {$line['job_end_time']}</p>";
                echo "<p>Job Time: {$line['job_time']}</p>";
                echo "</div><hr>";
            }
        }
        ?>
    </div>

    <!-- 接続のクローズ -->
    <?php pg_close($dbconn); ?>
</body>
</html>
