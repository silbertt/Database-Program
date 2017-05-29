-- Casey Sanders, Teage Silbert
-- CS340 Final Project Winter 2016
-- Table creation file

-- Drop Tables if they already exist to ensure most updated tables are loaded

DROP TABLE IF EXISTS `results`;
DROP TABLE IF EXISTS `courses`;
DROP TABLE IF EXISTS `tournaments`;
DROP TABLE IF EXISTS `golfers`;
DROP TABLE IF EXISTS `region`;

-- Create regions table

CREATE TABLE region(
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB;

-- Create tournaments table

CREATE TABLE tournaments(
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB;

-- Create courses table:

CREATE TABLE courses(
    id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    tid int(11) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=InnoDB;

-- Create golfers table

CREATE TABLE golfers(
    id int(11) NOT NULL AUTO_INCREMENT,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    region int(11) NOT NULL,
    tid int (11),
    PRIMARY KEY(id),
    FOREIGN KEY(region) REFERENCES region(id),
    UNIQUE KEY(first_name, last_name)
)ENGINE=InnoDB;

-- Create results table

CREATE TABLE results(
    winner int(11) NOT NULL,
    year int(11) NOT NULL,
    tid int(11) NOT NULL,
    cid int(11) NOT NULL,
    FOREIGN KEY(tid) REFERENCES tournaments(id),
    FOREIGN KEY(cid) REFERENCES courses(id),
    FOREIGN KEY(winner) REFERENCES golfers(id),
    UNIQUE KEY(year, tid)
)ENGINE=InnoDB;

-- Create regions
-- 1. Southern US
-- 2. Western US
-- 3. Eastern US
-- 4. Central US
-- 5. Europe
-- 6. Australia
-- 7. Africa
-- 8. Asia
-- 9. South America

INSERT INTO region(name) values ('Southern US'),
('Western US'),
('Eastern US'),
('Central US'),
('Europe'),
('Australia'),
('Africa'),
('Asia'),
('South America');


-- Insert golfers

INSERT INTO golfers(first_name, last_name, region) values ('Rory', "McIlroy", 5),
('Jordan', 'Spieth', 1),
('Tiger', 'Woods', 2),
('Dustin', 'Johnson', 1),
('Jason', 'Day', 6),
('Bubba', 'Watson', 1),
('Rickie', 'Fowler', 2),
('Henrik', 'Stenson', 5),
('Justin', 'Rose', 5),
('Patrick', 'Reed', 1),
('Branden', 'Grace', 7),
('Hideki', 'Matsuyama', 8),
('Jim', 'Furyk', 3),
('Adam', 'Scott', 6),
('Brandt', 'Snedeker', 1),
('Zach', 'Johnson', 4),
('Segio', 'Garcia', 5),
('Phil', 'Mickelson', 2),
('Louis', 'Oosthuizen', 7),
('Matt', 'Kuchar', 1),
('JB', 'Holmes', 1),
('Charl', 'Schwartzel', 7),
('Martin', 'Kaymer', 5),
('KJ', 'Choi', 8),
('Tim', 'Clark', 7),
('Jason', 'Dufner', 4),
('Keegan', 'Bradley', 3),
('Kevin', 'Stadler', 2),
('Brooks', 'Koepka', 1),
('Kyle', 'Stanley', 2),
('Mark', 'Wilson', 4),
('Hunter', 'Mahan', 2),
('David', 'Lingmerth', 5),
('Steve', 'Stricker', 4),
('Padraig', 'Harrington', 5),
('Russel', 'Henley', 1),
('Michael', 'Thompson', 2),
('Rory', 'Sabbatini', 7),
('Camilo', 'Villegas', 9),
('Scott', 'Stallings', 3),
('Ben', 'Crane', 1),
('Ernie', 'Els', 7),
('Darren', 'Clarke', 5);



-- Insert tournaments

-- 1. The Masters
-- 2. Players Championship
-- 3. Phoenix Open
-- 4. Honda Classic
-- 5. Memorial Tournament
-- 6. Farmers Insurance Open
-- 7. PGA Championship
-- 8. Open Championship

INSERT INTO tournaments(name) values ('The Masters'),
('Players Championship'),
('Phoenix Open'),
('Honda Classic'),
('Memorial Tournament'),
('Farmers Insurance Open'),
('PGA Championship'),
('The Open Championship');

-- Insert courses with associated tournament id

INSERT INTO courses(name, tid) values ('Augusta National Golf Club', 1),
('TPC Sawgrass', 2),
('TPC Scottsdate', 3),
('PGA National Golf Club', 4),
('Muirfield Village Golf Club', 5),
('Torrey Pines Golf Club', 6),
('Whistling Straights', 7),
('Valhalla Golf Club', 7),
('Oak Hill Country Club', 7),
('Kiawah Island Golf Resort', 7),
('Atlanta Athletic Club', 7),
('Hazeltine National Golf Club', 7),
('Oakland Hills Country Club', 7),
('Southern Hills Country Club', 7),
('Medinah Country Club', 7),
('Baltusrol Golf Club', 7),
('St. Andrews', 8),
('Royal Liverpool', 8),
('Muirfield', 8),
('Royal Lytham & St Annes', 8),
('Royal St Georges', 8),
('Turnberry', 8),
('Royal Birkdale', 8),
('Carnoustie', 8),
('Royal Troon', 8);

INSERT INTO results(winner, year, tid, cid) values (2, '2015', 1, 1),
(6, '2014', 1, 1),
(14, '2013', 1, 1),
(6, '2012', 1, 1),
(22, '2011', 1, 1),
(18, '2010', 1, 1),
(7, '2015', 2, 2),
(23, '2014', 2, 2),
(3, '2013', 2, 2),
(20, '2012', 2, 2),
(24, '2011', 2, 2),
(25, '2010', 2, 2),
(5, '2015', 7, 7),
(1, '2014', 7, 8),
(26, '2013', 7, 9),
(1, '2012', 7, 10),
(27, '2011', 7, 11),
(23, '2010', 7, 7),
(29, '2015', 3, 3),
(28, '2014', 3, 3),
(18, '2013', 3, 3),
(30, '2012', 3, 3),
(31, '2011', 3, 3),
(32, '2010', 3, 3),
(33, '2015', 5, 5),
(12, '2014', 5, 5),
(20, '2013', 5, 5),
(3, '2012', 5, 5),
(34, '2011', 5, 5),
(9, '2010', 5, 5),
(35, '2015', 4, 4),
(36, '2014', 4, 4),
(37, '2013', 4, 4),
(1, '2012', 4, 4),
(38, '2011', 4, 4),
(39, '2010', 4, 4),
(5, '2015', 6, 6),
(40, '2014', 6, 6),
(3, '2013', 6, 6),
(15, '2012', 6, 6),
(6, '2011', 6, 6),
(41, '2010', 6, 6),
(16, '2015', 8, 17),
(1, '2014', 8, 18),
(18, '2013', 8, 19),
(42, '2012', 8, 20),
(43, '2011', 8, 21),
(19, '2010', 8, 17);
