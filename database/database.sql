DROP TABLE login_session;
DROP TABLE user_info;

CREATE TABLE user_info (
	user_email      VARCHAR(200) PRIMARY KEY,
	user_password   VARCHAR(200),
	user_first_name VARCHAR(100),
	user_last_name  VARCHAR(100),
	user_type       VARCHAR(5) CHECK (user_type IN ('Admin', 'User')),
	user_status     VARCHAR(8) CHECK (user_status IN ('Verified', 'Unverified'))
);

INSERT INTO user_info VALUES
	('john_smith@gmail.com', '$2y$10$cHpf3TzonURXDENRiRF0de1ycSfnM4NJ27sdwyUCf5L.sewDlkCBe', 'John', 'Smith', 'Admin',
	 'Verified');

CREATE TABLE login_session (
	session_key VARCHAR(16) PRIMARY KEY,
	user_email  VARCHAR(200) REFERENCES user_info (user_email),
	timeout     DATE
);

CREATE TABLE events (
	id         VARCHAR(16) PRIMARY KEY,
	user_email VARCHAR(200) REFERENCES user_info (user_email),
	created    DATE,
	name       VARCHAR(100),
	time       DATE,
	location   VARCHAR(200),
	info       VARCHAR(1000),
	approved   NUMBER(1)
);

CREATE TABLE event_tags (
	event_id VARCHAR(16) REFERENCES events (id),
	tag      VARCHAR(64),
	PRIMARY KEY (event_id, tag)
);

CREATE TABLE event_participants (
	event_id   VARCHAR(16) REFERENCES events (id),
	user_email VARCHAR(200) REFERENCES user_info (user_email),
	PRIMARY KEY (event_id, user_email)
);
