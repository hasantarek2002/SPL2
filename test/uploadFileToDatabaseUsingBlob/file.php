
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8"/>
    <title>file upload</title>
</head>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
	Enter Problem name :
	<input type="text" name="problemName" required><br>
    Select question to upload:
    <input type="file" name="question" required><br>
    Select input file
    <input type="file" name="input" required><br>
    Select output file
    <input type="file" name="output" required><br>
    <input type="submit" value="upload" name="submit">
</form>

<a href="showUploadedFileList.php"> show file Lists in file table</a>

</body>
</html>

