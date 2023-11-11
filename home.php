<?php
include('db.php');

$events = getEvents();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="headerContainer">
		<header>
			<div class="searchAndCity">
				<button class="button1">Search events</button>
				<button class="button2">City</button>
			</div>
			<div class="signUpLogIn">
				<a href="signup.php">Sing in</a>
				<a href="login.php">Login</a>
			</div>
		</header>
		<div><h1>This is where the events will be showed</h1></div>
		<?php
    while ($row = $events->fetch_assoc()) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Time: " . $row['time'] . "</p>";
        echo "<p>Location: " . $row['location'] . "</p>";
        echo "<img src='uploads/" . $row['thumbnail'] . "' alt='thumbnail'>";
        echo "</div>";
    }
    ?>
		</div>
		<div id="calendar">
			<table>
				<thead>
					<tr>
						<th>Sun</th>
						<th>Mon</th>
						<th>Tue</th>
						<th>Wed</th>
						<th>Thu</th>
						<th>Fri</th>
						<th>Sat</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>

		<script src="./scripts/index.js"></script>
		<script>
    // Automatically refresh the page every 30 seconds
    setInterval(function () {
        location.reload();
    }, 30000); // 30,000 milliseconds = 30 seconds
</script>
	</body>
</html>
