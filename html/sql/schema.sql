-- TODO:
-- Tabelle users mit id, username und password_hash
-- Constraints: id ist PRIMARY KEY, username muss eindeutig sein und darf nicht null sein, password_hash darf nicht null sein
-- Daten einfügen: admin mit Passwort password123
-- Hinweis: Nutzen Sie zum Hashen der Passwörter die Funktion SHA2

create table users(
    id int auto_increment primary key,
    username varchar(255) not null unique,
    password_hash varchar(255) not null
);

