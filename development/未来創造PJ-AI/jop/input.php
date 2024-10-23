<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>入力画面</title>
    <style>
        nav {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }
        nav ul {
            display: flex;
            background: rgba(255,255,255,.7);
            margin: 0;
            list-style: none;
            padding: 0;
            font-size: 1.2rem;
        }
        nav li {
            text-align: center;
            padding: 10px 0;
            width: 80px;
            cursor: pointer;
            transition: all 1s;
        }
        nav li:hover {
            background: white;
        }
        nav + div {
            margin-top: 60px;
        }
        .hedder {
            background-color: rgb(8, 84, 236);
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ccc;
            height: 120px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        input {
            width: 90%;
            height: 80%;
            border: none;
            text-align: center;
        }
        #total {
            font-size: 20px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<?php
session_start();
$error = ""; 
$success_message = "";

if (isset($_POST["input"])) {
    $job_name = trim($_POST["job_name"]);
    $wage = trim($_POST["wage"]);
    $train_wawge = trim($_POST["train_wage"])
    $time_h = $_POST["time_h"]; // 配列として受け取る


    if (empty($job_name) || empty($wage) || empty($time_h)) {
        $error = "未入力の項目があります";
    } else {
        $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy")
        or die('Could not connect: ' . pg_last_error());

        $total_time = array_sum($time_h);

        $query = "INSERT INTO job (job_name, wage, train_wage, time_h) VALUES ($1, $2, $3, $4)";
        $result = pg_query_params($dbconn, $query, array($job_name, $wage, $train_wawge, $total_time));

        if ($result) {
            $success_message = "データが移行できました";

            // 合計時間をターミナルに送る
            exec("echo '合計時間: $total_time' >> /path/to/your/logfile.txt"); // ファイルに書き込み
        } else {
            $error = "データベースエラー: " . pg_last_error($dbconn);
        }
        pg_close($dbconn);
    }
}
?>

<nav class="hedder">
    <ul>
        <li><a href="main.php">ホーム</a></li>
        <li><a href="input.php">入力</a></li>
        <li><a href="output.php">表示</a></li>
        <li><a href="logout.php">logout</a></li>
    </ul>
</nav>

<div class="form-container">
    <?php if (!empty($success_message)): ?>
        <div class="success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <label for="job_name">アルバイト名:</label>
        <input type="text" name="job_name" id="job_name" required>
        <br>
        <label for="wage">時給:</label>
        <input type="number" name="wage" id="wage" required>
        <br>
        <input type="number" name="train_wage" required>

        <div id="total">合計: 0</div>

        <table>
            <thead>
                <tr>
                    <th>日曜日</th>
                    <th>月曜日</th>
                    <th>火曜日</th>
                    <th>水曜日</th>
                    <th>木曜日</th>
                    <th>金曜日</th>
                    <th>土曜日</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <tr>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                        <td><input type="number" name="time_h[]" required onchange="calculateTotal()"></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>

        <script>
            function calculateTotal() {
                let total = 0;
                const inputs = document.querySelectorAll('input[name="time_h[]"]');
                inputs.forEach(input => {
                    total += Number(input.value) || 0;
                });
                document.getElementById('total').innerText = '合計: ' + total;
            }
        </script>

        <br>
        <button class="entry" type="submit" name="input">完了</button>
    </form>
</div>

</body>
</html>
