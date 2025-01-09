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
    comment TEXT
);