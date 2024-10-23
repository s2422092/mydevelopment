<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>計算</title>
    <style>

    </style>
</head>
<body>
<?php
if (isset($_POST['math']))
    $math=htmlspecialchars($_POST['math']);
    if (is_numeric($math)) {
        echo"<p>2で割ると".($math/2)."です。</p>";
        echo"<p>3で割ると".($math/3)."です。</p>";
        echo"<p>4で割ると".($math/4)."です。</p>";
        echo"<p>5で割ると".($math/5)."です。</p>";
        echo"<p>6で割ると".($math/6)."です。</p>";
        echo"<p>7で割ると".($math/7)."です。</p>";
        echo"<p>8で割ると".($math/8)."です。</p>";
    } 
    
?>



<label for="math"></label>
<input id="math" name="math" placeholder="数字を入力してね">
<button type="subumit">実行</button>


</body>

</html>