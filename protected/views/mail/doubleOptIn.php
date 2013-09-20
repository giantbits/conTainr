<html>
<body>
<b>Thank you for your registration!</b><br>
<br>
Just one more step is required: activate your account. You can do that by opening this link in your favorite browser:<br>
<?php
$link = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $this->createUrl('/' . $_GET['code'], array('mode'=>'activate','ac'=>$hash->hash,'user'=>$user->id));
?>
<a href="<?php echo $link ?>"><?php echo $link ?></a><br>
<br>
-Board Game Basel Association
</body>
</html>