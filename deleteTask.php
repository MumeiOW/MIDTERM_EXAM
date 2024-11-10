<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE PROJECT</title>
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
<?php $getTaskById = getTaskById($pdo, $_GET['task_id']); ?>
<div class="main-body">
<h3> ARE YOU SURE YOU WANT TO DELETE THIS TASK?  <span class="badge text-bg-secondary mb-5"> <?php echo $getTaskById[0]['task_name'] ?> </span></h3>
    <div class="mb-3">
      <h3>Username: <?php echo $getProjectById[0]['task_name'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>First Name: <?php echo $getProjectById[0]['technologies_used'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>Last Name: <?php echo $getProjectById[0]['formatted_start'] ?> </h3>
    </div>
    <div class="mb-3">
      <h3>Birthdate: <?php echo $getProjectById[0]['formatted_finish'] ?> </h3>
    </div>
    
    <form action="core/handleForms.php?task_id=<?php echo $_GET['task_id']; ?>&user_id=<?php echo $_GET['user_id']; ?>" method="POST">
        <button type="submit" class="btn btn-success" name="deleteProjectBtn">Confirm</button>
        <a href="viewtasks.php?user_id=<?php echo $_GET['user_id']; ?>" class="btn btn-danger"> Cancel</a>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>