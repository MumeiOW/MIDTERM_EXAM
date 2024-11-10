<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE USER</title>
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
<h3> ARE YOU SURE YOU WANT TO DELETE THIS USER?<span class="badge text-bg-secondary mb-5"> <?php echo $getUserByID['first_name'] . ' ' . $getUserByID['last_name'] ?> </span></h3>
<form action=""></form>  
  <div class="mb-3">
      <h3>Username: <?php echo $getUserByID['username'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>First Name: <?php echo $getUserByID['first_name'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>Last Name: <?php echo $getUserByID['last_name'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>Birthdate: <?php echo $getUserByID['date_of_birth'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>Specialization: <?php echo $getUserByID['specialization'] ?> </h3>
    </div>
    <form action="core/handleForms.php?user_id=<?php echo $_GET['user_id']; ?>" method="POST">
        <button type="submit" class="btn btn-success" name="deleteUserBtn">Confirm</button>
        <a href="index.php" class="btn btn-danger"> Cancel</a>
    </form>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>