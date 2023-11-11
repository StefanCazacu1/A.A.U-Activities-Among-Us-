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
				<button class="signUp">Sign Up</button>
				<button class="login">Login</button>
			</div>
		</header>
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
	</body>
</html>
