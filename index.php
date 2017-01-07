<?php

$answer = "post a photo";
if(isset($_POST['submit'])){
	$mydir = $_SERVER['DOCUMENT_ROOT'];
	$caption = $_POST['mycaption'];
	$tmp_name = $_FILES['myimage']['tmp_name'];
        $name = basename($_FILES['myimage']['name']);
	$timestamp=date('c');
        if(!move_uploaded_file($tmp_name, "$mydir/$timestamp$name")){
		die("move uploaded file from $tmp_name to $mydir/$name failed");
	}
	$fp = fopen("$mydir/flatfile", 'a');
	fwrite($fp, date('r') . "\t$timestamp$name\t$caption\n");
	fclose($fp);
	$answer = "got it, post another if you want";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>index.php</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h1><?php echo $answer; ?></h1>
<form action="#" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="myimage">Photo</label>
<input type="file" id="myimage" name="myimage" accept="image/*" capture value="take photo"><br>
</div>
<div class="form-group">
<label for="mycaption">caption: </label>
<input type="text" name="mycaption" id="mycaption" class="form-control"><br>
</div>
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
