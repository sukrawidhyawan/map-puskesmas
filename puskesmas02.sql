/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.26 : Database - gis_puskesmas02
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gis_puskesmas02` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `gis_puskesmas02`;

/*Table structure for table `tb_agenda_kegiatan` */

DROP TABLE IF EXISTS `tb_agenda_kegiatan`;

CREATE TABLE `tb_agenda_kegiatan` (
  `id_agenda` int(11) unsigned NOT NULL,
  `nama_angenda` varchar(200) DEFAULT NULL,
  `id_puskesmas` int(11) DEFAULT NULL,
  `tgl_agenda` date DEFAULT NULL,
  `status_angenda` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_agenda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_agenda_kegiatan` */

insert  into `tb_agenda_kegiatan`(`id_agenda`,`nama_angenda`,`id_puskesmas`,`tgl_agenda`,`status_angenda`) values (0,NULL,NULL,NULL,0);

/*Table structure for table `tb_fasilitas` */

DROP TABLE IF EXISTS `tb_fasilitas`;

CREATE TABLE `tb_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_fasilitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_fasilitas` */

insert  into `tb_fasilitas`(`id_fasilitas`,`nama_fasilitas`) values (1,'Apotek'),(2,'Unit Gawat Darurat'),(3,'klinik VCT'),(4,'Ruang Konsultasi/Konseling'),(5,'Ruang Bersalin'),(6,'Ruang Periksa'),(7,'Ruang Nifas');

/*Table structure for table `tb_fasilitas_detail` */

DROP TABLE IF EXISTS `tb_fasilitas_detail`;

CREATE TABLE `tb_fasilitas_detail` (
  `id_det_fasilitas` int(11) NOT NULL,
  `id_puskesmas` int(11) DEFAULT NULL,
  `id_fasilitas` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_fasilitas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_fasilitas_detail` */

insert  into `tb_fasilitas_detail`(`id_det_fasilitas`,`id_puskesmas`,`id_fasilitas`,`jumlah`) values (1,1,3,1),(2,1,1,1),(3,1,2,1),(4,5,2,1),(5,2,6,1),(6,3,6,1);

/*Table structure for table `tb_login` */

DROP TABLE IF EXISTS `tb_login`;

CREATE TABLE `tb_login` (
  `id_login` int(5) unsigned NOT NULL,
  `nama_user` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_login` */

insert  into `tb_login`(`id_login`,`nama_user`,`password`,`jabatan`) values (1,'admin','admin','admin');

/*Table structure for table `tb_poli` */

DROP TABLE IF EXISTS `tb_poli`;

CREATE TABLE `tb_poli` (
  `id_poli` int(11) unsigned NOT NULL,
  `nama_poli` varbinary(200) DEFAULT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id_poli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_poli` */

insert  into `tb_poli`(`id_poli`,`nama_poli`,`deskripsi`) values (1,'Poli KB','bla baa bla bala bla baa asba aba aaba aba ababaas\n'),(2,'Poli Umum',NULL),(3,'Poli Gigi',NULL),(4,'Poli KIA-KB',NULL),(5,'Poli VCT',NULL),(6,'hhh','sss');

/*Table structure for table `tb_poli_detail` */

DROP TABLE IF EXISTS `tb_poli_detail`;

CREATE TABLE `tb_poli_detail` (
  `id_det_poli` int(11) NOT NULL,
  `id_poli` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_det_poli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_poli_detail` */

/*Table structure for table `tb_puskesmas` */

DROP TABLE IF EXISTS `tb_puskesmas`;

CREATE TABLE `tb_puskesmas` (
  `id_puskesmas` int(3) unsigned NOT NULL,
  `nama_puskesmas` varchar(200) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(200) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `id_jns_puskesmas` int(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_puskesmas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_puskesmas` */

insert  into `tb_puskesmas`(`id_puskesmas`,`nama_puskesmas`,`alamat`,`no_hp`,`lat`,`lng`,`id_jns_puskesmas`) values (1,'Puskesmas Kuta selatan','Jl. Sri Kandi No.40 A Nusa Dua ','0361-771957 ',-8.803265,115.222923,1),(2,'Puskemas Pembantu Kutuh','Desa Kutuh Kec. Kuta Selatan','0361-771957 ',-8.828014,115.183121,2),(3,'Puskesmas Pembantu Tanjung Benoa',' Br.Tanjung Benoa, Kel. Tanjung Benoa','0361-771957 ',-8.760782,115.221664,2),(4,'Puskesmas Pembantu Unggasan','Desa Unggasan (depan Kantor Kepala Desa Ungasan)','0361-771957 ',-8.828248,115.155968,2),(5,'Puskesmas Kuta I','Jl.Raya Kuta No.117 Kuta ','0361-751311 ',-8.722600,115.177994,1);

/*Table structure for table `tb_puskesmas_jns` */

DROP TABLE IF EXISTS `tb_puskesmas_jns`;

CREATE TABLE `tb_puskesmas_jns` (
  `id_jns_puskesmas` int(11) DEFAULT NULL,
  `nama_jenis` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_puskesmas_jns` */

insert  into `tb_puskesmas_jns`(`id_jns_puskesmas`,`nama_jenis`) values (1,'Puskesmas Kecamatan'),(2,'Puskesmas Pembantu');

/*Table structure for table `tb_puskesmas_pembantu` */

DROP TABLE IF EXISTS `tb_puskesmas_pembantu`;

CREATE TABLE `tb_puskesmas_pembantu` (
  `id_pp` int(11) NOT NULL,
  `id_pukesmas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_puskesmas_pembantu` */

insert  into `tb_puskesmas_pembantu`(`id_pp`,`id_pukesmas`) values (2,1),(3,1),(4,1);

/*Table structure for table `tb_tenaga_medis` */

DROP TABLE IF EXISTS `tb_tenaga_medis`;

CREATE TABLE `tb_tenaga_medis` (
  `id_tng_medis` int(11) unsigned NOT NULL,
  `nama_tng` varchar(225) DEFAULT NULL,
  `id_puskesmas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tng_medis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_tenaga_medis` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
