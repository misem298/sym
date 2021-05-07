# sym
localhost:8000/login - login as user -> to main page.
localhost:8000/admin - admin page for role admin only
localhost:8000/admin/user  control of users.

MySQL : 

create database symfony 

with tables:

create table user(
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(180) NOT NULL,
roles json NOT NULL,
password VARCHAR(255),
grupe logtext);

create table grupe (
d INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
grupe text);
