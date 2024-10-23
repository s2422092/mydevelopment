<?php
$error = ''; // エラーメッセージの初期化
session_start();
if (isset($_POST['register'])) {
    $uname = trim($_POST['uname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // 必須項目がすべて入力されているかをチェック
    if (empty($uname) || empty($email) || empty($password)) {
        $error = "未入力の項目があります";
    } else {
        // データベースに接続
        $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy")
            or die('Could not connect: ' . pg_last_error());

        // データを挿入
        $query = "INSERT INTO users (uname, email, password) VALUES ($1, $2, $3)";
        $result = pg_query_params($dbconn, $query, array($uname, $email, $password));
        
        if ($result) {
            // 登録成功後にログインページへリダイレクト
            header('Location: login.php');
            exit;
        } else {
            // クエリが失敗した場合のエラーメッセージ
            $error = "データベースエラー: " . pg_last_error($dbconn);
        }

        // 接続を閉じる
        pg_close($dbconn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録</title>
    <style>
        body {
            margin: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(
                to right,
                white,
                white 25%,
                rgb(134, 248, 21, 0.6) 25%,
                rgb(134, 248, 21, 0.6) 75%,
                white 75%
            );
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .register-screen {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px; /* 最大幅を設定 */
        }
        
        .app-title h1 {
            color: rgb(0, 0, 0);
            font-size: 36px;
            text-align: center;
            margin: 0;
        }

        .login-form {
            font-size: 16px;
            text-align: center;
        }

        .login-field {
            width: 100%;
            padding: 12px;
            background: #f8f8f8;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 5px;
        }

        .button {
            background-color: rgb(134, 248, 21);
            color: #fff;
            border: none;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .button:hover {
            background-color: rgb(105, 198, 17);
        }

        .login-link {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: rgb(134, 248, 21);
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        .login-link:hover {
            color: rgb(105, 198, 17);
        }

        .error-message {
            font-size: 16px;
            color: red;
            text-align: center;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .app-title h1 {
                font-size: 28px;
            }

            .login-field {
                font-size: 12px;
                padding: 10px;
            }

            .button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="register-screen">
            <div class="app-title">
                <h1>新規登録</h1>
                <?php if (!empty($error)): ?>
                    <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
                <?php endif; ?>
            </div>
            <div class="login-form">
                <div class="control-group">
                    <input type="text" class="login-field" name="uname" placeholder="ユーザーネーム" id="User_name">
                </div>
                <div class="control-group">
                    <input type="text" class="login-field" name="email" placeholder="メールアドレス" id="email">
                </div>
                <div class="control-group">
                    <input type="password" class="login-field" name="password" placeholder="パスワード" id="login-pass">
                </div>
                <div class="control-group">
                    <input type="password" class="login-field" placeholder="パスワードの再入力" id="login-pass-confirm">
                </div>
                <button type="submit" class="button" name="register">登録</button>
                <a class="login-link" href="login.php">戻る</a>
            </div>
        </div>
    </form>
</body>
</html>
