DROP TABLE event_participants;
DROP TABLE event_tags;
DROP TABLE events;
DROP TABLE login_session;
DROP TABLE user_info;


CREATE TABLE user_info (
	user_email    VARCHAR(200) PRIMARY KEY,
	user_password VARCHAR(200)
);

INSERT INTO user_info VALUES (
	'john_smith@gmail.com',
	'$2y$10$cHpf3TzonURXDENRiRF0de1ycSfnM4NJ27sdwyUCf5L.sewDlkCBe'
);

CREATE TABLE login_session (
	session_key VARCHAR(16) PRIMARY KEY,
	user_email  VARCHAR(200) REFERENCES user_info (user_email),
	timeout     DATE
);

CREATE TABLE events (
	event_id           VARCHAR(16) PRIMARY KEY,
	event_name         VARCHAR(100),
	event_time         DATE,
	event_location     VARCHAR(200),
	event_info         VARCHAR(1000),
	creator_email      VARCHAR(200),
	creator_first_name VARCHAR(100),
	creator_last_name  VARCHAR(100),
	creator_grad_year  NUMBER(4),
	creator_date       DATE,
	event_approved     NUMBER(1),
	event_code         VARCHAR(10)
);

INSERT INTO events (
	event_id, event_name, event_time, event_location, event_info,
	creator_date,
	event_approved
) VALUES (
	'1',
	'example event',
	CURRENT_DATE,
	'a place',
	'some random info',
	CURRENT_DATE,
	1
);

CREATE TABLE event_tags (
	event_id VARCHAR(16) REFERENCES events (event_id),
	tag      VARCHAR(64),
	PRIMARY KEY (event_id, tag)
);

CREATE TABLE event_participants (
	event_id        VARCHAR(16) REFERENCES events (event_id),
	user_email      VARCHAR(200),
	user_first_name VARCHAR(100),
	user_last_name  VARCHAR(100),
	user_grad_year  NUMBER(4),
	verified        NUMBER(1),
	PRIMARY KEY (event_id, user_email)
);
