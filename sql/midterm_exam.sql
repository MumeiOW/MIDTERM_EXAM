SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user_with_network_admins` ( in p_username varchar(50), in p_password varchar(100), in p_first_name varchar(50), in p_last_name varchar(50), in p_date_of_birth date, in p_specialization varchar(50))   BEGIN

    DECLARE last_user_id INT;

    INSERT INTO users (username, password, first_name, last_name, date_of_birth, date_created)
    VALUES (p_username, p_password, p_first_name, p_last_name, p_date_of_birth, CURRENT_TIMESTAMP);

    SET last_user_id = LAST_INSERT_ID();

    INSERT INTO network_admins (user_id, specialization, date_of_hiring)
    VALUES (last_user_id, p_specialization, CURRENT_TIMESTAMP);
END$$

DELIMITER ;


CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `technologies_used` varchar(255) NOT NULL,
  `net_admin_id` int(11) DEFAULT NULL,
  `start_of_task` date NOT NULL,
  `end_of_task` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `network_admins` (
  `net_admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `date_of_hiring` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `fk_net_admin_id` (`net_admin_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `network_admins`
  ADD PRIMARY KEY (`net_admin_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);



ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `network_admins`
  MODIFY `net_admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_net_admin_id` FOREIGN KEY (`net_admin_id`) REFERENCES `net_admins` (`net_admin_id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `network_admins`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

