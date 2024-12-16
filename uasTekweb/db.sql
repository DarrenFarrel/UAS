create table user_admin(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username varchar(100) NOT NULL,
    password varchar(200) NOT NULL,
    nama_admin varchar(100),
    status_aktif boolean default 1
    );

create table transaksi_resi(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_resi varchar(100) NOT NULL UNIQUE,
    tanggal_resi DATE NOT NULL
    );

create table detail_log(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_resi varchar(100) NOT NULL,
    tanggal DATE NOT NULL,
    kota varchar(100) NOT NULL,
    keterangan varchar(200) NOT NULL,
    FOREIGN KEY(nomor_resi) REFERENCES transaksi_resi(nomor_resi) ON DELETE CASCADE
    );