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
	projectname char(12),
    intel char(12),
    phase char(12),
    employee char(36),
    deadline date
);

insert into projectTBL values ("게르마늄팔찌","팔찌 제작","예산확보","김삼식","2024-07-07")
