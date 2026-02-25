CREATE TABLE tbl_user (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    email VARCHAR(128) NOT NULL
);

INSERT INTO tbl_user (username, password, email) VALUES ('test1', '$2y$10$Qv4t804YNwQuZVMCdDS8A.whn9XW2ZVN3qiztkvScRGpXtDot2K0K', 'test1@example.com');
