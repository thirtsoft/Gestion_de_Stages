create database if not exists gestion_stagiaire;

use gestion_stagiaire;

create table filiere(
    idFiliere int(4) auto_increment primary key,
    nomFiliere varchar(50),
    niveau varchar(50)
);

create table stagiaire(
    idStagiaire int(4) auto_increment primary key,
    nom varchar(50),
    prenom varchar(50),
    civilite varchar(50),
    photo varchar(100),
    idFiliere int(4)
);

create table projet(
    idProjet      int(4) auto_increment primary key,
    intitule      varchar(50),
    description   text,
    renumeration  varchar(50),
    date_debut    varchar(50),
    date_fin      varchar(50),
    idStagiaire   int(4),
    idEncadrant   int(4)
);
alter table projet add constraint foreign key(idStagiaire) references stagiaire(idStagiaire);
alter table projet add constraint foreign key(idEncadrant) references encandrant(idEncadrant);

create table encandrant(
    idEncadrant   int(4) auto_increment primary key,
    civilite      varchar(50),
    nom           varchar(50),
    prenom        varchar(50),
    grade         varchar(50),
    email         varchar(50),
    photo         varchar(100)   
);

create table structure(
    idStructure   int(4) auto_increment primary key,
    nom           varchar(50),
    adresse       varchar(50),
    telephone     varchar(50),
    siteWeb       varchar(50),
    effectif      int,
    idStagiaire   int(4)   
);

alter table structure add constraint foreign key(idStagiaire) references stagiaire(idStagiaire);

create table utilisateur(
    idUtilisateur int(4) auto_increment primary key,
    login varchar(50),
    email varchar(50),
    role varchar(50),
    etat int(1),
    password varchar(255)
);

alter table stagiaire add constraint foreign key(idFiliere) references filiere(idFiliere);

insert into filiere(nomFiliere,niveau) values
    ('TSDI','TS'),
    ('TSGE','TS'),
    ('TGI','T'),
    ('TSRI','TS'),
    ('TSRI','TS'),
    ('TCE','T'),
    ('TSDI', 'TS'),
    ('TSGE', 'TS'),
    ('TGI', 'T'),
    ('TSRI', 'TS'),
    ('TSMI', 'TS'),
    ('TCE', 'T'),
    ('TSDI','TS'),
    ('TSGE','TS'),
    ('TGI','T'),
    ('TSRI','TS'),
    ('TSRI','TS'),
    ('GL', 'MASTER'),
    ('DBA','MASTER'),
    ('BI', 'MASTER'),
    ('DEV','LICENCE'),
    ('ANALYSTE','LICENCE'),
    ('PROG','LICENCE');

insert into utilisateur(login,email,role,etat,password) values
('admin','thirdiallo@gmail.com','ADMIN',1,md5('123')),
('users1','users1@gmail.com','VISITEUR',0,md5('123')),
('users2','users2@hotmail.Fr','VISITEUR',1,md5('123'));

insert into stagiaire(nomStagiaire,prenomStagiaire,civilite,photo,idFiliere) values
    ('diallo','tairou','M','tairou.jpg',1),
    ('diallo','Moustapha','M','tapha.jpg',2),
    ('Ngom','Fatou','F','Fatou.jpg',3),
    ('Diop','Souleymane','M','souleymane.jpg',4),
    ('Ndiaye','Adjia','F','Adjia.jpg',5),
    ('Diallo','Fatima','F','Fatima.jpg',6),
    ('diao','Malick','M','Malick.jpg',1);

insert into encadrant(civilite,nomEncadrant,prenom,grade,email,photo) values
    ('M','diallo','boubacar','Ingenieur','fatakoo@hotmail.fr','bouba.jpg'),
    ('M','diallo','Adama','Consultant','adama@gmail.com','adama.jpg'),
    ('M','diallo','cherif','Professeur','cherif@yahoo.com','cherif.jpg'),
    ('F','Diop','Fatou','Docteur','diopfatou@gmail.com','fatou.jpg'),
    ('F','dione','aita','Consultant','dioneaita@gmail.com','dione.jpg'),
    ('M','Diallo','Souleymane','Ingenieur','julomane@hotmail.fr','jule.jpg'),
    ('F','gaye','aicha','Docteur','aicha@live.fr','aicha.jpg'),
    ('M','gaye','khalifa','Professeur','khalifa@gmail.com','khalifa.jpg');

insert into structure(nomStructure,adresse,telephone,siteWeb,effectif,idStagiaire) values
    ('UASZ','Kénia-Ziguinchor','+221339874356','www.uasz.sn',6450,1),
    ('UASZ','Kénia-Ziguinchor','221339874356','www.uasz.sn',6450,2),
    ('ATOS','VDN-Dakar','+221338567432','www.atossenegal.net',236,3),
    ('Vision statistique','Liberté6-Dakar','+221338432190','www.vision-statistique.sn',10,4),
    ('SODEVITEL','OuestFoire-Dakar','+221338904573','www.sodevitel.com',36,5),
    ('Intouch','SacréCouer-Dakar','+221338340921','www.intouch.sn',,56,6),
    ('Facebook','California-USA','+543218904','www.facebook.com',,5456,7);


insert into projet(intitule,description,renumeration,date_debut,date_fin,idStagiaire,idEncadrant) values
    ('AGPSD','Ce Projet permet de optimisation les performance du serveur de données','0f cfa','26-03-2017','05-05-2018',1,1),
    ('GesCong','Gérer les congées des agents de UASZ','50000f cfa','02-01-2017','29-03-2018',2,3),
    ('GesDept','Gestion du personnelle du département informatique UASZ','75000f cfa','02-12-2017','encors',8,10),
    ('GesSalaire','Permet de gérer les salaires des agents à UASZ','50000f cfa','2017-12-27','2018-03-27',3,5),
    ('RFID','Etat de art sur les puces rfid','0f cfa','2017-02-12-','encors',6,9),
    ('GesMat','Gestion des biens matériels UASZ','50000f cfa','2017-01-27','2018-03-28',4,6),
    ('IOT','Etat de art sur internet des objets connectés','0f cfa','2016-09-27','2018-01-05',5,7);
