<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mypage2</title>
        <style>
            #header {
            box-sizing: border-box;
            background: #ccc;
            height: 50px;
            }
            #humberger {
            position: relative;
            height: 25px;
            width: 28px;
            display: inline-block;
            box-sizing: border-box;
            margin: 10px;
            }
            #humberger div {
            position: absolute;
            left: 0;
            height: 2px;
            width: 28px;
            background-color: #444;
            border-radius: 2px;
            display: inline-block;
            box-sizing: border-box;
            }
            #humberger div:nth-of-type(1) {
            bottom: 20px;
            }
            #humberger div:nth-of-type(2) {
            bottom: 10px;
            }
            #humberger div:nth-of-type(3) {
            bottom: 0;
            }
            #offcanvasID {
            width: 300px;
            }
    
            .offcanvas-body {
            margin-top: 50px;
            }
            
            .nav-item {
            font-size: 30px;
            text-align: center;
            margin-bottom: 15px;
            margin-top: 15px;
            color: black;
            border: 5px solid black;
            a {
            text-decoration: none;
            color: #000000;
            }
            }
            .result {
                li{
                list-style:none;
                font-size: large;
                }
            }
            img {
                padding-top: 10px;
            }
        </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<header id="header">
            <a class="border border-0" data-bs-toggle="offcanvas" href="#offcanvasID" role="button" aria-controls="offcanvasID">
                <div id="humberger">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </a>
        </header>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasID" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
              <h1 class="offcanvas-title" id="offcanvasLabel">shere my trips</h1>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="./timeline001.php">timeline</a></li>
                    <li class="nav-item"><a href="./mypage.php">my page</a></li>
                    <li class="nav-item"><a href="./edit.html">shere</a></li>
                    <li class="nav-item"><a href="#">option</a></li>
                    <li class="nav-item"><a href="./search.php">search</a></li>
                </ul>
            </div>
        </div>
        <?php
        session_start();
        $vid = $_SESSION['vid'];
        $dbconn = pg_connect("host=localhost dbname=hikari user=hikari password=6T03EFMj") or die('Could not connect: ' . pg_last_error());
        // $query = "SELECT * FROM memory WHERE vid = " . $vid . ";";
        $query = "SELECT * FROM memory WHERE vid = 1;";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        while ($line = pg_fetch_array($result)) {
        echo "<div class='result'>";
        echo "<li><img width='500' class='img1' src=\"./uploads/$line[13]\" style='display: block; margin: auto;'></li>\n";
        echo "<li>title:$line[2]</li><br>";
        echo "<li>destination:$line[3]</li><br>";
        echo "<li>days:$line[7]</li><br>\n";
        echo "<li>date:$line[8]</li><br>\n";
        echo "<li>time:$line[9]</li><br>\n";
        echo "<li>recomend:$line[10]</li><br>\n";
        echo "<li>comment:$line[11]</li><br>\n";
        echo "<li>updatetime:$line[16]</li><br>\n";
        echo "</div>";
        }
        ?>
</body>
</html>