use #DATABASE#;

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id int auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	email varchar(50) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
	CONSTRAINT users_pk PRIMARY KEY (id),
	CONSTRAINT users_un UNIQUE KEY (id,email)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO users (name, email) VALUES ('josue fernandez', 'josueesneiderf@gmail.com');

DROP TABLE IF EXISTS tickets;
CREATE TABLE tickets (
	id int auto_increment NOT NULL,
	user_id int NOT NULL,
	status varchar(10) DEFAULT 'abierto' NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
	CONSTRAINT tickets_pk PRIMARY KEY (id),
	CONSTRAINT tickets_FK FOREIGN KEY (user_id) REFERENCES users(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO tickets (user_id, status) VALUES (1, 'abierto');

SET FOREIGN_KEY_CHECKS=1;

