<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit();
}

$getUserByID = getUserByID($pdo, $_GET['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Details</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<style>
		/* Custom theme colors */
		:root {
			--bs-primary: #61b507;
			--bs-body-bg: #FAF9F6;
			--bs-body-color: #3d3d3d;
			--bs-border-color: #95cf00;
		}

		body {
			font-family: "Arial", sans-serif;
			background-color: var(--bs-body-bg);
			color: var(--bs-body-color);
		}

		h1 {
			color: var(--bs-primary);
		}

		.details-heading {
			font-size: 3rem;
		}

		/* Custom button styling */
		.btn-primary {
			background-color: var(--bs-primary);
			border-color: var(--bs-primary);
		}

		.btn-primary:hover {
			background-color: #a1e600;
			border-color: #a1e600;
		}
	</style>
</head>
<body class="container py-5">
	<div class="text-center">
		<h1 class="details-heading"><strong>User Details</strong></h1>
		
		<div class="mt-4">
			<h3>Username: <span class="text-muted"><?php echo htmlspecialchars($getUserByID['username']); ?></span></h3>
			<h3>First Name: <span class="text-muted"><?php echo htmlspecialchars($getUserByID['first_name']); ?></span></h3>
			<h3>Last Name: <span class="text-muted"><?php echo htmlspecialchars($getUserByID['last_name']); ?></span></h3>
			<h3>Date of Birth: <span class="text-muted"><?php echo htmlspecialchars($getUserByID['formatted_bday']); ?></span></h3>
			<h3>Specialization: <span class="text-muted"><?php echo htmlspecialchars($getUserByID['specialization']); ?></span></h3>
		</div>

		<a href="index.php" class="btn btn-primary mt-4">Back to Users List</a>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>