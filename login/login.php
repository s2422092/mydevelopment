<!DOCTYPE html>
<html>  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>ログイン</title>  
    <style>
        .login {
            background: linear-gradient(to right, rgb(134, 248, 21) 50%, transparent 50%);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        .login-screen {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .app-title h1 {
            color: #333;
            font-size: 36px;
            text-align: center;
            font-family: 'Helvetica Neue';
            margin: 0;
        }

        .app-title h2 {
            color: #666;
            font-size: 18px;
            text-align: center;
            font-family: 'Helvetica Neue';
        }

        .login-field {
            width: 100%;
            padding: 15px;
            background: #f8f8f8;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 14px;
            border-radius: 5px;
        }

        .login-button {
            background-color: rgb(134, 248, 21);
            color: #fff;
            border: none;
            padding: 15px;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-button:hover {
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
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if (isset($_POST['login'])) {
        $uname = $_POST['uname'];
        $password = $_POST['password'];

        // データベースに接続
        $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy") 
            or die('Could not connect: ' . pg_last_error());

        // SQLインジェクション対策のためにプレースホルダーを使用
        $query = "SELECT * FROM users WHERE uname = $1 AND password = $2";
        $result = pg_query_params($dbconn, $query, array($uname, $password));

        if (pg_num_rows($result) > 0) {
            // ログイン成功、リダイレクト
            header('Location: register.php');
            exit;
        } else {
            // ログイン失敗
            $error = 'ユーザーネームまたはパスワードが間違っています';
        }

        // データベース接続を閉じる
        pg_close($dbconn);
    }
    ?>
    <div class="login">
        <div class="login-screen">
            <div class="app-title">
                <h1>Tourism plan</h1>
                <h2>ログイン</h2>
            </div>
  
            <form action="" method="post">
                <div class="login-form">
                    <div class="control-group">
                        <input type="text" class="login-field" name="uname" placeholder="ユーザーネーム" id="login-name" required>
                    </div>
                    <div class="control-group">
                        <input type="password" class="login-field" name="password" placeholder="パスワードの入力" id="login-pass" required>
                    </div>
                    <button type="submit" class="login-button" name="login">ログイン</button>
                    <a class="login-link" href="register.php">新規作成</a>
                    <?php if (isset($error)): ?>
                        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
