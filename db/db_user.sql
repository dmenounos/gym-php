-- Create a user for the schema (optional)

CREATE USER 'gym_db'@'%' IDENTIFIED BY 'gym_db';
GRANT ALL PRIVILEGES ON gym_db.* TO 'gym_db'@'%';
