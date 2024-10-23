<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Blog</title>

    <!-- 引入 Leaflet 地图样式 -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
        }

        .sidebar {
            width: 15%;
            background-color: rgba(95, 167, 196, 0.406);
            padding: 50px 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar a {
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-size: 1.2em;
            margin: 20px 0;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: rgba(89, 170, 188, 0.67);
            color: #f0f0f0;
        }

        .sidebar a:active {
            background-color: #1E81B0;
        }

        .sidebar button.login-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: rgb(67,145,193);
            color: rgb(255, 255, 255);
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sidebar button.login-btn:hover {
            background-color: rgb(137, 110, 179);
            color: white;
        }

        .map-section {
            width: 85%;
            padding: 0px;
        }

        #map {
            width: 100%;
            height: 650px;
            margin-top: 0px;
            position: relative;
        }

        .header-image {
            width: 100%;
            height: 250px;
            background: url('https://images.pexels.com/photos/1108701/pexels-photo-1108701.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2') center center/cover no-repeat;
            background-size: cover;
            position: relative; 
        }

        .topbar {
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%);
            color: white; 
            font-size: 3em; 
            font-weight: bold; 
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); 
            z-index: 10; 
        }

        .fixed-popup {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            max-width: 300px;
            display: none;
        }
    </style>
</head>
<body>

    <div class="header-image">
        <div class="topbar">
            Tourist Blog——Timeline
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="mypage.php">マイページ</a>
            <a href="timeline001.php">タイムライン</a>
            <a href="edit.php">共有</a>
            <a href="nothing.">Nothing</a>
            <button class="login-btn" onclick="login()">ログアウト</button>
        </div>

        <div class="map-section">
            <div id="map"></div>
            <div id="fixed-popup" class="fixed-popup"></div>
        </div>
    </div>

    <script type="text/javascript">
    
        
        
        
        //function login() {
        //    window.location.href = 'login.php';
        //}
        //coast =c言語の変数宣言、同じ変数を使って、情報を変更することはできない
        //例えば、coast mapならmapという変数に、情報を格納している
        //<script>の中に、<php?>を入れれるので、この形で、繰り返し文を使えばいい
        //https://developer.mozilla.org/ja/docs/Web/JavaScript/Guide/Loops_and_iteration#while_文

        //var map = L.map('map');
        var map = L.map('map', {
center: [35.658099,139.741357],
zoom: 5, });

var tileLayer = L.tileLayer('https://osm.gdl.jp/styles/osm-bright/{z}/{x}/{y}.png', {
attribution: '&copy;<a href="http://osm.org/copyright"> OpenStreetMap</a> contributors, <a href="http:// creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
});
tileLayer.addTo(map);



//         var japanBounds = [
//             [45.551483, 153.986672], 
//             [20.425422, 122.93457]   
//         ];
// //https://qiita.com/yuskesuzki/items/eaa97766cefaa16fbec8
// //setmaxboundsは表示範囲の制限
//         map.setMaxBounds(japanBounds);
//         map.fitBounds(japanBounds, {
//             padding: [50, 50]
//         });
//         //表示する地図の中心緯度経度を指定し、ズームレベルも指定
//         map.setView([35.68, 139.76], 5);

//         map.options.minZoom = 4;
//         map.options.maxZoom = 12;

//         map.on('drag', function() {
//             //指定された範囲内のみで動かせるようカーソル移動を制限
//             map.panInsideBounds(japanBounds, { animate: true });
//         });

       
//ここをfor処理
//markettokyoのところに入れてDBに格納された観光地の数だけマーカーを作れるようにする
//複数マーカーの表示https://ktgis.net/service/leafletlearn/advanced.html#step15
        


        <?php
        $query = 'select * from memory;';
        //アカウント変更すること!
        $dbconn = pg_connect("host=localhost dbname=g2350003 user=g2350003 password=4HS45Gia") or die ('Could not Connect : ' . pg_last_error());
        $result = pg_query($query) or die('Query failed:' . pg_last_error());
        //下記whileで$lineの中の行の数だけ地図上のマーカーを作成&吹き出し内に表示する情報を設定
        while($line = pg_fetch_array($result)){
            echo "var m" . $line[0] . " = L.marker([" . $line[6] . "," . $line[5] . "]).addTo(map); ";
            echo "m" . $line[0] . ".bindPopup(\"" . $line[2] . "<br>" . $line[3] . "<br>" . $line[8] .  "<br>" . 
            "<button type=\\\"button\\\" onclick=\\\"location.href='http://maps.apple.com/maps?q=$l[1],$l[0]'\\\">seemore</button>\").openPopup();";
            
        }
        


        ?>
        
    </script>

</body>
</html>
