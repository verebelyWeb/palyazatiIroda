create database palyazatiIroda;

create table koltsegtipus(
    id varchar(3) primary key,
    megnevezes varchar(32)
)default charset utf8;

create table palyazat(
    id int primary key,
    tervezetA int,
    tervezetC int
)default charset utf8;

create table szamla(
    id int primary key,
    szamlaszam varchar(9),
    datum date,
    ertek int,     
    palyazatId int,
    koltsegtipusId varchar(3),
    foreign key (palyazatId)references palyazat(id) on delete cascade,
    foreign key (koltsegtipusId) references koltsegtipus(id)
)default charset utf8;

