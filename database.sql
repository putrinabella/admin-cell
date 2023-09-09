CREATE DATABASE dbproject

CREATE TABLE tbluser (
    username VARCHAR(255) PRIMARY KEY,
    PASSWORD VARCHAR(255),
    nama VARCHAR(255),
    ROLE VARCHAR(255)
);

INSERT INTO tbluser (username, PASSWORD, nama, ROLE)
VALUES ('admin', 'admin', 'admin', 'Admin');


CREATE TABLE tbloperator (
    idOperator INT AUTO_INCREMENT PRIMARY KEY,
    namaOperator VARCHAR(255)
);
CREATE TABLE tblpaket (
    idPaket INT AUTO_INCREMENT PRIMARY KEY,
    idOperator INT,
    namaPaket VARCHAR(255),
    deskripsi TEXT,
    harga DECIMAL(10, 2),
    hargaJual DECIMAL(10, 2),
    keuntungan DECIMAL(10, 2)
);
CREATE TABLE tbltransaksipembelian (
    idTransaksi INT AUTO_INCREMENT PRIMARY KEY,
    nohp VARCHAR(255),
    idOperator INT,
    idPaket INT,
    username VARCHAR(255)
);
CREATE TABLE tbljenis (
    idJenis INT AUTO_INCREMENT PRIMARY KEY,
    jenisBarang VARCHAR(255)
);

