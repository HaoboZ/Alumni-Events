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
INSERT INTO user_info VALUES
	('dona_huber@gmail.com', '$2y$10$lcLYyNeK1adgzYcBplv45uuXHFuFyWYThnj3nB2SZ/LbQvtWSoGjO', 'Dona', 'Huber', 'User',
	 'Verified');
INSERT INTO user_info VALUES
	('roy_hise@gmail.com', '$2y$10$XlyVI9an5B6rHW3SS9vQpesJssKJxzMQYPbSaR7dnpWjDI5fpxJSS', 'Roy', 'Hise', 'User',
	 'Verified');
INSERT INTO user_info VALUES
	('peter_goad@gmail.com', '$2y$10$n1B.FdHNwufTkmzp/pNqc.EiwjB8quQ1tBCEC7nkaldI5pS.et04e', 'Peter', 'Goad', 'User',
	 'Verified');
INSERT INTO user_info VALUES
	('sarah_thomas@gmail.com', '$2y$10$s57SErOPlgkIZf1lxzlX3.hMt8LSSKaYig5rusxghDm7LW8RtQc/W', 'Sarah', 'Thomas',
	 'User', 'Verified');
INSERT INTO user_info VALUES
	('edna_william@gmail.com', '$2y$10$mfMXnH.TCmg5tlYRhqjxu.ILly8s9.qsLKOpyxgUl6h1fZt6x/B5C', 'Edna', 'William',
	 'User', 'Verified');

CREATE TABLE login_session (
	session_key VARCHAR(16) PRIMARY KEY,
	user_email  VARCHAR(200) REFERENCES user_info (user_email),
	timeout     DATE
);
