-- BMGT406 Project #7: Cable Company Database
--
-- SQL commands that were executed on the BMGT406 MySQL server
--
-- @file sqlcommands.sql
-- @version 1.3
-- @since 2014-11-09



-- for localhost
-- use MySQL console or phpMyAdmin
-- user root
-- no password
-- must create a database 
/* Create a new database to test your code locally   */



-- For use on bmgt406.rhsmith.umd.edu:
-- https://bmgt406.rhsmith.umd.edu/phpMyAdmin

-- mysql: user=bmgt406_## --password=bmgt406_## bmgt406_##_db
-- a dabase account has been created for each user
-- user bmgt406_XX
-- password 
-- database bmgt406_XX_db

use bmgt406_XX_db;

/* Player Table */
create table player (firstname varchar(50), lastname varchar(50), 
email varchar(70) primary key);

insert into player values ("Rose", "Smith","rose@notreal.com");
insert into player values ("Tom", "Peterson","tom@doesnotexist.com");
insert into player values ("Laura", "Clark", "laura@isnotreal.com");
insert into player values ("Testudo", "Turtle","testudo@umd.edu");


/* Games Table */
create table games (gameID smallint primary key AUTO_INCREMENT, eventName varchar(50), 
maxPlayers int, eventDate DATE);

insert into games (eventName, maxPlayers, eventDate) values ("Game #1", 4, "12/15/2023");
insert into games (eventName, maxPlayers, eventDate) values ("Game #2", 4, "12/17/2023");
insert into games (eventName, maxPlayers, eventDate) values ("Game #3", 2, "12/19/2023");
insert into games (eventName, maxPlayers, eventDate) values ("Game #4", 2, "01/03/2024");


/* Signups Table */
create table signups (SID smallint primary key AUTO_INCREMENT, 
gameID smallint,
FOREIGN KEY (gameID) REFERENCES games(gameID),
email varchar(70),
FOREIGN KEY (email) REFERENCES player(email));

insert into signups (gameID, email) values (1,"testudo@umd.edu");
insert into signups (gameID, email) values (1, "rose@notreal.com");
insert into signups (gameID, email) values (2, "tom@doesnotexist.com");
insert into signups (gameID, email) values (2, "laura@isnotreal.com");


/* Comment Table */
create table comment (email1 varchar(70), email2 varchar(70), comment varchar(250), 
primary key (email1, email2), 
foreign key (email1) references player(email),
foreign key (email2) references player(email));

insert into comment values ("rose@notreal.com","testudo@umd.edu", "This player followed the rules.");
insert into comment values ("rose@notreal.com", "laura@isnotreal.com", "This woman is so bad.");
insert into comment values ("tom@doesnotexist.com", "testudo@umd.edu","This man is the best player I have ever played against.");
insert into comment values ( "laura@isnotreal.com", "rose@notreal.com", "She is a professional, BEWARE!");


/* games available for signup */
SELECT *
FROM games g 
WHERE g.gameid NOT IN( 
    SELECT g.gameid 
    FROM games g, signups s 
    WHERE g.gameid = s.gameid 
    GROUP BY g.eventname, g.maxplayers 
    HAVING g.maxplayers = count(s.gameid))

/* Shows which player signed up for which event */
SELECT s.email, s.gameid
FROM games g, signups s, player p
WHERE p.email = s.email and g.gameid = s.gameid
GROUP BY s.email, s.gameid

/* game that have reached max number of players*/
SELECT g.eventname, g.maxplayers, count(s.gameid) as players_signed_up 
FROM games g, signups s 
WHERE g.gameid = s.gameid 
GROUP BY g.eventname, g.maxplayers 
HAVING g.maxplayers = count(s.gameid)

/* comments that people recieve*/
SELECT email2, comment 
FROM comment 
GROUP BY email2, comment