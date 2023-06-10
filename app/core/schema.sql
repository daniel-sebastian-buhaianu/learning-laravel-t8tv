CREATE DATABASE vidapp
	DEFAULT CHARACTER SET utf8;

USE vidapp;

CREATE TABLE Video_Category (
	video_category_id INTEGER NOT NULL AUTO_INCREMENT KEY,
	name VARCHAR(255) NOT NULL,

	INDEX USING BTREE (name)

) ENGINE = InnoDB;

CREATE TABLE Rumble_Channel (
	rumble_channel_id INTEGER NOT NULL AUTO_INCREMENT KEY,
	id VARCHAR(127) NOT NULL,
	url VARCHAR(255) NOT NULL,
	title VARCHAR(127) NOT NULL,
	joining_date DATE NOT NULL,
	description TEXT,
	banner VARCHAR(255),
	avatar VARCHAR(255),
	followers_count INTEGER,
	videos_count INTEGER,

	INDEX USING BTREE (title)

) ENGINE = InnoDB;

CREATE TABLE Rumble_Video (
	rumble_video_id INTEGER NOT NULL AUTO_INCREMENT KEY,
	html TEXT NOT NULL,
	url VARCHAR(255) NOT NULL,
	title VARCHAR(255) NOT NULL,
	thumbnail VARCHAR(255) NOT NULL,
	duration VARCHAR(15) NOT NULL,
	uploaded_at DATETIME NOT NULL,
	rumble_channel_id INTEGER NOT NULL,
	video_category_id INTEGER NOT NULL,
	likes_count INTEGER,
	dislikes_count INTEGER,
	views_count INTEGER,
	comments_count INTEGER,


	INDEX USING BTREE (title),

	CONSTRAINT FOREIGN KEY (rumble_channel_id) REFERENCES Rumble_Channel (rumble_channel_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FOREIGN KEY (video_category_id) REFERENCES Video_Category (video_category_id)
		ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE = InnoDB;