CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash CHAR(64) NOT NULL
);
 
INSERT INTO users (username, password_hash) VALUES 
('admin', SHA2('password123', 256)),
('benhugo', SHA2('password123', 256)),
('bine', SHA2('password123', 256)),
('melli', SHA2('password123', 256)),
('bene', SHA2('password123', 256));
 
CREATE TABLE leaderboard (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    score INT NOT NULL,
    quiz_date DATE NOT NULL
);
 
INSERT INTO leaderboard (user_id, score, quiz_date) VALUES
    (1, 10, '2021-01-02'),
    (2, 8, '2022-02-03'),
    (3, 9, '2023-03-04'),
    (4, 7, '2024-04-05'),
    (5, 6, '2025-05-06');
 
CREATE TABLE questions (
        id INT PRIMARY KEY AUTO_INCREMENT,
        question_text VARCHAR(255) NOT NULL,
        option_a VARCHAR(255) NOT NULL,
        option_b VARCHAR(255) NOT NULL,
        option_c VARCHAR(255) NOT NULL,
        option_d VARCHAR(255) NOT NULL,
        correct_option CHAR(1) NOT NULL
    );
 
INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option) VALUES
    ('What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 'C'),
    ('Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'B'),
    ('Who wrote "To Kill a Mockingbird"?', 'Harper Lee', 'Mark Twain', 'George Orwell', 'J.K. Rowling', 'A'),
    ('What is the largest mammal?', 'Elephant', 'Blue Whale', 'Giraffe', 'Polar Bear', 'B'),
    ('What is the chemical symbol for water?', 'HO', 'H2O', 'OH2', 'H3O', 'B'),
    ('Which year did the Titanic sink?', '1912', '1913', '1914', '1915', 'A'),
    ('Who painted the Mona Lisa?', 'Vincent van Gogh', 'Pablo Picasso', 'Leonardo da Vinci', 'Claude Monet', 'C'),
    ('What is the square root of 64?', '6', '7', '8', '9', 'C'),
    ('Which gas do plants primarily use in photosynthesis?', 'Oxygen', 'Carbon Dioxide', 'Nitrogen', 'Hydrogen', 'B'),
    ('What is the boiling point of water at sea level (in Celsius)?', '90', '95', '100', '105', 'C');
 
-- Automatisiertes Erzeugen von Fragen um auf große Anzahl zu kommen
DELIMITER //
CREATE PROCEDURE populate_questions()
BEGIN
    DECLARE i INT DEFAULT 11;
    WHILE i <= 1000 DO
        INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option)
        VALUES (CONCAT('Question number ', i),
                'Option A', 'Option B', 'Option C', 'Option D', 'A');
        SET i = i + 1;
END WHILE;
END //
DELIMITER ;
CALL populate_questions();
