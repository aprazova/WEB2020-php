CREATE DATABASE IF NOT EXISTS `university` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `universitySystem`;

CREATE TABLE electives (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(128),
  description VARCHAR(1024),
  lecturer VARCHAR(128)
);

INSERT INTO electives (title, description, lecturer)
VALUES
  ("Programming with Go", "Let's learn Go", "Nikolay Batchiyski"),
  ("AKDU", "Let's Graduate", "Svetlin Ivanov"),
  ("Web technologies", "Let's learn the web", "Milen Petrov");
 
 ALTER  TABLE electives 
   ADD Column created_at timestamp NOT NULL DEFAULT current_timestamp ;
