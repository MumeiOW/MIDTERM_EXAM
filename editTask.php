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
        <a href="viewtasks.php?user_id=<?php echo $_GET['user_id']; ?>"> Return to View All Tasks</a>

        <h1> UPDATE TASKS DETAILS</h1>

        <div class="mb-5">
        <?php $getTaskById = getTaskById($pdo, $_GET['task_id']); 
        ?>
            <form action="core/handleForms.php?task_id=<?php echo $_GET['task_id']; ?>
	&user_id=<?php echo $_GET['user_id']; ?>" method="POST">
                <div class="mb-2">
                    <label for="Task_name" class="form-label">Task Name: </label>
                    <input type="text" class="form-control" name="task_name" value="<?php echo $getTaskById[0]['task_name'] ?>" required>
                </div>
                <div class="mb-2">
                    <label for="technologies_used" class="form-label">Technologies used: </label>
                    <input type="text" class="form-control" name="technologies_used" value="<?php echo $getTaskById[0]['technologies_used'] ?>" required> 
                </div>
                <div class="mb-2">
                    <label for="start_of_task" class="form-label">Start of Task: </label>
                    <input type="date" class="form-control" name="start_of_task" value="<?php echo $getTaskById[0]['start_of_task'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="end_of_task" class="form-label">End of Task: </label>
                    <input type="date" class="form-control" name="end_of_task" value="<?php echo $getTaskById[0]['end_of_task'] ?>">
                </div>
            <button type="submit" class="btn btn-primary" name="editProjectBtn">Submit</button>
        </form>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>