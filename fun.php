admin.php

<?php
session_start(); 

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "You are trying to access administrator functionality";
    exit; 
}
?>
<html>
<head>
<title>Secret admin site</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="/">Back</a>
<?php
if(isset($_COOKIE['logged_in'])) {
	if(!isset($_POST["submit"])) {
		echo "<form action=\"admin.php\" method=\"post\" enctype=\"multipart/form-data\">
		Select html file to upload: <br />
		Title of blog post: <input type=\"text\" name=\"title\" id=\"title\"><br/>
		Blog post html: <input type=\"file\" name=\"file\" id=\"file\"><br/>
		<input type=\"submit\" value=\"Upload Blog post\" name=\"submit\">
		</form>";
	} else {
		$target_dir = "dir/";
		$fileName = $_FILES["file"]["name"];
		$target_file = $target_dir . basename($fileName);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
	
		if ($_FILES["file"]["size"] > 500000) {
 			echo "Sorry, your file is too large.";
  			$uploadOk = 0;
		}

       		 if($imageFileType != "html" && $imageFileType != "htm" ) {
          		echo "Sorry, only HTML files are allowed.";
            		$uploadOk = 0;
        	}

		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {



				$user = "wilburwhateley";
				$password = "verysecuresqlpassword12321312312312";
				$database = "my_first_database";
				$table = "users";
				$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
				$newTitle = $_POST['title'];

				$stmt = $db->prepare("INSERT INTO my_first_database.blogs (blog_title, blog_file) VALUES (?, ?)");
                		$stmt->execute([$newTitle, $fileName]);

    				echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
  			} else {
	  			echo "Sorry, there was an error uploading your file.";
	  		}
		}
	}


} else { 

	echo "You are trying to access administrator functionality"; 

}
?>

</body>
</html>

backuplog.php
<?php
session_start();
?>
<html>

<head>
<title>Wilbur Whateley & co blog</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<a href="/">Back</a>
<h1>Wilbur Whateley & co blog</h1> 
<?php
if (isset($_GET['file'])) {
    $file = str_replace('..', '', $_GET['file']); 
    $filePath = 'dir/' . basename($file); 
    if (file_exists($filePath)) {
        echo file_get_contents($filePath);
    } else {
        echo "File not found.";
    }
}
else {
	echo "<ul>";
	echo "<li> <a href='/blog.php?file=dir/anatomy.html'>Human anatomy</a> </li> ";
	echo "<li> <a href='/blog.php?file=dir/completely_true_stuff.html'>Occult superstition</a></li> ";
	echo "<li> <a href='/blog.php?file=dir/non_fiction.html'>Fiction</a></li> ";
	echo "<li> <a href='/blog.php?file=dir/how_to_pass_as_human.html'>Applied method acting</a></li> ";
	echo "<li> <a href='/blog.php?file=dir/these_damn_fish_people.html'>Guide to stress free fishing</a></li> ";
	echo "<li> <a href='/blog.php?file=dir/top_5_places_to_summon_demons.html'>Top 5 travel destinations</a></li> ";
	echo "</ul>";	


	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
		echo "<h2>Admin operation</h2>";

		if (isset($_POST["submit"])){
			$fileTmpPath = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileType = $_FILES['file']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
			echo "file name $fileName, file tmppath $fileTmpPath, file size $fileSize";

	        	$allowed_file_extensions = ['html', 'htm'];
        		$allowed_mime_types = ['text/html'];
			$target_dir = "dir/";
			$target_file = $target_dir . basename($_FILES["file"]["name"]);
			$uploadOk = 1;
			
			if (!in_array($fileExtension, $allowed_file_extensions) || !in_array($fileType, $allowed_mime_types)) {
            			echo "Sorry, only HTML files are allowed.";
            			$uploadOk = 0;
        		}

			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			
			if ($_FILES["file"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
  				$uploadOk = 0;
			}

			if($uploadOk == 0){
				echo "Your file was not uploaded";
			} else {
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
					echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}

		}
		else {

		echo '
		<form method="post" action="blog.php" enctype="multipart/form-data" >
			<input type="file" name="file" id="file">
			  <input type="submit" name="submit">
		</form>';
		}
	}

}


?>

</body>
</html>

login.php
<html>
<head>
<title>Log in to deathtohumanity.ru.tv.biz</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<a href="/">Back</a>
<h1>Log in</h1> 
<p>Our login form is verified as being secured by my uncle Zadok</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  password: <input type="password" name="fpass">
  <input type="submit">
</form>


<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // collect value of input field
	$loginusername = $_POST['fname'];
	$loginpassword = $_POST['fpass'];
  	if (empty($loginusername) || empty($loginpassword)) {
    		echo "You need to supply some credentials.";
  	} else {
		$user = "wilburwhateley";
		$password = "verysecuresqlpassword12321312312312";
		$database = "my_first_database";
		$table = "users";
		$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "SELECT * FROM $table where user_name = '$loginusername' and password = '$loginpassword'";
		$statement = $db->prepare($query);
       		$statement->bindParam(':username', $loginusername, PDO::PARAM_STR);
        	$statement->bindParam(':password', $loginpassword, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
		if(!$result) {
			echo "<p>Invalid login information. If your login information is lost, please let me know by mail at 13 Barrow rd. Dunwich Massachusetts</p>"; 
			exit;
		} else {
			$userid = $result[0][0];
			$username = $result[0][1];
			$_SESSION['logged_in'] = true;
			setcookie("logged_in", $userid, time() + (86400 * 30), "/"); // 86400 = 1 day
			echo "<p> You are now logged in <strong>$username</strong></p>"; 
			echo "<p> You can now proceed to view your <a href='messages.php'>messages</a></p>";
		}
  	}
}
?>

</body>
</html>

blog.php
<html>
<head>
<title>Wilbur Whateley & co blog Made better by the cool kids</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<a href="/">Back</a>
<h1>Wilbur Whateley & co blog</h1> 
<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $file = file_get_contents($file);
    echo htmlspecialchars($file); // Sanitize output to prevent XSS
    echo '<br /><a href="/blog.php">Back to blog index</a>';
} else {
    $user = "wilburwhateley";
    $password = "verysecuresqlpassword12321312312312";
    $database = "my_first_database";
    $table = "blogs";
    $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
    $query = "SELECT * FROM $table";
    $statement = $db->prepare($query);
    $statement->execute();
    echo "<ul>";
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $href = $row['blog_file']; // Access columns by name
        $title = $row['blog_title']; // Access columns by name
        echo "<li> <a href='/blog.php?file=dir/" . htmlspecialchars($href) . "'>" . htmlspecialchars($title) . "</a> </li> ";
    }
    echo "</ul>";
}
?>
</body>
</html>