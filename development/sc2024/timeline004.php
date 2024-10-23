<?php
    session_start();
    if (!isset($_SESSION['uid'])) {
        header('Location: login.php');

    }
?>
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
            background-color: rgb(134, 248, 21,0.75);
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
            border: 2px solid white;
        }

        .sidebar a:active {
            background-color: #1E81B0;
        }

        .sidebar button.login-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: rgb(67,145,193);
            color: rgb(255, 255, 255);
            border: 2px solid white;
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
            <a href="edit.php">マイページ</a>
            <a href="timeline001.php">タイムライン</a>
            <a href="share.php">共有</a>
            <a href="nothing.">Nothing</a>
            <button class="login-btn" onclick="login()">ログアウト</button>
        </div>

        <div class="map-section">
            <div id="map"></div>
            <div id="fixed-popup" class="fixed-popup"></div>
        </div>
    </div>

    <script>
        function login() {
            window.location.href = 'login.php';
        }
        
        const map = L.map('map');

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            detectRetina: true,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const japanBounds = [
            [45.551483, 153.986672], 
            [20.425422, 122.93457]   
        ];

        map.setMaxBounds(japanBounds);
        map.fitBounds(japanBounds, {
            padding: [50, 50]
        });
        map.setView([35.68, 139.76], 5);

        map.options.minZoom = 4;
        map.options.maxZoom = 12;

        map.on('drag', function() {
            map.panInsideBounds(japanBounds, { animate: true });
        });

        const popups = {
            'Tokyo': '<b>关東——東京の春🌸</b><br />春が訪れると、幻想的な桜の季節が訪れ、東京はピンク色の影で覆われる。 桜が満開になるこの短い期間、花見はこの季節ならではの楽しみとなり、とても魅力的だ。<br /><img src="https://encrypted-tbn1.gstatic.com/licensed-image?q=tbn:ANd9GcR-PAs-xo5IFyV4eq49M4GqIEb-G4BsNGRWT-jPkMRg8Xt3085w5BJMVgznVicDkzmj2yORZTwJwaQyybGnQZnL5VfrBtqyzSnIGhuyrg" alt="Tokyo" width="300">',
            'Okinawa': '<b>沖繩——那霸の夏🌊</b><br />美しい海に囲まれた沖縄の亜熱帯の夏の気候。 滝巡りやビーチ、サンゴ礁、マングローブ湿地帯の散策が最適だ。<br /><img src="https://visitokinawajapan.com/wp-content/themes/visit-okinawa_multi-language/lang/zh-hant/assets/img/de28_kv_tokashiki-view-scenery.webp" alt="Okinawa" width="300">',
            'Osaka': '<b>关西——京都の秋🍂</b><br />秋には燃えるようなモミジが京都を彩る。歴史的な名所が多く、秋の観光に最適。<br /><img src="https://www.kkday.com/zh-hk/blog/wp-content/uploads/Japan_Maple_Ashutterstock_418674916-scaled.webp" alt="Osaka" width="300">',
            'Sapporo': '<b>北海道——札幌の冬❄️</b><br />冬のアクティビティが盛んで、1月-2月は「さっぽろ雪まつり」が開催される。<br /><img src="https://d2r4787i3zn8dn.cloudfront.net/site_images/images/569fc9d982557a9cdcfea6c3c1ee4aef345686f6.jpg?1512088224" alt="Sapporo" width="300">'
        };

        const markerTokyo = L.marker([35.68, 139.76]).addTo(map);
        const markerOkinawa = L.marker([26.178649082561982, 127.83175984396934]).addTo(map);
        const markerOsaka = L.marker([34.587934157573876, 135.3314487835682]).addTo(map);
        const markerSapporo = L.marker([43.05514553019923, 141.3522908937992]).addTo(map);

        function updatePopupContent(content) {
            const popupDiv = document.getElementById('fixed-popup');
            popupDiv.innerHTML = content;
            popupDiv.style.display = 'block';
        }

        markerTokyo.on('click', function() {
            updatePopupContent(popups['Tokyo']);
        });

        markerOkinawa.on('click', function() {
            updatePopupContent(popups['Okinawa']);
        });

        markerOsaka.on('click', function() {
            updatePopupContent(popups['Osaka']);
        });

        markerSapporo.on('click', function() {
            updatePopupContent(popups['Sapporo']);
        });
    </script>

</body>
</html>
