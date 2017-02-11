<?php

date_default_timezone_set('America/New_York');

$answer = "Post a photo";
if(isset($_POST['submit'])){
	$imgdir = $_SERVER['DOCUMENT_ROOT'] . '/images';
	$caption = $_POST['mycaption'];
	$tmp_name = $_FILES['myimage']['tmp_name'];
        $name = basename($_FILES['myimage']['name']);
	$timestamp=date('c');
	$fp = fopen('flatfile', 'a'); 
	fwrite($fp, date('r') . "\t$timestamp$name\t$caption\n");
	fclose($fp);
	$image = new ZBarCodeImage("$tmp_name");
	$scanner = new ZBarCodeScanner();
	$barcode = $scanner->scan($image);
	if (empty($barcode)) {
		$answer = "Didn't get a barcode. ";
	} else {
		foreach ($barcode as $code) {
			$thetype = $code['type'];
			$thecode = $code['data'];
			if(preg_match('/^http:/', $thecode)){
				$thecode = '<a href="' . $thecode . '" target="_blank">' . $thecode . '</a>';
			}
			$answer .= sprintf("Found type %s barcode with data %s<br>\n", $thetype, $thecode);
		}
	}
	$answer .= "<br>Post another if you want";
}	// end of submit

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Read a barcode</title>
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
