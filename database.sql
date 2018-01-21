CREATE TABLE types (
    t_id INT NOT NULL AUTO_INCREMENT,
    t_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (t_id)
);

CREATE TABLE families (
    fa_id INT NOT NULL AUTO_INCREMENT,
    fa_name VARCHAR(30) NOT NULL,
    fa_stars INT NOT NULL,
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

CREATE TABLE categories (
    cat_id INT NOT NULL AUTO_INCREMENT,
    cat_label VARCHAR(30) NOT NULL,
    PRIMARY KEY (cat_id)
);

CREATE TABLE compos (
    comp_id INT NOT NULL AUTO_INCREMENT,
    comp_leader INT NOT NULL,
    comp_shortDesc VARCHAR(500),
    comp_desc INT,
    comp_cat INT NOT NULL,
    PRIMARY KEY (comp_id),
    FOREIGN KEY (comp_leader) REFERENCES monsters(m_id),
    FOREIGN KEY (comp_cat) REFERENCES categories(cat_id)
);

CREATE TABLE compos_monsters (
    cm_id INT NOT NULL AUTO_INCREMENT,
    cm_compo INT NOT NULL,
    cm_monster INT NOT NULL,
    PRIMARY KEY (cm_id),
    FOREIGN KEY (cm_compo) REFERENCES compos(comp_id),
    FOREIGN KEY (cm_monster) REFERENCES monsters(m_id)
);

CREATE TABLE runages (
    ru_id INT NOT NULL AUTO_INCREMENT,
    ru_txt TEXT NOT NULL,
    PRIMARY KEY (ru_id)
);

CREATE TABLE sets (
    set_id INT NOT NULL AUTO_INCREMENT,
    set_name VARCHAR(30) NOT NULL,
    set_size INT NOT NULL,
    PRIMARY KEY (set_id)
);

CREATE TABLE sets_runages (
    sr_runage INT NOT NULL,
    sr_set INT NOT NULL,
    PRIMARY KEY (sr_runage, sr_set),
    FOREIGN KEY (sr_runage) REFERENCES runages(ru_id),
    FOREIGN KEY (sr_set) REFERENCES sets(set_id)
);

CREATE TABLE stats_list (
    sl_id INT NOT NULL AUTO_INCREMENT,
    sl_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (sl_id)
);

CREATE TABLE stats (
    stat_id INT NOT NULL AUTO_INCREMENT,
    stat_name INT NOT NULL,
    stat_importance INT NOT NULL,
    stat_value VARCHAR(30),
    PRIMARY KEY (stat_id),
    FOREIGN KEY (stat_name) REFERENCES stats_list(sl_id)
);

CREATE TABLE stats_runages (
    sru_runage INT NOT NULL,
    sru_stat INT NOT NULL,
    PRIMARY KEY (sru_runage, sru_stat),
    FOREIGN KEY (sru_runage) REFERENCES runages(ru_id),
    FOREIGN KEY (sru_stat) REFERENCES stats(stat_id)
);

CREATE TABLE monstres_runages (
    mr_runage INT NOT NULL,
    mr_monstre INT NOT NULL,
    mr_compo INT NOT NULL,
    mr_txt TEXT NOT NULL,
    PRIMARY KEY (mr_runage, mr_monstre, mr_compo),
    FOREIGN KEY (mr_runage) REFERENCES runages(ru_id),
    FOREIGN KEY (mr_monstre) REFERENCES monsters(m_id),
    FOREIGN KEY (mr_compo) REFERENCES compos(comp_id)
);

CREATE TABLE places (
    p_id INT NOT NULL AUTO_INCREMENT,
    p_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (p_id)
);

CREATE TABLE monsters_places (
    mp_monster INT NOT NULL,
    mp_place INT NOT NULL,
    PRIMARY KEY (mp_monster, mp_place),
    FOREIGN KEY (mp_monster) REFERENCES monsters(m_id),
    FOREIGN KEY (mp_place) REFERENCES places(p_id)
);
