<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
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

		.form-control {
			font-size: 1.2em;
			width: 100%;
			max-width: 300px; /* Limits input field width */
			margin-bottom: 15px;
			border: 1px solid var(--bs-border-color);
		}

		/* Button customization */
		.btn-primary {
			background-color: var(--bs-primary);
			border-color: var(--bs-primary);
			width: 300px;
		}

		.btn-primary:hover {
			background-color: #a1e600;
			border-color: #a1e600;
		}
	</style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
<div class="text-center">
    <h1>Register Here!</h1>

    <?php if (isset($_SESSION['message'])) { ?>
        <h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
    <?php } unset($_SESSION['message']); ?>
    
    <form action="core/handleForms.php" method="POST" class="mt-4">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="col-md-6">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" name="firstname" class="form-control" placeholder="First Name">
            </div>
            <div class="col-md-6">
                <input type="text" name="lastname" class="form-control" placeholder="Last Name">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <label for="dateofbirth" class="form-label">Date of Birth</label>
                <input type="date" name="dateofbirth" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="specialization" class="form-label">Specialization</label>
                <input type="text" name="specialization" class="form-control" placeholder="i.e: Network Administrator, Server Maintenance etc.">
            </div>
        </div>

        <button type="submit" name="registerUserBtn" class="btn btn-primary mt-3">Register</button>
    </form>
</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>