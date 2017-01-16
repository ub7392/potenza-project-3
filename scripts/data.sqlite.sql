INSERT INTO states
  (state_name, state_abbreviation) VALUES
  ('Louisiana', 'LA'),
  ('Texas', 'TX'),
  ('Alabama', 'AL'),
  ('Mississippi', 'MS'),
  ('Florida', 'FL'),
  ('California', 'CA'),
  ('New York', 'NY'),
  ('Colorado', 'CO'),
  ('Utah', 'UT'),
  ('Tennessee', 'TN');

INSERT INTO people
    (first_name, last_name, favorite_food) VALUES
    ('Laura', 'Bui', 'Potatoes');

INSERT INTO people
    (first_name, last_name, favorite_food) VALUES
    ('Kurt', 'Venable', 'Rice Dressing');

INSERT INTO visits
    (person_id, state_id, date_visited) VALUES
    ('1', '1', '01/01/01');

INSERT INTO visits
    (person_id, state_id, date_visited) VALUES
    ('1', '10', '10/10/10');
