# Create database
DROP DATABASE IF EXISTS db_csuf_bball_team;
CREATE DATABASE IF NOT EXISTS db_csuf_bball_team;

# Create user
# DROP USER 'csufadmin'@'localhost'; # IF EXISTS 
CREATE USER IF NOT EXISTS 'csufadmin'@'localhost' IDENTIFIED BY 'password'; #PASSWORD EXPIRE;
GRANT SELECT, INSERT, DELETE, UPDATE ON db_csuf_bball_team.* TO 'csufadmin'@'localhost';

USE db_csuf_bball_team;

# Create Team Roster table
CREATE TABLE TeamRoster
( ID            INT(10)         UNSIGNED NOT NULL AUTO_INCREMENT,
  Name_First    VARCHAR(100),  
  Name_Last     VARCHAR(150)    NOT NULL, 
  Street        VARCHAR(250), 
  City          VARCHAR(100),
  State         VARCHAR(100),
  Country       VARCHAR(100),
  ZipCode       CHAR(10),
  PRIMARY KEY ( ID ) 
) AUTO_INCREMENT=100; 

# Initialize Team Roster
INSERT INTO TeamRoster VALUES (NULL, 'Donald', 'Duck', '1313 S. Harbor Blvd.', 'Anaheim', 'CA', 'USA', '92808-3232');
INSERT INTO TeamRoster VALUES (NULL, 'Daisy', 'Duck', '1180 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830');
INSERT INTO TeamRoster VALUES (NULL, 'Mickey', 'Mouse', '1313 S. Harbor Blvd.', 'Anaheim', 'CA', 'USA', '92808-3232');
INSERT INTO TeamRoster VALUES (NULL, 'Pluto', 'Dog', '1313 S. Harbor Blvd.', 'Anaheim', 'CA', 'USA', '92808-3232');
INSERT INTO TeamRoster VALUES (NULL, 'Scrooge', 'McDuck', '1180 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830');
INSERT INTO TeamRoster VALUES (NULL, 'Huebert (Huey)', 'Duck', '1110 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830');
INSERT INTO TeamRoster VALUES (NULL, 'Deuteronomy (Dewey)', 'Duck', '1110 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830');
INSERT INTO TeamRoster VALUES (NULL, 'Louie', 'Duck', '1110 Seven Seas Dr.', 'Lake Buena Vista', 'FL', 'USA', '32830');
INSERT INTO TeamRoster VALUES (NULL, 'Phooey', 'Duck', '1-1 Maihama Urayasu', 'Chiba Prefecture', 'Disney Tokyo', 'Japan', NULL);
INSERT INTO TeamRoster VALUES (NULL, 'Della', 'Duck', '77700 Boulevard du Parc', 'Coupvray', 'Disney Paris', 'France', NULL);


# Create Statistics table
CREATE TABLE Statistics
( ID                INT(10)     UNSIGNED NOT NULL AUTO_INCREMENT,
  Player            INT(10)     UNSIGNED NOT NULL,  
  PlayingTimeMin    TINYINT(2)  UNSIGNED DEFAULT 0, 
  PlayingTimeSec    TINYINT(2)  UNSIGNED DEFAULT 0, 
  Points            TINYINT(3)  UNSIGNED DEFAULT 0,
  Assists           TINYINT(3)  UNSIGNED DEFAULT 0,
  Rebounds          TINYINT(3)  UNSIGNED DEFAULT 0,
  PRIMARY KEY ( ID )
  -- FOREIGN KEY TeamRoster.ID (Player)
) AUTO_INCREMENT=17;

# Initialize Statistics
INSERT INTO Statistics VALUES (NULL, 100, 35, 12, 47, 11, 21);
INSERT INTO Statistics VALUES (NULL, 102, 13, 22, 13, 1, 3);
INSERT INTO Statistics VALUES (NULL, 103, 10, 0, 18, 2, 4);
INSERT INTO Statistics VALUES (NULL, 107, 2, 45, 9, 1, 2);
INSERT INTO Statistics VALUES (NULL, 102, 15, 39, 26, 3, 7);
INSERT INTO Statistics VALUES (NULL, 100, 29, 47, 27, 9, 8);
