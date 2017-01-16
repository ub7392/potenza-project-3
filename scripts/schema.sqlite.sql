CREATE TABLE people
(
    people_id      INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    first_name     VARCHAR(32),
    last_name      VARCHAR(32),
    favorite_food  VARCHAR(32)
);

CREATE TABLE states
(
  states_id           INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  states_name          VARCHAR(32),
  states_abbreviation  VARCHAR(32)
);

CREATE TABLE visits
(
  id            INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  person_id     INTEGER,
  state_id      INTEGER,
  date_visited  VARCHAR(32)
);
