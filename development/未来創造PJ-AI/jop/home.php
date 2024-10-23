<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px; /* テーブルとナビゲーションの間にスペースを追加 */
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            width: 100%;
            height: 100%;
            border: none;
            background-color: transparent;
            cursor: pointer;
        }
        .pressed {
            background-color: yellow; /* 押されたボタンの色 */
        }
        /* ナビゲーション */
        nav {
            position: relative; /* 変更：absoluteからrelativeに */
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
        .nav-item {
            font-size: 10px;
            text-align: center;
            margin-bottom: 15px;
            margin-top: 15px;
            color: black;
            border: 1px solid rgb(255, 255, 255);
        }
        .hedder {
            background-color: rgb(8, 84, 236);
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 各ボタンにクリックイベントを追加
            for (let i = 1; i <= 35; i++) {
                const button = document.getElementById(`button${i}`);
                button.addEventListener('click', function() {
                    button.classList.toggle('pressed'); // 押されたときに色を変える
                    // 遷移先を決めてページを遷移
                    setTimeout(() => {
                        window.location.href = 'data_input.php';
                    }, 100); // クリック後に少し遅れて遷移
                });
            }
        });
    </script>
</head>

<body>

    <nav class="hedder">
        <ul>
            <li class="nav-item"><a href="home.php">ホーム</a></li>
            <li class="nav-item"><a href="output.php">表示</a></li>
            <li class="nav-item"><a href="login_job.php">logout</a></li>
        </ul>
    </nav>
    
    <table>
        <thead>
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><button id="button1" onclick="location.href='data_input.php'">ボタン1</button></td>
                <td><button id="button2" onclick="location.href='data_input.php'">ボタン2</button></td>
                <td><button id="button3" onclick="location.href='data_input.php'">ボタン3</button></td>
                <td><button id="button4" onclick="location.href='data_input.php'">ボタン4</button></td>
                <td><button id="button5" onclick="location.href='data_input.php'">ボタン5</button></td>
                <td><button id="button6" onclick="location.href='data_input.php'">ボタン6</button></td>
                <td><button id="button7" onclick="location.href='data_input.php'">ボタン7</button></td>
            </tr>
            <tr>
                <td><button id="button8" onclick="location.href='data_input.php'">ボタン8</button></td>
                <td><button id="button9" onclick="location.href='data_input.php'">ボタン9</button></td>
                <td><button id="button10" onclick="location.href='data_input.php'">ボタン10</button></td>
                <td><button id="button11" onclick="location.href='data_input.php'">ボタン11</button></td>
                <td><button id="button12" onclick="location.href='data_input.php'">ボタン12</button></td>
                <td><button id="button13" onclick="location.href='data_input.php'">ボタン13</button></td>
                <td><button id="button14" onclick="location.href='data_input.php'">ボタン14</button></td>
            </tr>
            <tr>
                <td><button id="button15" onclick="location.href='data_input.php'">ボタン15</button></td>
                <td><button id="button16" onclick="location.href='data_input.php'">ボタン16</button></td>
                <td><button id="button17" onclick="location.href='data_input.php'">ボタン17</button></td>
                <td><button id="button18" onclick="location.href='data_input.php'">ボタン18</button></td>
                <td><button id="button19" onclick="location.href='data_input.php'">ボタン19</button></td>
                <td><button id="button20" onclick="location.href='data_input.php'">ボタン20</button></td>
                <td><button id="button21" onclick="location.href='data_input.php'">ボタン21</button></td>
            </tr>
            <tr>
                <td><button id="button22" onclick="location.href='data_input.php'">ボタン22</button></td>
                <td><button id="button23" onclick="location.href='data_input.php'">ボタン23</button></td>
                <td><button id="button24" onclick="location.href='data_input.php'">ボタン24</button></td>
                <td><button id="button25" onclick="location.href='data_input.php'">ボタン25</button></td>
                <td><button id="button26" onclick="location.href='data_input.php'">ボタン26</button></td>
                <td><button id="button27" onclick="location.href='data_input.php'">ボタン27</button></td>
                <td><button id="button28" onclick="location.href='data_input.php'">ボタン28</button></td>
            </tr>
            <tr>
                <td><button id="button29" onclick="location.href='data_input.php'">ボタン29</button></td>
                <td><button id="button30" onclick="location.href='data_input.php'">ボタン30</button></td>
                <td><button id="button31" onclick="location.href='data_input.php'">ボタン31</button></td>
                <td><button id="button32" onclick="location.href='data_input.php'">ボタン32</button></td>
                <td><button id="button33" onclick="location.href='data_input.php'">ボタン33</button></td>
                <td><button id="button34" onclick="location.href='data_input.php'">ボタン34</button></td>
                <td><button id="button35" onclick="location.href='data_input.php'">ボタン35</button></td>
            </tr>
        </tbody>
    </table>

</body>
</html>
