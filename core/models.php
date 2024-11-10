<?php  
require_once 'dbConfig.php';

function insertNewUser($pdo, $username, $password, $firstname, $lastname, $dateofbirth, $specialization) {

    $checkUserSql = "SELECT 
		users.user_id,
		users.username,
		users.password,
		users.first_name,
		users.last_name,
		users.date_of_birth,
		users.date_created,
		network_admins.specialization,
		network_admins.date_of_hiring
	FROM 
		users
	JOIN 
		network_admins ON users.user_id = network_admins.user_id WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() == 0) {
     
        $sql = "CALL add_user_with_network_admins(?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
   
        $executeQuery = $stmt->execute([
            $username,
            $password,
            $firstname,
            $lastname,
            $dateofbirth,
            $specialization
        ]);

        if ($executeQuery) {
            $_SESSION['message'] = "User and network admin successfully inserted";
            return true;
        } else {
            $_SESSION['message'] = "An error occurred in the query";
            return false;
        }
    } else {
        $_SESSION['message'] = "User already exists";
        return false;
    }
}


function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM users WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		} else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	} else {
		$_SESSION['message'] = "Username doesn't exist in the database. You may consider registration first";
	}
}

function getAllUsers($pdo) {
	$sql = "SELECT 
		users.user_id,
		users.username,
		users.password,
		users.first_name,
		users.last_name,
		users.date_of_birth,
		DATE_FORMAT(users.date_of_birth, '%M %d, %Y') AS formatted_bday,
		users.date_created,
		network_admins.specialization,
		network_admins.date_of_hiring,
		DATE_FORMAT(network_admins.date_of_hiring, '%M %d, %Y') AS formatted_hire
	FROM 
		users
	JOIN 
		network_admins ON users.user_id = network_admins.user_id;
	";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT 
		users.user_id,
		users.username,
		users.password,
		users.first_name,
		users.last_name,
		users.date_of_birth,
		DATE_FORMAT(users.date_of_birth, '%M %d, %Y') AS formatted_bday,
		users.date_created,
		network_admins.specialization,
		network_admins.date_of_hiring,
		DATE_FORMAT(network_admins.date_of_hiring, '%M %d, %Y') AS formatted_hire
	FROM 
		users
	JOIN 
		network_admins ON users.user_id = network_admins.user_id
	WHERE 
		users.user_id = ?;
	";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function updateUser($pdo, $first_name, $last_name, 
	$date_of_birth, $specialization, $network_admin_id) {

	$sql = "UPDATE users 
		JOIN network_admins ON users.user_id = network_admins.user_id
		SET users.first_name = ?,
			users.last_name = ?,
			users.date_of_birth = ?,
			network_admins.specialization = ?
		WHERE network_admins.net_admin_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$first_name, $last_name, 
	$date_of_birth, $specialization, $network_admin_id]);
	
	if ($executeQuery) {
		return true;
	}

}

function deleteUser($pdo, $user_id) {
	$deleteUser = "DELETE FROM users WHERE user_id = ?";
	$deleteStmt = $pdo->prepare($deleteUser);
	$executeDeleteQuery = $deleteStmt->execute([$user_id]);

	if ($executeDeleteQuery) {
			return true;
	}
}


function viewAllUserInfo($pdo, $user_id){
	$sql = "
        SELECT 
            u.user_id,
            u.username,
            u.first_name,
            u.last_name,
            u.date_of_birth,
            u.date_created,
            na.specialization,
            na.date_of_hiring,
            t.task_id,
            t.task_name,
            t.technologies_used,
            t.start_of_task,
            t.end_of_task,
			DATE_FORMAT(u.date_of_birth, '%M %d, %Y') AS formatted_bday,
			DATE_FORMAT(na.date_of_hiring, '%M %d, %Y') AS formatted_hire
        FROM users u
        LEFT JOIN network_admins na ON u.user_id = na.user_id
        LEFT JOIN tasks t ON na.net_admin_id = t.net_admin_id
        ORDER BY u.user_id;
    ";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getTasksByUser($pdo, $user_id){
	$sql = "
        SELECT 
            t.task_id,
            t.task_name,
            t.technologies_used,
            t.start_of_task,
            t.end_of_task,
			DATE_FORMAT(t.start_of_task, '%M %d, %Y') AS formatted_start,
    		COALESCE(DATE_FORMAT(t.end_of_task, '%M %d, %Y'), 'TBA') AS formatted_finish
        FROM tasks t
        INNER JOIN network_admins na ON t.net_admin_id = na.net_admin_id
        INNER JOIN users u ON na.user_id = u.user_id
        WHERE u.user_id = :user_id
        ORDER BY t.start_of_task DESC;
    ";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([':user_id' => $user_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getTaskById($pdo, $task_id){
	$sql = "SELECT 
		t.task_id,
		t.task_name,
		t.technologies_used,
		t.start_of_task,
		t.end_of_task,
		DATE_FORMAT(t.start_of_task, '%M %d, %Y') AS formatted_start,
    	COALESCE(DATE_FORMAT(t.end_of_task, '%M %d, %Y'), 'TBA') AS formatted_finish,
		na.net_admin_id,
		na.specialization,
		u.user_id,
		u.username,
		u.first_name,
		u.last_name
	FROM tasks t
	INNER JOIN network_admins na ON t.net_admin_id = na.net_admin_id
	INNER JOIN users u ON na.user_id = u.user_id
	WHERE t.task_id = :task_id;
	";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([':task_id' => $task_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function addTask($pdo, $task_name, $technologies_used, $start_of_task, $end_of_task,$net_admin_id){
	if (empty($date_finished)) {
        $date_finished = null; 
    }
	$sql = "INSERT INTO tasks (task_name, technologies_used, start_of_task, end_of_task, net_admin_id) VALUES (?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$task_name, $technologies_used, $start_of_task, $end_of_task,$net_admin_id]);
	if ($executeQuery) {
		return true;
	}
}

function updateTask($pdo, $task_name, $technologies_used, $start_of_task, $end_of_task, $task_id){
	if(empty($date_finished)){
		$date_finished = null;
	}

	$sql = "UPDATE tasks
			SET task_name = ?,
				technologies_used = ?,
				start_of_task = ?,
				end_of_task = ?
			WHERE task_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$task_name, $technologies_used, $start_of_task, $end_of_task, $task_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteTask ($pdo, $task_id){
	$sql = "DELETE FROM tasks WHERE task_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$task_id]);
	if ($executeQuery) {
		return true;
	}
}

?>