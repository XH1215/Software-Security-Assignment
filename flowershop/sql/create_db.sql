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
-- Drop existing tables if needed
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS flowers;
DROP TABLE IF EXISTS arrangements;
DROP TABLE IF EXISTS cart;
DROP TABLE IF EXISTS flowercart;
DROP TABLE IF EXISTS arrangementcart;
DROP TABLE IF EXISTS guestbook;

-- Create new tables
CREATE TABLE users (
    uid INTEGER NOT NULL AUTO_INCREMENT,
    login VARCHAR(10) NOT NULL,
    password VARCHAR(64) NOT NULL,
    name VARCHAR(100) NOT NULL,
    address TEXT,
    cardnumber VARCHAR(16) NOT NULL,
    expirymonth INTEGER NOT NULL,
    expiryyear INTEGER NOT NULL,
    login_attempts INTEGER DEFAULT 0,
    lock_time DATETIME,
    PRIMARY KEY (uid)
);

CREATE TABLE sessions (
    uid VARCHAR(64) NOT NULL,
    userid INTEGER REFERENCES users(uid),
    PRIMARY KEY (uid)
);

CREATE TABLE flowers (
    uid INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    description TEXT,
    price FLOAT(5,2) DEFAULT '0.00',
    PRIMARY KEY (uid)
);

CREATE TABLE arrangements (
    uid INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(20),
    description TEXT,
    price FLOAT(5,2) DEFAULT '0.00',
    PRIMARY KEY (uid)
);

CREATE TABLE cart (
    uid INTEGER NOT NULL AUTO_INCREMENT,
    flowerquantity INTEGER,
    PRIMARY KEY (uid)
);

CREATE TABLE flowercart (
    cartid INTEGER NOT NULL REFERENCES cart(uid),
    flowerid INTEGER NOT NULL REFERENCES flowers(uid)
);

CREATE TABLE arrangementcart (
    cartid INTEGER NOT NULL REFERENCES cart(uid),
    arrangementid INTEGER NOT NULL REFERENCES arrangements(uid),
    quantity INTEGER
);

CREATE TABLE guestbook (
    msgfrom VARCHAR(100),
    message TEXT
);

-- Insert data for tables arrangements, flowers, and users
INSERT INTO arrangements VALUES (1,'a','some flowers',5.50);
INSERT INTO arrangements VALUES (2,'b','a few moe flowers',6.50);
INSERT INTO arrangements VALUES (3,'c','a bunch of flowers',8.50);
INSERT INTO arrangements VALUES (4,'d','a big selection of flowers',4.25);
INSERT INTO arrangements VALUES (5,'e','this is a nice selection',8.50);
INSERT INTO arrangements VALUES (6,'f','yet another set of flowers',7.00);
INSERT INTO arrangements VALUES (7,'g','large quantity of flowers',5.00);
INSERT INTO arrangements VALUES (8,'h','last group of flowers',9.45);

INSERT INTO flowers VALUES (1,'a','pretty flower',1.50);
INSERT INTO flowers VALUES (2,'b','another pretty flower',1.50);
INSERT INTO flowers VALUES (3,'c','yet another pretty flower',1.50);
INSERT INTO flowers VALUES (4,'d','not so pretty flower',1.25);
INSERT INTO flowers VALUES (5,'e','but this one is quite nice',1.50);
INSERT INTO flowers VALUES (6,'f','and this one',1.00);
INSERT INTO flowers VALUES (7,'g','wow, a flower',2.00);
INSERT INTO flowers VALUES (8,'h','ok, the last flower',1.45);

INSERT INTO users VALUES (1,'admin','123','Administrator','No address provided','4111111111111111',9,2005, 0, NULL);
INSERT INTO users VALUES (8,'mike','andrews','Mike Andrews','742 Evergreen Terrace\r\nSpringfield, MA 12345','4111111111111111',1,2005, 0, NULL);
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
