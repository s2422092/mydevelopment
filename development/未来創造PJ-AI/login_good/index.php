<?php
if (empty($_SERVER['HTTPS'])) {
  header("location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  exit();
}
session_start();
if (isset($_SESSION['ems'])) {
  $ems=$_SESSION['ems'];
}
if (isset($_SESSION['pws'])) {
  $pws=$_SESSION['pws'];
}
if (isset($_POST['emf'])){$ems=$_POST['emf'];}
if (isset($_POST['pwf'])){$pws=$_POST['pwf'];}
$aflag=0;
if (isset($ems) &&isset($pws)){
  $sql="select * from phpua where email='". $ems . "';";
  $dbconn = pg_connect("host=localhost dbname=s0000001 user=s0000001 password=XXXXXX")
    or die('Could not connect: ' . pg_last_error());
  $result = pg_query($sql) or die('Query failed: ' . pg_last_error());
  if(pg_num_rows($result)==1){
    $row = pg_fetch_row($result);
    if (password_verify($pws, $row[3])){
      $_SESSION['ems']=$ems;
      $_SESSION['pws']=$pws;
      $aflag=1;
    }
  }
}
if($aflag==0){
  header('location: ./login.html');
}

?>



<html>
<head>
  <title>
    login
  </title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">


</head>
<body>

<?php
 echo "<p>LOGIN SUCCEED: " . $ems . "</p>\n";
 echo "<p><a href=\"./logout.php\">LOGOUT</a>";
 ?>

</body>
</html>
