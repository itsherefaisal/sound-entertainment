CREATE DATABASE sound_entertainment;
USE sound_entertainment;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('ADMIN', 'USER') DEFAULT 'USER',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE artists (
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    bio TEXT,
    image_url VARCHAR(255)
);

CREATE TABLE albums (
    album_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    release_year INT,
    description TEXT,
    cover_image VARCHAR(255)
);


CREATE TABLE music (
    music_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    language ENUM('ENGLISH', 'REGIONAL') NOT NULL,
    year YEAR NOT NULL,
    album_id INT NOT NULL,
    artist_id INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    cover_image VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    is_new BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (album_id) REFERENCES albums(album_id) ON DELETE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES artists(artist_id) ON DELETE CASCADE
);

CREATE TABLE genres (
    genre_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE videos (
    video_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    language ENUM('ENGLISH', 'REGIONAL') NOT NULL,
    year YEAR NOT NULL,
    genre_id INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    cover_image VARCHAR(255) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    is_new BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id) ON DELETE CASCADE
);

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('MUSIC', 'VIDEO') NOT NULL,
    item_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    CONSTRAINT fk_music_video
        FOREIGN KEY (item_id) REFERENCES 
            (SELECT music_id FROM music UNION SELECT video_id FROM videos) ON DELETE CASCADE
);
