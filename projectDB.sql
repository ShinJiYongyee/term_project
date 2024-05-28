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
insert into managerTBL values("sjy","1234","채찍질하는 감독관","백엔드 관리","back@gmail.com");
insert into projectTBL values ("게르마늄팔찌","팔찌 제작","예산확보","김삼식","2024-07-07");
