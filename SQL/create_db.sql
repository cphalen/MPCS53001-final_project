DROP TABLE IF EXISTS Episode;
CREATE TABLE Episode (
	EpisodeID INT AUTO_INCREMENT,
	EpisodeNumber INT,
	Title varchar(256),
	AirDate DATE,
	Description varchar(2048),
	SeasonID INT,
	Favorite INT,
	PRIMARY KEY (EpisodeID)
);

DROP TABLE IF EXISTS Writer;
CREATE TABLE Writer (
	WriterID INT AUTO_INCREMENT,
	Name varchar(256),
	DateOfBirth DATE,
	PRIMARY KEY (WriterID)
);

DROP TABLE IF EXISTS Director;
CREATE TABLE Director (
	DirectorID INT AUTO_INCREMENT,
	Name varchar(256),
	DateOfBirth DATE,
	PRIMARY KEY (DirectorID)
);

DROP TABLE IF EXISTS Actor;
CREATE TABLE Actor (
	ActorID INT AUTO_INCREMENT,
	Name varchar(256),
	DateOfBirth DATE,
	PRIMARY KEY (ActorID)
);

DROP TABLE IF EXISTS Role;
CREATE TABLE Role (
	RoleID INT AUTO_INCREMENT,
	Name varchar(256),
	Description varchar(2048),
	ActorID INT NOT NULL,
	PRIMARY KEY (RoleID)
);

DROP TABLE IF EXISTS Writes;
CREATE TABLE Writes (
	WriterID INT,
	EpisodeID INT,
	PRIMARY KEY (WriterID, EpisodeID)
);

DROP TABLE IF EXISTS Directs;
CREATE TABLE Directs (
	DirectorID INT,
	EpisodeID INT,
	PRIMARY KEY (DirectorID, EpisodeID)
);

DROP TABLE IF EXISTS ActsIn;
CREATE TABLE ActsIn (
	ActorID INT,
	EpisodeID INT,
	PRIMARY KEY (ActorID, EpisodeID)
);

DROP TABLE IF EXISTS AppearsIn;
CREATE TABLE AppearsIn (
	RoleID INT,
	EpisodeID INT,
	PRIMARY KEY (RoleID, EpisodeID)
);

DROP TABLE IF EXISTS Season;
CREATE TABLE Season (
	SeasonID INT AUTO_INCREMENT,
	SeasonNumber INT,
	Year INT,
	Description varchar(2048),
	SeriesTitle varchar(256) NOT NULL,
	PRIMARY KEY (SeasonID)
);

DROP TABLE IF EXISTS Series;
CREATE TABLE Series (
	SeriesTitle varchar(256),
	YearRange varchar(256),
	Description varchar(2048),
	PRIMARY KEY (SeriesTitle)
);
