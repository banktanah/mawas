ALTER TABLE apps 
	ADD client_id varchar(36),
	ADD client_secret varchar(36),
	ADD domain varchar(255),
	ADD callback_uri text,
	ADD redirect_uri text
;

ALTER TABLE user 
	ADD nip varchar(36),
	ADD is_disabled tinyint(1) NOT NULL DEFAULT 0
;

CREATE TABLE `sso_otp` (
  `code` varchar(100) NOT NULL,
  `client_id` varchar(36) NOT NULL,
  `user_id` int(11) NOT NULL,
  `challenge` varchar(100) NOT NULL,
  `challenge_method` varchar(10) NOT NULL,
  `timestamp` int(11) NOT null,
  PRIMARY KEY (`code`)
);

CREATE TABLE `forgot_password` (
	reset_code varchar(100) NOT NULL,
	nip varchar(50) NOT NULL,
	created_date datetime NOT NULL,
	is_used int DEFAULT 0 NULL,
  	PRIMARY KEY (`reset_code`),
	UNIQUE KEY `forgot_password_unique` (`nip`,`created_date`)
);