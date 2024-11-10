<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT USER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .main-body{
        padding: 2em;
        margin: auto;
        width: 50%;
      }
    </style>
</head>
<body>
<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
<div class="main-body">
<h1> EDIT THE USER DETAILS</h1>
<form>
    <div class="mb-3">
      <label for="first_name" class="form-label">First Name: </label>
      <input type="text" class="form-control" name="first_name" value="<?php echo $getUserByID['first_name'] ?>">
    </div>
    <div class="mb-3">
      <label for="last_name" class="form-label">First Name: </label>
      <input type="text" class="form-control" name="last_name" value="<?php echo $getUserByID['last_name'] ?>">
    </div>
    <div class="mb-3">
      <label for="date_of_birth" class="form-label">Birthdate: </label>
      <input type="date" class="form-control" name="date_of_birth" value="<?php echo $getUserByID['date_of_birth'] ?>">
    </div>
    <div class="mb-3">
      <label for="specialization" class="form-label">Specialization: </label>
      <input type="text" class="form-control" name="specialization" value="<?php echo $getUserByID['specialization'] ?>">
    </div>
    
    <button type="submit" class="btn btn-primary" name="editUserBtn">Submit</button>
    <a href="index.php" class="btn btn-danger"> Cancel</a>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>