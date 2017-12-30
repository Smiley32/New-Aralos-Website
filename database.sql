CREATE TABLE types (
    t_id INT NOT NULL AUTO_INCREMENT,
    t_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (t_id)
);

CREATE TABLE families (
    fa_id INT NOT NULL AUTO_INCREMENT,
    fa_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (fa_id)
);

CREATE TABLE images (
    img_id INT NOT NULL AUTO_INCREMENT,
    img_name VARCHAR(32) NOT NULL,
    PRIMARY KEY (img_id)
);

CREATE TABLE monsters (
    m_id INT NOT NULL AUTO_INCREMENT,
    m_name VARCHAR(30) NOT NULL,
    m_englishName VARCHAR(30),
    m_stars INT NOT NULL,
    m_shortDesc VARCHAR(500),
    m_img INT,
    m_family INT NOT NULL,
    m_type INT NOT NULL,
    PRIMARY KEY (m_id),
    FOREIGN KEY (m_img) REFERENCES images(img_id),
    FOREIGN KEY (m_family) REFERENCES families(fa_id),
    FOREIGN KEY (m_type) REFERENCES types(t_id)
);

CREATE TABLE users (
    u_id INT NOT NULL AUTO_INCREMENT,
    u_pseudo VARCHAR(30) NOT NULL,
    u_hash VARCHAR(255) NOT NULL,
    u_bestMonster INT,
    u_mail VARCHAR(255),
    PRIMARY KEY (u_id),
    FOREIGN KEY (u_bestMonster) REFERENCES monsters(m_id)
);