CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    email VARCHAR(60) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    -- Toto je dôležité pridať:
    PRIMARY KEY (id)
);


CREATE TABLE comments (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    comment_text TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    users_id INT(11),
    PRIMARY KEY (id),
    CONSTRAINT FK_user_comment FOREIGN KEY (users_id) 
        REFERENCES users(id) ON DELETE SET NULL
);
