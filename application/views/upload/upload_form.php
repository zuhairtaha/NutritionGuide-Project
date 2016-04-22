<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>upload</title>
</head>
<body>
<center>
<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input class="btn btn-info" type="submit" value="upload" />

</form>
</center>
</body>
</html>