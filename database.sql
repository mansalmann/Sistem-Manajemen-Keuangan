-- Active: 1718988390761@@127.0.0.1@3306@manajemen_keuangan
CREATE DATABASE manajemen_keuangan;
CREATE DATABASE manajemen_keuangan_test;

CREATE TABLE users(
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE sessions(
    id VARCHAR(255) PRIMARY KEY,
    user_id VARCHAR(255) NOT NULL
);

CREATE TABLE informasi_keuangan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_kategori ENUM("Pemasukan","Pengeluaran") NOT NULL DEFAULT "Pemasukan",
    sub_kategori VARCHAR(255) NOT NULL,
    jumlah DECIMAL(20,2) UNSIGNED NOT NULL DEFAULT 0,
    deskripsi VARCHAR(255),
    waktu_transaksi TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE kategori(
    jenis_kategori ENUM("Pemasukan","Pengeluaran") NOT NULL DEFAULT "Pemasukan",
    sub_kategori VARCHAR(255) NOT NULL PRIMARY KEY
);

INSERT INTO kategori(
    jenis_kategori,sub_kategori) VALUES("Pemasukan","Gaji"),("Pemasukan","Hibah"), ("Pemasukan","Asuransi"), ("Pengeluaran","Elektronik"), ("Pengeluaran","Transportasi"), ("Pengeluaran","Rumah Tangga");

ALTER TABLE informasi_keuangan
ADD CONSTRAINT fk_sub_kategori
FOREIGN KEY (sub_kategori) REFERENCES kategori(sub_kategori);

ALTER TABLE sessions
add constraint fk_sessions_users
FOREIGN KEY (user_id) REFERENCES users(id);

