DROP TABLE event_participants;
DROP TABLE event_tags;
DROP TABLE events;
DROP TABLE login_session;
DROP TABLE user_info;


CREATE TABLE user_info (
	user_email      VARCHAR(200) PRIMARY KEY,
	user_password   VARCHAR(200),
	user_first_name VARCHAR(100),
	user_last_name  VARCHAR(100),
	user_grad_year  NUMBER(4),
	user_type       VARCHAR(5) CHECK (user_type IN ('Admin', 'User')),
	user_status     VARCHAR(8) CHECK (user_status IN ('Verified', 'Unverified'))
);

INSERT INTO user_info VALUES	(
  'john_smith@gmail.com',
  '$2y$10$cHpf3TzonURXDENRiRF0de1ycSfnM4NJ27sdwyUCf5L.sewDlkCBe',
  'John',
  'Smith',
  2018,
  'Admin',
  'Verified'
);

CREATE TABLE login_session (
	session_key VARCHAR(16) PRIMARY KEY,
	user_email  VARCHAR(200) REFERENCES user_info (user_email),
	timeout     DATE
);

CREATE TABLE events (
	event_id            VARCHAR(16) PRIMARY KEY,
	user_email          VARCHAR(200) REFERENCES user_info (user_email),
	event_creation_date DATE,
	event_name          VARCHAR(100),
	event_time          DATE,
	event_location      VARCHAR(200),
	event_info          VARCHAR(1000),
	event_approved      NUMBER(1)
);

INSERT INTO events VALUES (
  '1',
  'john_smith@gmail.com',
  CURRENT_DATE,
  'example event',
  CURRENT_DATE,
  'a place',
  'some random info',
  1
);

CREATE TABLE event_tags (
	event_id VARCHAR(16) REFERENCES events (event_id),
	tag      VARCHAR(64),
	PRIMARY KEY (event_id, tag)
);

CREATE TABLE event_participants (
	event_id   VARCHAR(16) REFERENCES events (event_id),
	user_email VARCHAR(200) REFERENCES user_info (user_email),
	PRIMARY KEY (event_id, user_email)
);
