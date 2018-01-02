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

CREATE TABLE guild (
    g_id INT NOT NULL AUTO_INCREMENT,
    g_mdp VARCHAR(10) NOT NULL,
    g_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (g_id)
);

CREATE TABLE user_guild (
    ug_user INT NOT NULL,
    ug_guild INT NOT NULL,
    PRIMARY KEY (ug_user),
    FOREIGN KEY (ug_user) REFERENCES users(u_id),
    FOREIGN KEY (ug_guild) REFERENCES guild(g_id)
);

CREATE TABLE logos (
    logo_id INT NOT NULL AUTO_INCREMENT,
    logo_user INT NOT NULL,
    logo_monster INT,
    logo_img INT NOT NULL,
    PRIMARY KEY (logo_id),
    FOREIGN KEY (logo_user) REFERENCES users(u_id),
    FOREIGN KEY (logo_monster) REFERENCES monsters(m_id),
    FOREIGN KEY (logo_img) REFERENCES images(img_id)
);
