<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>ログイン</title>
    <style>
        .login {
            background: linear-gradient(
                to right,
                rgb(0, 170, 255),
                rgb(0, 170, 255) 25%, 
                rgb(255, 255, 255) 25%, 
                rgb(255, 255, 255) 75%, 
                rgb(0, 170, 255) 75%
            );
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        h1 {
            color: rgb(98, 53, 221);
        }

        .login-scren {
            background: rgb(151, 151, 202);
            border: solid 1px rgb(151, 151, 202);
            border-radius: 10px;
            position: absolute; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 50px;
        }

        .login_button {
            transition: all 1s;
            font-size: 20px;
            color: rgb(255, 255, 255);
            padding: 5px 10px;
            margin: 0 3px;
            border: solid 1px white;
            border-radius: 10px;
        }

        .login_button:hover {
            background-color: rgb(151, 151, 202); 
            color: rgb(255, 255, 255);
        }

        .entry_link {
            transition: all 1s;
            background-color: rgb(0, 179, 255);
            font-size: 20px;
            color: rgb(255, 255, 255);
            padding: 5px 10px;
            margin: 0 3px;
            border: solid 1px rgb(255, 255, 255);
            border-radius: 10px;
        }

        .login-field {
            width: 60%;
            padding: 15px;
            background: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .control-group a {
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .login-scren {
                font-size: 30px; 
            }

            .login_button,
            .entry_link {
                font-size: 16px; 
            }
        }

        @media (max-width: 480px) {
            .login-scren {
                font-size: 24px; 
            }

            .login_button,
            .entry_link {
                font-size: 14px; 
            }
        }
    </style>
</head>
<body>
<?php
session_start();

if (isset($_POST["login"])) {
    $uname = trim($_POST['uname']);
    $password = trim($_POST['password']);

    // データベースへの接続
    $dbconn = pg_connect("host=localhost dbname=s_yugo user=s_yugo password=9fjrtvAy") 
        or die('Could not connect: ' . pg_last_error());

    // SQLクエリの準備
    $query = "SELECT id FROM job_users WHERE uname = $1 AND password = $2"; // idを使用
    $result = pg_query_params($dbconn, $query, array($uname, $password));

    if (pg_num_rows($result) > 0) {
        // ログイン成功時のリダイレクト
        $uid = pg_fetch_result($result, 0, 'id'); // idを使用
        $_SESSION['uid'] = $uid;
        $_SESSION['uname'] = $uname; // ユーザーネームをセッションに保存
        header("Location: home.php");
        exit;
    } else {
        // ログイン失敗時
        $error = 'ユーザーネームまたはパスワードが間違っています';
    }

    pg_close($dbconn);
}
?>

    <div class="login">
        <div class="login-scren">
            <h1>バイト収入計算</h1> 

            <div class="login-form">
                <form method="POST" action="">
                    <div class="control-group">
                        <a>ユーザーネーム</a>
                        <br>
                        <input type="text" class="login-field" name="uname" placeholder="ユーザーネーム" id="login-name" required>
                    </div>
                    
                    <div class="control-group">
                        <a>パスワード</a>
                        <br>
                        <input type="password" class="login-field" name="password" placeholder="パスワードの入力" id="login-pass" required>
                    </div>

                    <br>
                    <a class="entry_link" href="entry.php">新規登録</a>
                    <button class="login_button" type="submit" name="login" href="main.php">ログイン</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
