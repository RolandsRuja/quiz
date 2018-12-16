DROP TABLE IF EXISTS test;
CREATE TABLE IF NOT EXISTS test
(
	id int NOT NULL AUTO_INCREMENT,
	name varchar(100) NOT NULL,
	PRIMARY KEY (id)
);

DROP TABLE IF EXISTS question;
CREATE TABLE IF NOT EXISTS question
(
	id int NOT NULL AUTO_INCREMENT,
	test_id int NOT NULL,
	question varchar(250) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (test_id) REFERENCES test(id)
);

DROP TABLE IF EXISTS answer;
CREATE TABLE IF NOT EXISTS answer
(
	id int NOT NULL AUTO_INCREMENT,
	question_id int NOT NULL,
	answer varchar(250) NOT NULL,
	is_true boolean NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (question_id) REFERENCES question(id)
);

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user
(
	id int NOT NULL AUTO_INCREMENT,
	username varchar(30) NOT NULL,
	test_id int NOT NULL,
	total int NOT NULL,
	correct int DEFAULT 0,
	PRIMARY KEY (id),
	FOREIGN KEY (test_id) REFERENCES test(id)
);

DROP TABLE IF EXISTS history;
CREATE TABLE IF NOT EXISTS history
(
  id int NOT NULL AUTO_INCREMENT,
  user_id int NOT NULL,
  test_id int NOT NULL,
  question_id int NOT NULL,
  answer_id int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (test_id) REFERENCES test(id),
  FOREIGN KEY (question_id) REFERENCES question(id),
  FOREIGN KEY (answer_id) REFERENCES answer(id)
);

INSERT INTO test (name) VALUES
('NBA player test'), ('NHL player test');

INSERT INTO question (test_id, question) VALUES
(1, 'Which team LeBron James plays for?'),
(1, 'Which team Kevin Durant plays for?'),
(1, 'Which team Kristaps Porzingis plays for?'),
(1, 'Which team Luka Doncic plays for?'),
(1, 'Which team James Harden plays for?'),
(2, 'Which team Zemgus Girgensons plays for?'),
(2, 'Which team Alex Ovechkin plays for?'),
(2, 'Which team Sideny Crosby plays for?'),
(2, 'Which team Patrick Kane plays for?'),
(2, 'Which team Mikko Rantanen plays for?');

INSERT INTO answer (question_id, answer, is_true) VALUES
(1, 'Cleveland Cavaliers', 0),
(1, 'Los Angeles Lakers', 1),
(2, 'Goldenstate Warriors', 1),
(2, 'Oklahama City Thunder', 0),
(2, 'New York Knicks', 0),
(3, 'Utah Jazz', 0),
(3, 'Brooklyn Nets', 0),
(3, 'San Antonio Spurs', 0),
(3, 'New York Knicks', 1),
(4, 'Atlanta Hawks', 0),
(4, 'Dallas Mavericks', 1),
(4, 'Boston Celtics', 0),
(4, 'Los Angeles Clippers', 0),
(4, 'Memphis Grizzlies', 0),
(5, 'Sacremento Kings', 0),
(5, 'Minnesota Timberwolves', 0),
(5, 'Indiana Pacers', 0),
(5, 'Chicago Bulls', 0),
(5, 'Toronto Raptors', 0),
(5, 'Houston Rockets', 1),
(6, 'Boston Bruins', 0),
(6, 'Buffalo Sabres', 1),
(7, 'Washington Capitals', 1),
(7, 'Chicago Blackhawks', 0),
(7, 'Carolina Hurricanes', 0),
(8, 'Tampa Bay Lightning', 0),
(8, 'New York Islanders', 0),
(8, 'Ottawa Senators', 0),
(8, 'Pittsburgh Penguins', 1),
(9, 'Vegas Golden Knights', 0),
(9, 'Chicago Blackhawks', 1),
(9, 'Vancouver Canucks', 0),
(9, 'Arizona Coyotes', 0),
(9, 'Winnipeg Jets', 0),
(10, 'Philadelphia Flyers', 0),
(10, 'Toronto Maple Leafs', 0),
(10, 'Florida Panthers', 0),
(10, 'Anaheim Ducks', 0),
(10, 'St. Louis Blues', 0),
(10, 'Colorado Avalanche', 1);