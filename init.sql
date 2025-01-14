-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(50) CHECK(role IN ('user', 'coach')) NOT NULL,
    status VARCHAR(50) CHECK(status IN ('available', 'unavailable')) DEFAULT 'unavailable',
    profile_picture VARCHAR(255) DEFAULT 'default.jpg'
);

-- Table des coachs (même que celle des utilisateurs mais avec plus de détails)
CREATE TABLE IF NOT EXISTS coaches (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    bio TEXT,
    video_url VARCHAR(255),
    status VARCHAR(50) CHECK(status IN ('available', 'unavailable')) DEFAULT 'unavailable'
);

-- Table des sports
CREATE TABLE IF NOT EXISTS sports (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL
);

-- Table des préférences sportives des utilisateurs
CREATE TABLE IF NOT EXISTS user_sports (
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    sport_id INT REFERENCES sports(id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, sport_id)
);

-- Table des messages entre utilisateurs et coachs
CREATE TABLE IF NOT EXISTS messages (
    id SERIAL PRIMARY KEY,
    sender_id INT REFERENCES users(id) ON DELETE CASCADE,
    receiver_id INT REFERENCES users(id) ON DELETE CASCADE,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des avis
CREATE TABLE IF NOT EXISTS reviews (
    id SERIAL PRIMARY KEY,
    coach_id INT REFERENCES coaches(id) ON DELETE CASCADE,
    user_id INT REFERENCES users(id) ON DELETE CASCADE,
    rating INT CHECK(rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des séances de sport
CREATE TABLE IF NOT EXISTS sessions (
    id SERIAL PRIMARY KEY,
    coach_id INT REFERENCES users(id) ON DELETE CASCADE,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des sports
INSERT INTO sports (name) VALUES ('Football');
INSERT INTO sports (name) VALUES ('Basketball');
INSERT INTO sports (name) VALUES ('Tennis');
INSERT INTO sports (name) VALUES ('Natation');
INSERT INTO sports (name) VALUES ('Cyclisme');