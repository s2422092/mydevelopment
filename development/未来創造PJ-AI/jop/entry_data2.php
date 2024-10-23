<?php
session_start();
$error = "";

if (isset($_POST['entry_data2'])) {
    $uname=trim($_POST['uname']);
    $wage = trim($_POST['wage']);
    $wage_date = trim($_POST['wage_date']);
    $train_cost = trim($_POST['train_cost']);
    $lunch_costs = trim($_POST['lunch_costs']);
    $lunch_time = trim($_POST['lunch_time']);
    $break = trim($_POST['break']);
    $break_time = trim($_POST['break_time']);
    $wageup = trim($_POST['wageup']);
    $wageup_start_time = $_POST['wageup_start_time'];
    $wageup_end_time = $_POST['wageup_end_time'];

    // すべての変数が未入力でないかチェック
    if (empty($wage) || empty($wage_date) || empty($train_cost)) {
        $error = "未入力項目があります";
    } else {
        // データベースへの接続
        $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy")
        or die('Could not connect: ' . pg_last_error());

        // すべての情報を1つのINSERT文で挿入
        foreach ($wageup_start_time as $index => $start_time) {
            $query = "INSERT INTO job_details (uname, wage, wage_date, train_cost, lunch_costs, lunch_time, break_duration, break_time, wageup, wageup_start_time, wageup_end_time) 
                      VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)";
            $result = pg_query_params($dbconn, $query, array(
                $uname,
                $wage, 
                $wage_date, 
                $train_cost, 
                $lunch_costs, 
                $lunch_time, 
                $break, 
                $break_time, 
                $wageup, 
                $start_time, 
                $wageup_end_time[$index]
            ));

            // 挿入に失敗した場合はエラーメッセージを設定
            if (!$result) {
                $error = "データベースエラー: " . pg_last_error($dbconn);
                break; // エラーが発生した場合はループを中断
            }
        }

        if (empty($error)) {
            // 成功時のリダイレクト
            header('Location: home.php');
            exit;
        }

        pg_close($dbconn);
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データ入力</title>
    <style>
                body {
            background: linear-gradient(to right, #d1eaff, #91c5f9);
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .ba- {
            border-radius: 40px;
            background-color: aqua;
            width: 100%;
            max-width: 1000px;
            padding: 8px;
            margin: 20px auto;
            text-align: left;
            padding-left: 60px;
            border: 2px solid white;
        }

        .users {
            max-width: 600px;
            margin: 0 auto;
            background: aliceblue;
            border: 2px solid rgb(255, 255, 255);
            border-radius: 5px;
            padding: 20px;
            box-sizing: border-box;
            position: relative; /* Relative positioning */
            top: 20px; /* Adjust vertical position */
        }

        .users input,
        button {
            width: 100%;
            box-sizing: border-box;
            margin: 10px 0;
            padding: 8px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .circle-container {
            display: flex;
            justify-content: center; /* Center the circles horizontally */
            margin-bottom: 20px; /* Add margin below the circle container */
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
            background-color: rgb(87, 85, 240);
            color: rgb(255, 255, 255);
        }
        .circle-2 {
            background-color: rgb(87, 85, 240);
            color: rgb(255, 255, 255);
        }
        .circle-3 {
            background-color: rgb(87, 85, 240);
            color: rgb(255, 255, 255);
        }

/* ボタンのスタイル */
button {
    padding: 10px;
    background-color: rgb(87, 85, 240);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    width: 50%; /* 幅を50%に設定 */
    display: inline-block; /* 中央配置のために追加 */
}

/* ホバー時のスタイル */
button:hover {
    background-color: rgb(70, 70, 210);
}

/* ボタンを含む親要素に追加 */
form {
    text-align: center; /* 中央に配置 */
}


        @media (max-width: 600px) {
            .users {
                width: 100%;
            }
            .circle-container {
                flex-direction: column; /* Stack circles vertically on small screens */
                align-items: center;
            }
        }
    </style>
</head>
<body>

<form action="" method="post">
<div class="ba-">
        <h1>アルバイト情報2</h1>
    </div>

    <div class="circle-container">
        <div class="circle-container-item">
            <div class="circle circle-1" id="1">1</div>
            <label for="1">ユーザー登録</label>
        </div>

        <div class="circle-container-item">
            <div class="circle" id="circle-2">2</div>
            <label for="circle-2">バイト情報 1</label>
        </div>

        <div class="circle-container-item">
            <div class="circle" id="circle-3">3</div>
            <label for="circle-3">バイト情報 2</label>
        </div>
    </div>


        <!--基本情報についての入力画面-->
        <div class="users">
            <h2>基本情報</h2>
            <div class="form-group">
                <label for="uname">usersname:</label>
                <input type="text" id="uname" name="uname" placeholder="名前" required>
            </div>

            <div class="form-group">
                <label for="wage">基本給料:</label>
                <input type="number" id="wage" name="wage" placeholder="基本給料" required>
            </div>

            <div class="form-group">
                <label for="wage_data">給料日:</label>
                <input type="date" id="wage_data" name="wage_date" placeholder="給料日" required>
            </div>

            <div class="form-group">
                <label for="train_cost">交通費:</label>
                <input type="number" id="train_cost" name="train_cost" placeholder="交通費" required>
            </div>

            <h2>詳細情報</h2>
            <div class="form-group">
                <label for="lunch_costs">昼食費</label>
                <input type="number" id="lunch_costs" name="lunch_costs" placeholder="昼食費">
            </div>

            <div class="form-group">
                <label for="lunch_time">昼食費が発生する勤務時間:</label>
                <input type="time" id="lunch_time" name="lunch_time">
            </div>

            <div class="form-group">
                <label for="break">休憩時間(h):</label>
                <input type="number" id="break" name="break" placeholder="休憩時間">
            </div>

            <div class="form-group">
                <label for="break_time">休憩時間が発生する勤務時間:</label>
                <input type="time" id="break_time" name="break_time">
            </div>

            <div class="form-group">
                <label for="wageup">時給アップ代金:</label>
                <input type="number" id="wageup" name="wageup" placeholder="時給アップ">
            </div>

            <div class="form-group">
                <div id="form-container">
                    <div class="input-group wageup_t_add">
                        <label for="wageup_start_time">時給アップ時間帯 (開始):</label>
                        <input type="time" id="wageup_start_time" name="wageup_start_time[]" required>
                        
                        <label for="wageup_end_time">時給アップ時間帯 (終了):</label>
                        <input type="time" id="wageup_end_time" name="wageup_end_time[]" required>
                    </div>
                </div>
            </div>

            <button id="add-input" type="button">入力フォームを追加</button>
            <button type="submit" nmae="entry_data2.php">完了</button>
        </div>

        <?php if (!empty($error)): ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>
    

    </div>
</form>
    <script>
        document.getElementById('add-input').addEventListener('click', function(event){
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('input-group', 'wageup_t_add');

            const startLabel = document.createElement('label');
            startLabel.textContent = '時給アップ時間帯 (開始):';

            const startInput = document.createElement('input');
            startInput.type = 'time';
            startInput.name = 'wageup_start_time[]';
            startInput.required = true;

            const endLabel = document.createElement('label');
            endLabel.textContent = '時給アップ時間帯 (終了):';

            const endInput = document.createElement('input');
            endInput.type = 'time';
            endInput.name = 'wageup_end_time[]';
            endInput.required = true;

            inputGroup.appendChild(startLabel);
            inputGroup.appendChild(startInput);
            inputGroup.appendChild(endLabel);
            inputGroup.appendChild(endInput);

            document.getElementById('form-container').appendChild(inputGroup);
        });
    </script>

</body>
</html>
