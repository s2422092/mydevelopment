<?php
        session_start();
        if(!isset($_SESSION['uid'])){
            header('Location: login.php');
        }
?>
<!DOCTYPE html>
<html>
<style>
            #header {
            box-sizing: border-box;
            background: rgb(134, 248, 21,0.6);
            height: 50px;
            }
            #humberger {
            position: relative;
            height: 25px;
            width: 28px;
            display: inline-block;
            box-sizing: border-box;
            margin: 10px;
            transform: translateY(-230%);
            }
            #humberger div {
            position: absolute;
            left: 0;
            height: 2px;
            width: 28px;
            background-color: green;
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

            .navbar-nav {
            padding: 0;
            }

            .nav-item {
            background-color: rgb(67,145,193,0.5);
            font-size: 30px;
            text-align: center;
            margin-bottom: 15px;
            margin-top: 15px;
            color: black;
            border: 3px solid rgb(134, 248, 21);
            border-radius: 10px;
            {
            text-decoration: none;
            color: #000000;
            }
            }
            .offcanvas-title{
            background-color: rgb(67,145,193);
            color: white;
            border-radius: 10px;
            border: 3px solid rgb(134, 248, 21);
            }
            .mypage{
            text-align: center;
            }

            .timeline-link {
            position: absolute; /* 画面上の絶対位置に配置 */
            top: 5px; /* 上からの距離 */
            right: 5px; /* 右からの距離 */
        }

        .timeline-link a {
            display: inline-block; /* リンクをブロックにして padding と border を適用 */
            padding: 10px 20px; /* ボタンの内側の余白 */
            background-color: #007bff; /* 背景色 */
            color: #fff; /* 文字色 */
            border-radius: 5px; /* 角を丸める */
            text-decoration: none; /* 下線を消す */
            font-size: 16px; /* フォントサイズ */
            transition: background-color 0.3s; /* ホバー時の背景色変化を滑らかに */
        }

        .timeline-link a:hover {
            background-color: #0056b3; /* ホバー時の背景色 */
        }
        .input {
            margin: 0 auto;
            width: 50%;
            padding: 20px;
            background-color:rgb(171, 199, 222);
            border-radius: 10px;
            border: 3px solid black;
        }
        label {
            color: white; /* 赤色の例 */
            font-weight: bold; /* 太字の例 */
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        input[type="file"]{
            margin-bottom: 10px; /* 各フィールド間のスペース */
            padding: 5px; /* 内側の余白 */
        }
        .map {
            margin: 0 auto;
            width: 50%;
            padding: 20px;
            background-color:rgb(171, 199, 222);
            border-radius: 10px;
            border: 3px solid black;
        }
        input{
            border-radius: 10px;
        }

</style>
    <header id="header">

        <title>Edit</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <div class="mypage">
            <h1>マイページ</h1>
        </div>
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
              <h1 class="offcanvas-title" id="offcanvasLabel">Tourist Blog——edit</h1>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="./edit.php">マイページ</a></li>
                    <li class="nav-item"><a href="./timeline001.php">タイムライン</a></li>
                    <li class="nav-item"><a href="./edit.html">共有</a></li>
                    <li class="nav-item"><a href="#">option</a></li>
                    <li class="nav-item"><a href="./search.php">search</a></li>
                  </ul>
            </div>
        </div>
   
    <body>
    <div class="timeline-link">
        <a  href="timeline001.php">戻る</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <form class="input" action = './edit.php' method="POST">
        
    <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Title">
        <br>
        <label for="dest">Destination</label>
        <input type="text" id="dest" name="dest" placeholder="Locationで検索をかけてください" readonly>
        <br>
        <label for="day">Days</label>
        <input type="number" id="day" name="days" min="1" max="30" value="1" placeholder="Days">
        <br>
        <label for="date">Date</label>
        <input type="date" id="date" name="date" placeholder="Date">
        <br>
        <label for="time">Time</label>
        <input type="time" id="time" name="time" placeholder="Time">
        <br>
        <label for="recommend">Recommend</label>
        <input type="number" id="recommend" name="recommend" min="1" max="5" value="1" placeholder="Recommend">
        <br>
        <label for="comment">Comment</label>
        <input type="text" id="comment" name="comment" placeholder="Comment">
        <br>
        <label for="picture">Picture</label>
        <input type="file" id="picture" name="picture" placeholder="Picture">
        <br>
        <input type="hidden" id="latlng" name="latlng" readonly>
        <input type="hidden" id="latitude" name="lat" readonly>
        <input type="hidden" id="longitude" name="lng" readonly>
        <input type="submit" value="Send">
    </form>
    <div class="map">
        location
        <input type="text" id="location" placeholder="Location">
        <button id = 'Search'>Search</button>
        <br>
        <div id="map" style="width: 65%; height: 400px;"></div>
        <script>
            // APIキーの認証
            (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyB22Eiq7so8BCpWZyt2Ay0gw-S9gP52wq4",
            v: "weekly",
              // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
              // Add other bootstrap parameters as needed, using camel case.
            });
        </script>

        <script>
            // 変数の定義
            let map;
            let marker;

            // マップ表示のFunction
            async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker"); 

            let target = document.getElementById("map");
            let MapOptions = {
                center: { lat: 37.68123620000001, lng: 139.7671248 },
                zoom: 5,
                mapId: "72549cff77fc8d63",
            };

            map = new Map( target, MapOptions );

            document.getElementById("Search").addEventListener("click", function() {
                let place = document.getElementById("location").value;
                document.getElementById("dest").value = place;
                let geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    address: place
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                    let bounds = new google.maps.LatLngBounds();

                    for (var i in results) {
                        if (results[0].geometry) {
                        // 緯度経度を取得
                        let latlng = results[0].geometry.location;
                        let lat = latlng.lat();
                        let lng = latlng.lng();
                        document.getElementById("latlng").value = latlng;
                        document.getElementById("latitude").value = lat;
                        document.getElementById("longitude").value = lng;
                        console.log(latlng.lat(), latlng.lng());
                        // 住所を取得
                        let address = results[0].formatted_address;
                        // 検索結果地が含まれるように範囲を拡大
                        bounds.extend(latlng);
                        // マーカーを設置
                        setMarker(latlng);
                        }
                    }
                } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                alert("見つかりません");
                    } else {
                console.log(status);
                alert("エラー発生");
                    }
                });
            })};

            function setMarker(setplace) {
                deleteMarker();

                marker = new google.maps.marker.AdvancedMarkerElement({
                    position: setplace,
                    map,
                });
            }

            function deleteMarker() {
                if (marker != null) {
                    marker.setMap(null);
                }
                marker = null;
            }

            initMap();
        </script>
    </div>
        <?php
        // 変数の初期化
        $_title = '';
        $_destination = '';
        $_location = '';
        $_lat = '';
        $_lng = '';
        $_days = '';
        $_date = '';
        $_time = '';
        $_recommend = '';
        $_comment = '';
        $_picture = '';

        $dbconn = pg_connect("host = localhost dbname = s_yugo user = s_yugo password = 9fjrtvAy") or die ('Could not Connect : ' . pg_last_error());

        // DB接続確認ログ
        // print_r('DB接続成功 <br>');

        // 変数の定義
        $_uid=$_SESSION['uid'];
        $_title = (String)$_POST['title'];
        $_destination = $_POST['dest'];
        $_location = $_POST['latlng'];
        $_lat = (float) $_POST['lat'];
        $_lng = (float) $_POST['lng'];
        $_days = (int) $_POST['days'];
        $_date = $_POST['date'];
        $_time = $_POST['time'];
        $_recommend = (int) $_POST['recommend'];
        $_comment = $_POST['comment'];
        $_updatetime = date("Y-h-d H:i:s");
        $_picture = $POST['picture'];

        //DB挿入用ログ
        print($_uid . '<br>' . $_title . '<br>' .$_lat . '<br>' . $_lng . '<br>' . $_days . '<br>' . $_date . '<br>' . $_time . '<br>' . $_recommend . '<br>' . $_comment . '<br>' . $_updatetime . '<br>' . $_picture);

        //DB insert
        if (isset($_title) && isset($_lat) && isset($_lng)) {
            $query="insert into memory(uid,title,location,destination,lat,lng,days,date,time,recomend,comment,updatetime) values('$_uid','$_title','$_location','$_destination','$_lat','$_lng','$_days','$_date','$_time','$_recommend','$_comment','$_updatetime')";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());

            // DB insertログ
            // print_r($result);
            
            unset($_lat);
            unset($_lng);
        }        
        ?>

    </body>

</html>