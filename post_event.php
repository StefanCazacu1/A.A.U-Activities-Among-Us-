<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./styles/style.css" />
	<title>A.U.U.</title>
</head>

<body>
<?php
session_start();

// Include the file with the database connection function
include('db.php');

$title = $desc = $time = $location = '';
$title_error = $desc_error = $time_error = $location_error = '';
$image_errors = [];

$errorFlag = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = filter_input(INPUT_POST, 'title');
    $desc = filter_input(INPUT_POST, 'desc');
    $time = filter_input(INPUT_POST, 'time');
    $location = filter_input(INPUT_POST, 'location');

    if (empty($title)) {
        $title_error = 'Title is required';
    }
    if (empty($time)) {
        $time_error = "Time is required";
    }
    if (empty($location)) {
        $location_error = "Location is required";
    }

    // Check for image upload
    if (isset($_POST["submit"]) && !empty($_FILES["image"]['tmp_name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if (!$check) {
            $image_errors[] = "File is not an image.";
            $errorFlag = true;
        }

        if (file_exists($target_file)) {
            $image_errors[] = "Sorry, file already exists.";
            $errorFlag = true;
        }

        if ($_FILES["image"]["size"] > 50000000) {
            $image_errors[] = "Sorry, your file is too large.";
            $errorFlag = true;
        }

        if (
            $image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
            && $image_file_type != "gif"
        ) {
            $image_errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $errorFlag = true;
        }

        if (!$errorFlag) {
			if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				// File upload successful
		
				// Insert event post details into the database
				$conn = connectToDatabase();
				$thumbnail_path = htmlspecialchars(basename($_FILES["image"]["name"]));
		
				// Prepare the SQL statement
				$sql = "INSERT INTO posts (title, thumbnail, description, time, location) 
						VALUES ('$title', '$thumbnail_path', '$desc', '$time', '$location')";
		
				// Execute the SQL statement
				if ($conn->query($sql) === true) {
					echo "Event post added successfully.";
					$title = $desc = $time = $location = '';
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
		
				// Close the database connection
				closeDatabaseConnection($conn);
			} else {
				$image_errors[] = "Sorry, there was an error uploading your file.";
			}
		}
    }
}
?>
	<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data" id="postForm">
		<p class="input__wrapper">
			<label class="input__label" for="image">Thumbnail</label>
			<img src="" alt="thumbnail" id="thumbnail">
			<input class="input" type="file" accept="image/*" id="image" name="image">
			<span class="input__error">
				<?php
				foreach ($image_errors as $error) {
					echo $error;
				}
				?>
			</span>
		</p>
		<p class="input__wrapper">
			<label class="input__label" for="title">Title</label>
			<input class="input" type="text" id="title" name="title" value="<?php echo $title ?>">
			<span class="input__error"><?php echo $title_error ?></span>
		</p>
		<p class="input__wrapper">
			<label class="input__label" for="desc">Description(optional)</label>
			<input class="input" type="text" id="desc" name="desc" value="<?php echo $desc ?>">
			<span class="input__error"><?php echo $desc_error ?></span>
		</p>
		<p class="input__wrapper">
			<label class="input__label" for="time">Time</label>
			<input class="input" type="time" id="time" name="time" value="<?php echo $time  ?>">
			<span class="input__error"><?php echo $time_error ?></span>
		</p>
		<p class="input__wrapper">
			<label class="input__label" for="location">Location</label>
			<input class="input" type="text" id="location" name="location" value="<?php echo $location ?>">
			<span class="input__error"><?php echo $location_error ?></span>
		</p>
		<button type="submit" name="submit">Post</button>
	</form>

	<script src="./scripts/index.js"></script>
</body>

</html>