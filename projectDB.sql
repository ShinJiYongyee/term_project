drop database if exists projectDB;
create database projectDB;

use projectDB;

create table managerTBL(
	userID char(12) not null primary key,
    pw char(12) not null,
    name char(12),
    emprank char(12),
    department char(12),
    project char(12)
);

create table projectTBL(
	prjectname char(12),
    intel char(12),
    phase char(12),
    employee char(36),
    deadline date
);

