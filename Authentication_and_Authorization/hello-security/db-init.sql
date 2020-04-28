CREATE DATABASE IF NOT EXISTS `hello_security`;
use `hello_security`;

create table person (email varchar(255), firstname varchar(255), password varchar(255), role varchar(255));

INSERT INTO person (email, firstname, password, role) values ('asdf@asd', 'kir4o', '$2y$10$V/2fbvWLLiNKKGT3OxT8kOw9SwmKYzDkJxThkqI2e/tTCFMcXUb4i', 'student'); //pass
INSERT INTO person (email, firstname, password, role) values ('email@lll', 'k2', '$2y$10$HfqIc9ARVNPiaIxWvnTBM.Qshl8ZOs4FEYz.ApKFDvL3b.lD2sKZu', 'teacher'); //ddd

ALTER TABLE person 
MODIFY firstname varchar(255) NOT NULL;

ALTER TABLE person 
MODIFY password varchar(255) NOT NULL;

ALTER TABLE person 
MODIFY role varchar(255) NOT NULL;

ALTER TABLE person 
MODIFY email varchar(255) NOT NULL;

ALTER TABLE person
ADD UNIQUE (email);
 
