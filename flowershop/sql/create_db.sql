--
-- create database table and set privs
--

create database flowershop;

use mysql;
insert into db(Host,Db,User,Select_priv,Insert_priv,Update_priv,Delete_priv) values('crash','flowershop','flo','Y','Y','Y','Y');
alter table user modify column ssl_cipher blob null;
insert into user (Host,User,Password) values ('crash','flo', PASSWORD('logmein'));
flush privileges;

--
-- create the database tables
---

use flowershop;

create table users(
uid integer not null auto_increment,
login varchar(10) not null,
password varchar(10) not null,
name varchar(100) not null,
address text,
cardnumber varchar(16) not null,
expirymonth integer not null,
expiryyear integer not null,
primary key (uid)
);

create table sessions(
uid integer not null auto_increment,
userid integer references users (uid),
primary key (uid)
);

create table flowers(
uid integer not null auto_increment,
name varchar(50),
description text,
price float(5,2) default '0.00',
primary key (uid)
);

create table arrangements(
uid integer not null auto_increment,
name varchar(20),
description text,
price float(5,2) default '0.00',
primary key (uid)
);


create table cart(
uid integer not null auto_increment,
flowerquantity integer,
primary key (uid)
);

create table flowercart(
cartid integer not null references cart (uid),
flowerid integer not null references flowers (uid)
);

create table arrangementcart(
cartid integer not null references cart (uid),
arrangementid integer not null references arrangements (uid),
quantity integer
);

create table guestbook(
msgfrom varchar(100),
message text
);

--
-- creating data for table `arrangements`
--

INSERT INTO arrangements VALUES (1,'a','some flowers',5.50);
INSERT INTO arrangements VALUES (2,'b','a few moe flowers',6.50);
INSERT INTO arrangements VALUES (3,'c','a bunch of flowers',8.50);
INSERT INTO arrangements VALUES (4,'d','a big selection of flowers',4.25);
INSERT INTO arrangements VALUES (5,'e','this is a nice selection',8.50);
INSERT INTO arrangements VALUES (6,'f','yet another set of flowers',7.00);
INSERT INTO arrangements VALUES (7,'g','large quantity of flowers',5.00);
INSERT INTO arrangements VALUES (8,'h','last group of flowers',9.45);

--
-- creating data for table `flowers`
--

INSERT INTO flowers VALUES (1,'a','pretty flower',1.50);
INSERT INTO flowers VALUES (2,'b','another pretty flower',1.50);
INSERT INTO flowers VALUES (3,'c','yet another pretty flower',1.50);
INSERT INTO flowers VALUES (4,'d','not so pretty flower',1.25);
INSERT INTO flowers VALUES (5,'e','but this one is quite nice',1.50);
INSERT INTO flowers VALUES (6,'f','and this one',1.00);
INSERT INTO flowers VALUES (7,'g','wow, a flower',2.00);
INSERT INTO flowers VALUES (8,'h','ok, the last flower',1.45);

--
-- creating data for table `users`
--

INSERT INTO users VALUES (1,'admin','123','Administrator','No address provided','4111111111111111',9,2005);
INSERT INTO users VALUES (8,'mike','andrews','Mike Andrews','742 Evergreen Terrace\r\nSpringfield, MA 12345','4111111111111111',1,2005);
