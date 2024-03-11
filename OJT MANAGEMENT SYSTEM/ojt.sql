SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `ojtsys`

-- Table structure for table `request`
CREATE TABLE `request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `request_status` varchar(11) NOT NULL,
  `request_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`request_id`),
  KEY `stu_id` (`stu_id`),
  KEY `supervisor_id` (`supervisor_id`),
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`stu_id`) REFERENCES `students` (`stu_id`),
  CONSTRAINT `request_ibfk_2` FOREIGN KEY (`supervisor_id`) REFERENCES `supervisors` (`supervisor_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `students`
CREATE TABLE `students` (
  `stu_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `firstname` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `middlename` varchar(55) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `year_level` varchar(30) NOT NULL,
  `course` varchar(255) NOT NULL,
  `department` varchar(55) NOT NULL,
  `duty_Status` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`stu_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `student_info_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `supervisors`
CREATE TABLE `supervisors` (
  `supervisor_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `position` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `profile_pic` mediumblob NOT NULL,
  PRIMARY KEY (`supervisor_info_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `tasks`
CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_type` varchar(100) NOT NULL,
  `trainee_id` int(11) NOT NULL,
  `tine_in` int(11) NOT NULL,
  `tine_out` int(11) NOT NULL,
  `placed_at` varchar(100) NOT NULL,
  PRIMARY KEY (`task_id`),
  KEY `task_ibfk_1` (`trainee_id`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`trainee_id`) REFERENCES `trainee` (`trainee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `tasks_photos`
CREATE TABLE `tasks_photos` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_file` mediumblob NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `tasks_photos_ibfk_1` (`task_id`),
  CONSTRAINT `tasks_photos_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `trainee`
CREATE TABLE `trainee` (
  `trainee_id` int(11) NOT NULL AUTO_INCREMENT,
  `stu_id` int(11) NOT NULL,
  `supervisor_info_id` int(11) NOT NULL,
  PRIMARY KEY (`trainee_id`),
  KEY `trainee_ibfk_1` (`stu_id`),
  KEY `trainee_ibfk_2` (`supervisor_info_id`),
  CONSTRAINT `trainee_ibfk_1` FOREIGN KEY (`stu_id`) REFERENCES `students` (`stu_id`),
  CONSTRAINT `trainee_ibfk_2` FOREIGN KEY (`supervisor_info_id`) REFERENCES `supervisors` (`supervisor_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table structure for table `users`
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indexes for dumped tables

-- AUTO_INCREMENT for dumped tables
ALTER TABLE `request` MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `students` MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `supervisors` MODIFY `supervisor_info_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tasks` MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `tasks_photos` MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `trainee` MODIFY `trainee_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

-- Constraints for dumped tables
-- (Already included in the table structure statements above)

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
