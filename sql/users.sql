CREATE DATABASE Users;
USE Users;

CREATE TABLE USER_MAIL (
prenom varchar(20),
nom varchar(20),
mail varchar(50),
mdp varchar(30),
datenaissance date,
sexe varchar(5),
constraint PK_USER primary key(mail),
check (lower(sexe) IN ('femme', 'homme'))
);


CREATE TABLE USER_TEL (
prenom varchar(20),
nom varchar(20),
tel decimal(10,0),
mdp varchar(30),
datenaissance date,
sexe varchar(5),
constraint PK_USER primary key(tel),
check (lower(sexe) IN ('femme', 'homme'))
);


insert into USER_TEL values('prenom','nom','0123456789','motdepasse','2002-10-21','femme');
insert into USER_MAIL values('prenom','nom','example@mail.com','motdepasse','2002-10-21','femme');


select * from user_tel;
select * from user_mail;

