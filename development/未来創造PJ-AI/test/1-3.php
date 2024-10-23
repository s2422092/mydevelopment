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

if (isset($_POST['input'])){
    $select=htmlspecialchars($_PSOT['mono'])
    $money=htmlspecialchars($_POST['money'])
    $genre=htmlspecialchars($_POST['genre'])

    echo"<p>残金<p>";
    echo"<p>これまでの出納<p>";
    echo"<p>"($genre)""($select)"($money)<p>";
}
?>


<form method="POST" action="">

<div class="input">
    <select id="mono" name="mono" required>
        <option value="plue">収入</option>
        <option value="minus">支出</option>
    </select>
    

    <input id="money" type="number" name="money">
    <label>円

    </label>
    <br>

    <label for="genre">用途：</label>
    <input id="genre" name="genre" type="text">

    <button type="submit">完了</button>
</div>

</from>

</body>