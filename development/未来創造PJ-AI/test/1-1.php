<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クイズ</title>
    <style>
        /* 必要に応じてスタイルを追加 */
    </style>
</head>
<body>
<?php
if (isset($_POST['month']) && isset($_POST['date'])) {
    $month = htmlspecialchars($_POST['month']);
    $date = htmlspecialchars($_POST['date']);
    
    // 星座を判定する関数
    function getZodiacSign($month, $date) {
        if (($month == 3 && $date >= 21) || ($month == 4 && $date <= 19)) {
            return "おひつじ座";
        } elseif (($month == 4 && $date >= 20) || ($month == 5 && $date <= 20)) {
            return "おうし座";
        } elseif (($month == 5 && $date >= 21) || ($month == 6 && $date <= 20)) {
            return "ふたご座";
        } elseif (($month == 6 && $date >= 21) || ($month == 7 && $date <= 22)) {
            return "かに座";
        } elseif (($month == 7 && $date >= 23) || ($month == 8 && $date <= 22)) {
            return "しし座";
        } elseif (($month == 8 && $date >= 23) || ($month == 9 && $date <= 22)) {
            return "おとめ座";
        } elseif (($month == 9 && $date >= 23) || ($month == 10 && $date <= 22)) {
            return "てんびん座";
        } elseif (($month == 10 && $date >= 23) || ($month == 11 && $date <= 21)) {
            return "さそり座";
        } elseif (($month == 11 && $date >= 22) || ($month == 12 && $date <= 21)) {
            return "いて座";
        } elseif (($month == 12 && $date >= 22) || ($month == 1 && $date <= 19)) {
            return "やぎ座";
        } elseif (($month == 1 && $date >= 20) || ($month == 2 && $date <= 18)) {
            return "みずがめ座";
        } elseif (($month == 2 && $date >= 19) || ($month == 3 && $date <= 20)) {
            return "うお座";
        } else {
            return "無効な日付";
        }
    }

    $zodiac = getZodiacSign($month, $date);
    echo "<p>あなたの誕生日は{$month}月{$date}日です。星座は{$zodiac}です。</p>";
}
?>

<form method="POST" action="">
    <label for="birthday-month">誕生月:</label>
    <input class="birthday-month" id="month" name="month" type="number" required>

    <br>

    <label for="birthday-date">誕生日:</label>
    <input class="birthday-date" id="date" name="date" type="number" required>
    
    <button type="submit">実行</button>
</form>

</body>
</html>
