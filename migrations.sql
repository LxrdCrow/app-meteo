-- create users table --
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- create locations table --
CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city_name VARCHAR(100),
    latitude FLOAT,
    longitude FLOAT
);

-- create forecasts table --
CREATE TABLE forecasts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT,
    date DATE,
    temperature FLOAT,
    description VARCHAR(255),
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

-- create weather data table --
CREATE TABLE weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT,
    temperature FLOAT,
    humidity INT,
    description VARCHAR(255),
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

-- create user preferences table --
CREATE TABLE user_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    location_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (location_id) REFERENCES locations(id)
);

