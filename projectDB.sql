drop database if exists projectDB;
create database projectDB;

use projectDB;

create table projectTBL(
	projectname char(12),
    intel char(12),
    phase char(12),
    employee char(36),
    deadline date
);

CREATE TABLE managerTBL (
    username VARCHAR(50) NOT NULL primary key ,
    password int(255) NOT NULL,
    emprank varchar(12) not null,
    department varchar(12) not null,
    email VARCHAR(100)
);
