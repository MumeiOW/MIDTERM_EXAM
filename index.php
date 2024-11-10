<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Dashboard</title>
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

		h1, h3 {
			color: var(--bs-primary);
		}

		/* Button customization */
		.btn-primary {
			background-color: var(--bs-primary);
			border-color: var(--bs-primary);
		}

		.btn-primary:hover {
			background-color: #a1e600;
			border-color: #a1e600;
		}

		.user-list {
			list-style: none;
			padding: 0;
		}
		.user-list li a {
			color: var(--bs-primary);
			text-decoration: none;
		}
		/* .user-list li a:hover {
			text-decoration: underline;
		} */

		.list-card{
			padding:20px;
			border: 1px
		}

		#a-view{
			color: white;
		}

		.a-secondary{
			background-color: #ffffff;
			color: #61b507;
			border-radius: 8px;
			padding: 8px 16px;
		}

		.a-secondary:hover {
			background-color: #aaaaaa;
			border-radius: 8px;
			color: #ffffff;
			border-radius: 8px;
			padding: 8px 16px;
		}
	</style>
</head>
<body class="container py-5">
	<div class="text-center">
		<?php if (isset($_SESSION['message'])) { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<?php echo $_SESSION['message']; ?>
			</div>
		<?php } unset($_SESSION['message']); ?>

		<?php if (isset($_SESSION['username'])) { ?>
			<h1>Hello, <b> <?php echo $_SESSION['username']; ?>! </b></h1>
			<a href="core/handleForms.php?logoutAUser=1" class="btn btn-primary mt-3">Logout</a>
		<?php } else { echo "<h1>No user logged in</h1>"; } ?>

		<h3 class="mt-5">Users List:</h3>
		<ul class="user-list mt-3">
			<?php $getAllUsers = getAllUsers($pdo); ?>
			<?php foreach ($getAllUsers as $row) { ?>
				<li class="mb-4">
					<div class="card shadow-sm border-10">
						<div class="card-header bg-success text-white text-center">
							Netword Admin No. <?php echo $row['user_id']; ?>
						</div>
						<div class="card-body text-center">
							<h3 class="card-title mb-3"><b><?php echo $row['username']; ?></b></h3>
							<div class="d-flex justify-content-center gap-2">
								<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-primary" id="a-view">View User Details</a>
								<a href="viewtasks.php?user_id=<?php echo $row['user_id']; ?>" class="a-secondary">View User Tasks</a>
							</div>
						</div>
					</div>
				</li>

			<?php } ?>
		</ul>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>