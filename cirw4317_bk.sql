-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 07 Okt 2018 pada 18.18
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cirw4317_bk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'siswa', 'Untuk Siswa SMK Muhammadiyah 1 Bambanglipuro');

-- --------------------------------------------------------

--
-- Struktur dari tabel `industri`
--

CREATE TABLE `industri` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `about` text,
  `website` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `location` varchar(25) DEFAULT NULL,
  `address` text,
  `foto` varchar(100) DEFAULT NULL,
  `thumb_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `industri`
--

INSERT INTO `industri` (`id`, `name`, `description`, `about`, `website`, `phone`, `location`, `address`, `foto`, `thumb_foto`) VALUES
(1, 'Mangrove Printing OKE', 'Perusahaan Percetakaan', 'Mangrove Digital Printing adalah Badan Usaha yang bergerak di Digital Printing dengan harga Termurah di Jogja', 'http://mangroveprinting.com', '0274-450630', 'Yogyakarta', 'Jl. Mayjen Sutoyo No. 87 A, Mantrijeron, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55143', 'mangrove printing.png', 'mangrove printing_thumb.png'),
(4, 'PT Karya Anak Bangsa', 'Perusahaan Teknologi Informasi', 'Bermula di tahun 2010 sebagai perusahaan transportasi roda dua melalui panggilan telepon, GO-JEK kini telah tumbuh menjadi on-demand mobile platform dan aplikasi terdepan yang menyediakan berbagai layanan lengkap mulai dari transportasi, logistik, pembayaran, layan-antar makanan, dan berbagai layanan on-demand lainnnya.\r\nGO-JEK adalah sebuah perusahaan teknologi berjiwa sosial yang bertujuan untuk meningkatkan kesejahteraan pekerja di berbagai sektor informal di Indonesia. Kegiatan GO-JEK bertumpu pada 3 nilai pokok: kecepatan, inovasi, dan dampak sosial.\r\n\r\nPara driver GO-JEK mengatakan bahwa pendapatan mereka meningkat semenjak bergabung sebagai mitra dengan mendapatkan akses ke lebih banyak pelanggan melalui aplikasi kami. Mereka juga mendapatkan santunan kesehatan dan kecelakaan, akses kepada lembaga keuangan dan asuransi, cicilan otomatis yang terjangkau, serta berbagai fasilitas yang lain.\r\n\r\nGO-JEK telah beroperasi di 50 kota di Indonesia, seperti Jakarta, Bandung, Surabaya, Bali, Makassar, Medan, Palembang, Semarang, Yogyakarta, Balikpapan, Malang, Solo, Manado, Samarinda, Batam, Sidoarjo, Gresik, Pekanbaru, Jambi, Sukabumi, Bandar Lampung, Padang, Pontianak, Banjarmasin, Mataram, Kediri, Probolinggo, Pekalongan, Karawang, Madiun, Purwokerto, Cirebon, Serang, Jember, Magelang, Tasikmalaya, Belitung, Banyuwangi, Salatiga, Garut, Bukittinggi, Pasuruan, Tegal,Sumedang, Banda Aceh, Mojokerto, Cilacap, Purwakarta, Pematang Siantar, dan Madura serta pengembangan di kota-kota lainnya pada tahun mendatang.', 'http://www.go-jek.com/careers', '0231222444', 'Kota Yogyakarta', 'JL. Tentara Zeni Pelajar No.18 Kelurahan Bumijo, Jetis Yogyakarta ', '165e89f92ff70fb690b2408384d53bd2.jpg', '165e89f92ff70fb690b2408384d53bd2_thumb.jpg'),
(5, 'Cirebonjeh.com', 'Perusahaan Media Informasi', 'Cirebonjeh.com merupakan portal media informasi dan publikasi dalam mengembangkan informasi tentang Cirebon guna menambah wawasan masyarakat menganai hal apa pun baik siata, tempat, dan gaya hidup yang ada di Cirebon dan sekitarnya.\r\n\r\n“Jeh”\r\nmerupakan kata sangat umum digunakan oleh masyarakat Cirebon, sebuah kata imbuhan yang menambah ciri khas khusus dari masyarakatnya terhadap Cirebon.\r\n\r\nPerekembangan Cirebon yang semakin pesat ini Harapan adanya Cirebonjeh dapat membantu dan mengembangkan informasi tentang Cirebon yang dibutuhkan oleh masyarakat.', 'https://cirebonjeh.com', '082219259952', 'Kota Cirebon', 'Jl.Swasembada No.14, Kav Cimanuk Majasem RT:03/RW:14', '2b6c71f54927277a5b4f75620e7f0443.jpg', '2b6c71f54927277a5b4f75620e7f0443_thumb.jpg'),
(6, 'PT.Astra Honda Motor', 'Industri Ototmotif ', 'PT.Astra Honda Motor (AHM) merupakan sinergi keunggulan teknologi dan jaringan pemasaran di Indonesia, sebuah pengembangan kerja sama anatara Honda Motor Company Limited, Jepang, dan PT Astra International Tbk, Indonesia. Keunggulan teknologi Honda Motor diakui di seluruh dunia dan telah dibuktikan dalam berbagai kesempatan, baik di jalan raya maupun di lintasan balap. Honda pun mengembangkan teknologi yang mampu menjawab kebutuhan pelanggan yaitu mesin “bandel” dan irit bahan bakar, sehingga menjadikannya sebagai pelopor kendaraan roda dua yang ekonomis.', 'http://www.astra-honda.com', ' 021 6518080', 'Kota Jakarta', 'Jl. Laksda Yos Sudarso, Sunter 1 Jakarta 14350', '8c6228306bb0d9d90c99ede41efce8e5.png', '8c6228306bb0d9d90c99ede41efce8e5_thumb.png'),
(7, 'PT.Yamaha Indonesia Motor', 'Perseroan terbatas Industri Otomotif', 'Yamaha Indonesia Motor Manufacturing (YIMM) adalah sebuah perusahaan yang memproduksi sepeda motor. Perusahaan ini didirikan pada 6 Juli 1974. Pabrik sepeda motor Yamaha mulai beroperasi di Indonesia sekitar tahun 1969, sebagai suatu usaha perakitan saja, semua komponen didatangkan dari Jepang.', 'https://www.yamaha-motor.co.id', '0214616995', 'Kota Jakarta', '(Jl. Raya Bekasi Km 23) Pulo Gadung Jakarta 13920, Indonesia', '42671ed0ecb2addec71fc7f89a9c870e.png', '42671ed0ecb2addec71fc7f89a9c870e_thumb.png'),
(8, 'PT.Telkom Indonesia', 'Pelayanan teknologi informasi dan komunikasi', 'TENTANG TELKOMGROUP\r\n \r\nPT Telkom Indonesia (Persero) Tbk (Telkom) adalah Badan Usaha Milik Negara (BUMN) yang bergerak di bidang jasa layanan teknologi informasi dan komunikasi (TIK) dan jaringan telekomunikasi di Indonesia. Pemegang saham mayoritas Telkom adalah Pemerintah Republik Indonesia sebesar 52.09%, sedangkan 47.91% sisanya dikuasai oleh publik. Saham Telkom diperdagangkan di Bursa Efek Indonesia (BEI) dengan kode “TLKM” dan New York Stock Exchange (NYSE) dengan kode “TLK”.\r\n \r\nDalam upaya bertransformasi menjadi digital telecommunication company, TelkomGroup mengimplementasikan strategi bisnis dan operasional perusahaan yang berorientasi kepada pelanggan (customer-oriented). Transformasi tersebut akan membuat organisasi TelkomGroup menjadi lebih lean (ramping) dan agile (lincah) dalam beradaptasi dengan perubahan industri telekomunikasi yang berlangsung sangat cepat. Organisasi yang baru juga diharapkan dapat meningkatkan efisiensi dan efektivitas dalam menciptakan customer experience yang berkualitas.\r\n \r\nKegiatan usaha TelkomGroup bertumbuh dan berubah seiring dengan perkembangan teknologi, informasi dan digitalisasi, namun masih dalam koridor industri telekomunikasi dan informasi. Hal ini terlihat dari lini bisnis yang terus berkembang melengkapi legacy yang sudah ada sebelumnya.\r\n \r\nSaat ini TelkomGroup mengelola 6 produk portofolio yang melayani empat segmen konsumen, yaitu korporat, perumahan, perorangan dan segmen konsumen lainnya.\r\n\r\nEmail: corporate_comm@telkom.co.id', 'https://rekrutmen.telkom.co.id/', '+622180863539', 'Kota Jakarta', 'Telkom Landmark Tower, Lantai 39  JL. Jendral Gatot Subroto Kav. 52  Jakarta Selatan  DKI Jakarta, 12710  Indonesia  ', 'd2d48c08ddee783fd74cfb30f95b4cad.png', 'd2d48c08ddee783fd74cfb30f95b4cad_thumb.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `katagori`
--

CREATE TABLE `katagori` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `katagori`
--

INSERT INTO `katagori` (`id`, `name`, `description`) VALUES
(1, 'Administrasi', 'Perkantoran / Umum / Sekertaris'),
(2, 'Manajemen', 'Perbankan / Akuntansi / Pemasaran'),
(3, 'Bangunan/Konstruksi', 'Arsitek / Desain Interior / Properti / Sipil / Konstruksi Bangunan'),
(4, 'Multimedia', 'Desain / Video editor / Fotografer / Periklanan'),
(5, 'Ilmu Pengetahuan', 'Geodesi / Pertanian / Perkebunan / Peternakan'),
(6, 'Keahlian Teknik', 'Elektro / Industri / Otomotif / Mesin / Telekomunikasi / Pertambangan'),
(7, 'Pelayanan Jasa', 'Teknisi / Penjahit / Juru Masak / Kurir / dll'),
(8, 'Teknologi Informasi ', 'TI / Software Development / Web Development / Jaringan / Hardware'),
(11, 'Akuntansi', 'Umum/ Perbankan / Keuangan/Kantor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(15) NOT NULL,
  `requirement` text NOT NULL,
  `sallary` bigint(11) NOT NULL,
  `date_expired` date NOT NULL,
  `date_modify` date NOT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `filedoc` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id`, `name`, `description`, `type`, `requirement`, `sallary`, `date_expired`, `date_modify`, `active`, `created_on`, `filedoc`) VALUES
(1, 'Web Developer', 'Mengerti HTML, PHP dan Angular JS', 'Full Time', 'Lulusan SMK', 1000000, '2018-06-13', '2018-06-01', 1, '0000-00-00 00:00:00', ''),
(2, 'Android Developer', 'Pendidikan minimal S1 jurusan Teknik Informatika/ Manajemen Informatika/ sejenisnya <br>Menguasai Xcode, Swift, Apple SDK, dan Objective-C (Nilai tambah)&nbsp;<br>Memahami Restful Service, iOS Architecture&nbsp;<br>Mengetahui cara bekerja menggunakan GIT&nbsp;<br>Familiar dengan scrum methodology&nbsp;<br>Mudah beradaptasi dan komunikasi&nbsp;<br>Mampu berkolaborasi dengan tim lain (designers, product managers, QA, dll)&nbsp;<br>Mempunyai semangat dan keinginan untuk belajar, jenis kerja dan tantangan yang selalu dinamis&nbsp;<br>', 'Full Time', 'Lulusan SMK							<br><div><b>Cantumkan :</b>&nbsp;Portofolio / Link karya yang pernah anda buat atau anda kembangkan !</div><div></div>', 1000000, '2018-05-15', '2018-07-20', 1, '0000-00-00 00:00:00', 'Contoh_Formulir5.doc'),
(3, 'Graphic Designer', 'Memhami Prinsip Desain Warna, dan UI UX', 'Full Time', 'Lulusan SMK', 1000000, '2018-06-23', '2018-06-01', 1, '0000-00-00 00:00:00', ''),
(4, 'Web Design', 'Memahami HTML dan PHP', 'Full Time', '<b>\r\n\r\n<p>\r\n\r\n</p><p></p></b><p>Syarat :</p><ul><li>Pria / wanita usia 18 - 23 tahun</li><li>Pendidikan minimal STM / SMK (TKR, TKJ, TSM, Otomotif, Audio, Listrik, Akuntansi, Administrasi, IPA)</li><li>Lulusan &amp; kelahiran jawa lebih diutamakan</li><li>Pengalaman / Non pengalaman</li><li>Diutamakan fresh graduate</li><li>TB minimal 163 cm &amp; wanita 153 cm</li><li>Siap kerja shift &amp; lembur sabtu - minggu</li><li>Tidak bertato / bertindik (bagi pria)</li><li>Tidak berkacamata / buta warna</li></ul><p>Persyaratan document :</p><ul><li>Fotocopy Ijazah</li><li>Fotocopy transkip nilai</li><li>Fotocopy e-KTP (bisa mengunakan resi)</li><li>Fotocopy kartu keluarga</li><li>fotocopy SKCK</li><li>Foto 2 lembar ukuran 4x6</li></ul><b><p></p></b>', 1000000, '2018-07-18', '2018-06-01', 1, '0000-00-00 00:00:00', ''),
(8, 'Android Programer', '<p>\r\n\r\n</p><p><i></i>Memahami Bahasa Pemrogamman / Terbiasa Dengan Bahasa Pemrogaman</p><ul><li>PHP HTML JS JQUERY</li></ul><ul><li>CODEIGNITER MYSQL HTML5</li></ul><ul><li>CSS3 BOOTSTRAP MVC OOP</li></ul><ul><li>(Webdev Full stack)</li></ul><p></p>', 'Full Time', '<ul><li>Laki - Laki</li><li>Pendidikan D3.T.Elekotro / T. Informatika</li><li>SMK T.Elektro / T.Listrik Dipersilahkan Melamar dengan pengalaman Min. 2 Th di Telekomunikasi dengan posisi yang sama</li><li>Dapat menggunakan: Site Master, Ber Test, dll</li><li>Pengalaman Dibidang pekerjaan instalasi BTS dan Microwave khususnya untuk perangkat Huawei dan Ericson min. 2 th</li><li>Tidak Takut Ketinggian atau Berani Naik Tower</li><li>Bersedia ditugaskan dimana saja</li><li>Penempatan di Bali &amp; Lombok</li></ul><p>Jenis Pekerjaan: Kontrak</p><p>Pengalaman yang dibutuhkan:</p><ul><li>instalasi BTS dan Microwave perangkat Huawei &amp; Ericson: 2 tahun</li></ul><p>Pendidikan yang dibutuhkan:</p><ul><li>SMU atau sederajat</li></ul><p>Lokasi Pekerjaan:</p><ul><li>Denpasar</li></ul>', 1312000, '2019-02-07', '2018-06-01', 1, '0000-00-00 00:00:00', ''),
(9, 'Teknik Pertanian ', '<p>Memahami Budidaya tanaman lokal</p>', 'Full Time', 'Lulusan SMK', 1300000, '2018-04-19', '2018-06-01', 1, '0000-00-00 00:00:00', ''),
(10, 'Data Analisis System', 'Menjawab pertanyaan-pertanyaan dengan menggunakan teknik statistik yang sesuai terhadap data-data yang tersedia. <br>Memiliki ketertarikan mengolah data/membuat visual dashboard.&nbsp;<br>Mengembangkan machine learning models dan NLP (Natural Language Processing) models yang kuat.&nbsp;<br>Mengekstrak volume data yang sangat besar dari berbagai sumber internal dan eksternal.&nbsp;<br>Mengembangkan data pipelines dan infrastruktur untuk menimbang analisis yang memungkinkan iterasi produk secara cepat.&nbsp;<br>Bekerja sama dengan Data Analysts, Software Engineers, dan tim Produk untuk menciptakan produk-produk unggulan dan ragam insight untuk Kompas Gramedia.&nbsp;<br>Merancang proses data mining dan arsitektur.&nbsp;<br>Menganalisa data dari berbagai sudut untuk menentukan kelemahan-kelemahan, tren, dan/atau peluang-peluang yang tersembunyi.&nbsp;<br>Menggunakan program-program analisis dan machine learning dalam menyiapkan data untuk digunakan dalam pemodelan prediktif &amp; preskriptif.', 'Full Time', 'Minimal lulusan S1 dari jurusan Matematika, Ilmu Komputer, Statistika, Fisika. <br>IPK minimal 2,75 (skala 4,00).&nbsp;<br>Pria/Wanita usia maksimal 30 tahun.&nbsp;<br>Berpengalaman minimal 3 tahun sebagai Data Scientist, Data Analyst, Data Engineer atau posisi yang serupa.&nbsp;<br>Berpengalaman minimal 2-3 tahun dengan language programming (R, Python, Scala, dll.).&nbsp;<br>Familiar dengan teknologi SQL, MySQL, Spark, Kafka, Talend, dan cloud based infrastructure (AWS, GCP, dll.).&nbsp;<br>Memiliki passion besar dalam big data dan software engineering.&nbsp;<br>Dapat bekerja sama dan berkolaborasi dengan tim, maupun secara individu.&nbsp;<br><b>Mahir dalam berbagai teknik modelling, misalnya:</b>&nbsp;Clustering, Classification, dan Regression.&nbsp;<br>Memiliki semangat tinggi dalam pengujian dan validasi model untuk membuat model yang akurat dan konsisten.', 2000000, '2018-07-18', '2018-06-01', 1, '2018-05-05 13:30:05', ''),
(11, 'Teknisi Kendaraan Motor', '<p>Memamahami cara reaparasi motor, terutama motor kopling dan matic</p>', 'Full Time', '<p></p><i></i>Lulusan SMK<i></i><br><small></small>Nilai UN rata rata 7,0<br>Berprilaku baik sopan dan jujur<br>', 1500000, '2018-05-31', '2018-06-01', 1, '2018-05-08 23:04:16', ''),
(13, 'Staff Multimedia', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Kontrak', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 1200000, '2018-07-19', '2018-09-09', 1, '2018-05-09 11:11:00', 'Contoh_Formulir53.doc'),
(26, 'Staff Perusahaan Perdagangan', 'Bali 3 Solid Group membuka kesempatan sebesar-besarnya bagi lulusan SMA/SMK sederajat tanpa pengalaman untuk menjadi karyawan di perusahaan Perdagangan terbesar Nasional dengan penempatan cabang Bali lokasi Kuta.', 'Full Time', '<p>Syarat :</p><p>1. Copy Ijasah SMA/SMK</p><p>2. Copy KTP/SIM</p><p>3. Bisa bekerja sama dalam tim</p><p>4. Diutamakan yang berDomisili area Kuta dan Denpasar (Bali)</p><p>5. Berpenampilan menarik dan rapi</p><p>Setelah apply lamaran dan CV, selanjutnya akan dihubungi via tlp dari bagian rekrutmen.</p><p>BENEFITS</p><p>1. Income, Komisi, Bonus, Reward</p><p>2. Fasilitas Ruangan Kerja nyaman full AC, Mobil operasional, Telepon kantor</p><p>3. Perjalanan ke Luar Negeri setiap 3 bulan</p><p>CP : Bpk Dewa 0.8.2.2.6.6.1.6.3.0.4.8.</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp3.000.000 hingga Rp5.000.000 /bulan</p><p>Lokasi:</p><ul><li>Kuta</li></ul>', 3000007, '2018-05-29', '2018-06-01', 1, '2018-05-25 02:06:44', ''),
(27, 'Staff Electrical & PLC di Bali', '<p>Dibutuhkan Cepat Tenaga Kerja Teknik Electrical dan PLC !</p><p>Interview langsung kerja.</p>', 'Full Time', '<p>Syarat :</p><p>- Laki-laki siap kerja di Bali</p><p>- Lulusan Minimal Smk /Diploma (Mekatronika), Sarjana Teknik Electro / Sederajat</p><p>- Memiliki Pengalaman di bidang Teknik Kelistrikan dan Maintenance minimal 1th</p><p>- Skill yang dibutuhkan: Memahami teknik electro, Panel Inverter, panel Control dan Pemrograman PLC</p><p>- Untuk ditempatkan di Nusa Dua - Bali.</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp3.000.000 hingga Rp4.000.000 /bulan</p><p>Pengalaman:</p><ul><li>engineering: 2 tahun</li></ul>', 12323242, '2018-05-31', '2018-06-01', 1, '2018-05-25 02:09:56', ''),
(28, 'Access Engineer Biznet Networks', '<p>Tekhnisi Lapangan Biznet Networks</p><p>Sigma SOlusi Servis bergerak dibidang Human Resourch Outsourching bekerjasama dengan Biznet Networks perusahaan yang bergerak di bidang ISP (Internet Service Provider) membutuhkan Tekhnisi Lapangan yang handal dan pengalamanPada JaringanInternet. Berikut kualifikasinya :</p>', 'Full Time', '<p>1. Laki-Laki Usia Maks. 27 tahun</p><p>2. Lulusan SMK Tekhnik Komputer Jaringan (Wajib)</p><p>3. Paham dengan Jaringan, Paham dengan Kabel LAN,MAN,WAN, Pandai Mengatasi Troubleshoot</p><p>4. TIDAK TAKUT KETINGGIAN</p><p>5. Memiliki Surat Keterangan Sehat</p><p>6. Memiliki SKCK</p><p>7. Wajib Memiliki SIM dan Kendaraan Bermotor</p><p>Benefit :</p><p>* Gaji UMR 2018</p><p>* Lemburan</p><p>* BPJS Kesehatan dan Ketengakerjaan</p><p>* Jenjang Karir</p><p>Berminat Bisa Hubungi :</p><p>Mba Siska : 0812 1168 4711</p><p>Mas Tezar : 0896 2676 4632</p><p>Datang Langsung Ke :</p><p>SIGMA SOLUSI SERVIS</p><p>Jl. Persada Raya No. 47 Menteng Dalam Tebet Saharjo JakSel</p><p>Patokannya Kanotr Kami Rumah Pertama DIbelakang RUKO U FINANCE SAHARJO atau belakang AUTO 2000 Saharjo</p><p>SENIN, 28 mei 2018</p><p>Pukul 09.00 s.d Pukul 14.00 Siang</p><p>Bertemu Mba Siska atau Mas Tezar</p><p>Note : Lowongan Ini Tidak Dipungut Biaya</p><p>Tidak Tahan Ijazah</p><p>Jenis Pekerjaan: Kontrak</p><p>Gaji: Rp3.648.035 hingga Rp3.688.035 /bulan</p><p>Pengalaman:</p><ul><li>Tekhnisi lapangan: 1 tahun</li></ul><p>Lokasi:</p><ul><li>Jakarta</li></ul><p>Lisensi (tidak wajib diisi):</p><ul><li>Packlaring dari Kantor Sebelumnya</li></ul>', 12312409, '2018-06-21', '2018-06-01', 1, '2018-05-25 02:16:01', ''),
(29, 'Staf IT', '<p>Tugas dan Tanggungjawab :</p><p>1. Membuat dan mengembangkan aplikasi yang dibutuhkan oleh perusahaan</p><p>2. Melakukan maintenance aplikasi untuk memastikan ketersediaan aplikasi yang menunjang kinerja</p><p>Kualifikasi :</p><p>1. Pria, usia maksimal 35 tahun</p><p>2. Pendidikan min. S1 Teknik Informatika/Sistem Informasi</p><p>3. Memiliki pengalaman min. 1 tahun di bidang IT Programmer</p><p>4. Menguasai sistem jaringan, troubleshooting, Java, bahasa pemrograman</p><p>5. Bersedia ditempatkan di Yogyakarta</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp1.500.000 hingga Rp1.600.000 /bulan</p><p>Pengalaman:</p><ul><li>IT Programmer: 1 tahun</li></ul><p>Pendidikan:</p><ul><li>Sarjana</li></ul>', 'Full Time', '<p>Tugas dan Tanggungjawab :</p><p>1. Membuat dan mengembangkan aplikasi yang dibutuhkan oleh perusahaan</p><p>2. Melakukan maintenance aplikasi untuk memastikan ketersediaan aplikasi yang menunjang kinerja</p><p>Kualifikasi :</p><p>1. Pria, usia maksimal 35 tahun</p><p>2. Pendidikan min. S1 Teknik Informatika/Sistem Informasi</p><p>3. Memiliki pengalaman min. 1 tahun di bidang IT Programmer</p><p>4. Menguasai sistem jaringan, troubleshooting, Java, bahasa pemrograman</p><p>5. Bersedia ditempatkan di Yogyakarta</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp1.500.000 hingga Rp1.600.000 /bulan</p><p>Pengalaman:</p><ul><li>IT Programmer: 1 tahun</li></ul><p>Pendidikan:</p><ul><li>Sarjana</li></ul>', 1231368, '2018-05-30', '2018-06-01', 1, '2018-05-25 02:45:16', ''),
(30, 'FRONTLINERS (PENEMPATAN : JAMBI)', 'Tugas &amp; tanggung jawab : <p></p><ul><li>Menangani aktivitas pelayanan pelanggan Yamaha yang berorientasi pada kepuasan pelanggan Yamaha.</li></ul>', 'Full Time', '<ul><li>Wanita, pendidikan SMA / SMK sederajat</li><li>Berpenampilan menarik</li><li>Aktif dan berorientasi pada kepuasan pelanggan</li><li>Memiliki kemampuan komunikasi yang baik</li></ul>', 0, '2018-06-28', '2018-09-09', 1, '2018-05-25 19:36:48', ''),
(31, 'Android Developer', 'mancasnc,', 'Full Time', 'masm cm,as&nbsp;', 1200000, '2018-05-31', '2018-06-01', 1, '2018-05-26 11:14:35', ''),
(32, 'Graphic Designer', 'Pria, maksimal usia 35 tahun<br>Diutamakan masih single<br>Pendidikan minimal S1 Graphic Design, DKV, Advertising, atau jurusan yang berhubungan dengan design<br>Pengalaman min. 3 tahun di advertising agency, media atau creatif butik<br>Mampu bekerja dibawah tekanan<br>Mampu dan menyelesaikan deadline dan timeline pekerjaan tepat waktu<br>Bisa flexible dengan waktu kerja (lembur)<br>', 'Kontrak', '<p>Job Type: Contract</p><p>Salary: Rp5,000,000 /month</p><p>Education:</p><ul><li>Bachelor\'s</li></ul><p>Location:</p><ul><li>Jakarta</li></ul>', 5000000, '2018-07-12', '2018-06-01', 1, '2018-05-26 11:17:28', ''),
(33, 'OPERATOR MANUFACTURING', 'Kami membuka kesempatan untuk lulusan terbaik dari SMU/SMK Sederajat, untuk bergabung bersama kami sebagai Operator di bagian produksi dan di bagian lain yang tidak berhubungan langsung dengan proses produksi.', 'Full Time', 'A. Kriteria Umum :<p></p><ol><li>Usia 18-20 tahun<p></p></li><li>Tidak pernah bekerja sebelumnya di PT. Yamaha Indonesia Motor Mfg.<p></p></li><li>Belum pernah menikah dan tidak sedang hamil<p></p></li><li>Pendidikan : SMU/ SMK diutamakan jurusan Mesin / Otomotif / Listrik / Elektro.<p></p></li><li>Dengan nilai raport rata-rata 6<p></p></li><li>Lulusan 3 tahun terakhir dan tidak sedang menjalani perkuliahan<p></p></li></ol>B. Kriteria Fisik :<p></p><ol><li>Tinggi badan laki-laki min.160 &amp; wanita min. 158cm, dengan berat badan ideal<p></p></li><li>Tidak memiliki kelainan mata (minus/plus/butawarna)<p></p></li><li>Pria : rambut rapi (maksimal panjang rambut 2 cm), Wanita : rambut rapi<p></p></li><li>Pria &amp; Wanita : tidak bertato&amp; tindik di telinga (khusus wanita : tindik &gt;1 pasang)<p></p></li><li>Memiliki semua bagian tubuh lengkap (tidak ada cacat tubuh)<p></p></li></ol>C. Kriteria Sikap &amp; Perilaku :<p></p>Memiliki semangat untuk bekerja, mau belajar, mampu bekerja di bawah tekanan, bersedia untuk bekerja lembur dan atau shift , sopan, jujur, tidak emosional .Tidak pernah terlibat narkoba, minuman keras, tindak kriminal, dan asusila', 0, '2018-06-30', '2018-06-23', 1, '2018-05-26 11:30:44', 'Contoh_Formulir5.doc'),
(34, 'Teknisi Mechanical Electrical (Teknisi ME)', '<p><b>Teknisi ME</b></p><p><b>PT. Dominoca Cipta Boga</b>&nbsp;membuka peluang bagi anda para kandidat unggulan untuk menempati posisi sebagai&nbsp;<b>Staff Teknisi ME</b>&nbsp;dengan kualifikasi berikut&nbsp;</p>', 'Kontrak', '<p>1. Usia Maksimal 28tahun.</p><p>2. Lulusan Minimal SMK elektro/SMK mesin dan minimal berpengalaman di bidangnya selama 2tahun.</p><p>3. Mampu menangani kerusakan alat2 kerja seperti AC,Chiller,Freezer,Showcase,dan barang elektronik dan mesin produksi lainnya.</p><p>4. Menyukai dunia lapangan(Kunjungan ke Outlet2 untuk pengecekan alat2 kerja secara berkala)</p><p>5. memiliki kendaraan bermotor sendiri</p><p>6. mempunyai mental teliti,cekatan,dan bertanggungjawab.</p><p>7. mampu bekerja di bawah tekanan</p><p>*) hanya yang sesuai kualifikasi di atas yang akan kami proses lebih lanjut.</p><p>Segera kirim aplikasi lamaran anda (CV dan data penunjang lainnya) via Aplikasi</p><p>atau</p><p>dapat di kirimkan via POS ke alamat :</p><p><b>PT. Dominoca Cipta Boga</b></p><p>jalan Taruna Jaya No. 22 Ciracas-Cibubur, Jakarta Timur</p><p>UP. Bpk Faris (HRD&amp;GA Manager)</p><p>Regards</p><p>HRD &amp; GA</p><p><b>PT. Dominoca Cipta Boga</b></p><p>Jenis Pekerjaan: Kontrak</p><p>Gaji: Rp 1.750.000 /bulan</p><p>Pengalaman:</p><ul><li>tenaga Teknisi ME: 2 tahun</li></ul><p>Pendidikan:</p><ul><li>SMU atau sederajat</li></ul><p>Lokasi:</p><ul><li>Jakarta</li></ul><p>Lisensi (tidak wajib diisi):</p><ul><li>SIM C dan sertifikat keahlian</li></ul>', 1750000, '2018-05-31', '2018-08-01', 1, '2018-05-28 00:50:01', ''),
(37, 'Customer Service', 'perusahaan yang bergerak di bidang ritel penjualan jam tangan. Kami membutuhkan tenaga-tenaga profesional muda yang enerjik dan bermotivasi tinggi untuk bergabung dan maju bersama kami.', 'Full Time', '<p><b>Posisi : CUSTOMER SERVICE</b></p><p><b>Persyaratan</b>&nbsp;:</p><p>1. Wanita, usia maksimal 26 tahun.</p><p>2. Minimal lulusan SMU/SMK. Lulusan S1 akan diprioritaskan.</p><p>3. Memiliki jiwa melayani, ramah dan sopan dalam bertutur kata.</p><p>4. Memiliki ketelitian kerja yang tinggi.</p><p>5. Mampu bekerja sesuai target waktu yang diberikan.</p><p><b>Lokasi kerja : Meruya, Jakarta Barat</b></p><p>Gaji : Negosiasi</p><p>Job Type: Contract</p><p>Experience:</p><ul><li>Customer Service: 1 year</li></ul><p>Education:</p><ul><li>High school or equivalent</li></ul>', 1200000, '2018-05-31', '2018-06-01', 1, '2018-05-28 12:14:17', 'Contoh_Formulir3.doc'),
(38, 'Staff Administrasi', '<p><b>JOB DESCRIPTION</b></p><ul><li>Umur maksimal 25 tahun</li><li>Minimal lulusan SMU/SMK atau D3</li><li>Diutamakan punya pengalaman di perusahaan dagang/retail</li><li>Motivasi kerja tinggi dan pembelajar cepat</li><li>Mempunyai kemampuan komunikasi dan kerja tim yang bagus</li><li>Manguasai MS Office dan internet</li><li>Bersedia bekerja di daerah Jakarta Selatan</li></ul>', 'Full Time', 'Kirim segera CV dan foto kamu via email ke HRD SAQINA.COM (hrd@saqina.com). Kamu yang terpilih akan langsung interview. <br><div><div><p>Minimal pengalaman kerja 1 tahun</p></div></div>', 0, '2018-05-31', '2018-06-01', 1, '2018-05-28 12:16:13', 'Contoh_Formulir2.doc'),
(39, 'Staff Gudang (Pria/wanita)', '<p>LOWONGAN STAFF GUDANG</p><p>Dibutuhkan karyawan untuk penempatan ;</p><p>* Jakarta Selatan</p><p>* Jakarta Barat</p><p>* Tangerang</p><p>* Jakarta timur</p><p>Kualifikasi ;</p><p>* Pria/wanita</p><p>* Usia antara 18- 29 thn</p><p>* Minimal lulusan SMA/SMK/sederajat</p><p>* Fresh graduate</p><p>* Siap bekerja keras</p><p>* Mampu bekerja dengan baik secara individu maupun kelompok</p><p>* Jujur diutamakan</p><p>Fasilitas ; gaji pokok, bonus, dll</p><p>Jika berminat silahkan hubungi ; 081210619784 (WA)</p><p>Atau dengan kirim CV apply online</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp3.500.000 hingga Rp4.000.000 /bulan</p>', 'Full Time', '<p>LOWONGAN STAFF GUDANG</p><p>Dibutuhkan karyawan untuk penempatan ;</p><p>* Jakarta Selatan</p><p>* Jakarta Barat</p><p>* Tangerang</p><p>* Jakarta timur</p><p>Kualifikasi ;</p><p>* Pria/wanita</p><p>* Usia antara 18- 29 thn</p><p>* Minimal lulusan SMA/SMK/sederajat</p><p>* Fresh graduate</p><p>* Siap bekerja keras</p><p>* Mampu bekerja dengan baik secara individu maupun kelompok</p><p>* Jujur diutamakan</p><p>Fasilitas ; gaji pokok, bonus, dll</p><p>Jika berminat silahkan hubungi ; 081210619784 (WA)</p><p>Atau dengan kirim CV apply online</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp3.500.000 hingga Rp4.000.000 /bulan</p>', 3000000, '2018-05-31', '2018-06-23', 1, '2018-05-28 16:28:48', 'Contoh_Formulir1.doc'),
(40, 'Teknisi Listrik', '<p>DIcari, Teknisi Listrik Untuk retail salah satu pusat perbelanjaan di daerah Canggu</p><p>Minimal Lulusan SMK Kelistrikan,</p><p>memiliki pengalaman dalam mengerjakan Listrik</p><p>Lampirkan CV anda..</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp2.500.000 hingga Rp3.000.000 /bulan</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp2.500.000 hingga Rp3.000.000 /bulan</p>', 'Full Time', '<p>DIcari, Teknisi Listrik Untuk retail salah satu pusat perbelanjaan di daerah Canggu</p><p>Minimal Lulusan SMK Kelistrikan,</p><p>memiliki pengalaman dalam mengerjakan Listrik</p><p>Lampirkan CV anda..</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp2.500.000 hingga Rp3.000.000 /bulan</p><p>Jenis Pekerjaan: Penuh Waktu</p><p>Gaji: Rp2.500.000 hingga Rp3.000.000 /bulan</p>', 2500000, '2018-06-30', '2018-05-31', 1, '2018-05-28 16:31:30', 'Contoh_Formulir.doc'),
(41, 'Lowongan Laravel Developer', 'Pria, maksimal usia 35 tahun<br>Diutamakan masih single<br>Pendidikan minimal S1 Graphic Design, DKV, Advertising, atau jurusan yang berhubungan dengan design<br>Pengalaman min. 3 tahun di advertising agency, media atau creatif butik<br>Mampu bekerja dibawah tekanan<br>Mampu dan menyelesaikan deadline dan timeline pekerjaan tepat waktu<br>Bisa flexible dengan waktu kerja (lembur)', 'Part Time', '<p>Job Type: Contract</p><p>Salary: Rp5,000,000 /month</p><p>Education:</p><ul><li>Bachelor\'s</li></ul><p>Location:</p><ul><li>Jakarta</li></ul>', 3000000, '2018-06-19', '2018-07-20', 1, '2018-06-06 14:06:27', 'Firebase_dengan_Rumahweb_com.docx'),
(42, 'Admin Website', 'Tugas dan Tanggung Jawab Membantu meningkatkan lead. Membuat landing page. Menjalankan campaign marketing. Menganalisa pasar. <br><br>Menganalisa marketing yang sedang dijalankan. Persyaratan Freshgraduate are welcome, berpengalaman (bernilai plus). Paham HTML Paham social media marketing Pendataan rapi teliti ketik 10 jari 40-60 WPM Analitis. Siap kontrak kerja 1 tahun.&nbsp;<br><br>Tidak sedang kuliah. Mengetahui tentang HTML dan Social Media. Siap bekerja dalam deadline. Amanah, detail dan pendataan rapi.&nbsp;<br><br>Sanggup kerja 8.00-17.00, Libur Minggu. Keuntungan Penempatan Yogyakarta. Gaji pokok. Insentif performa harian.&nbsp;<br><br>Bonus prestasi. Bonus hari raya. Free drink everyday (tea or coffee). Free pengembangan diri.&nbsp;<br><br>Suasana kerja profesional fun. Waktu Bekerja 08 00-17 00 WIB, Minggu libur.', 'Kontrak', 'TestTugas dan Tanggung Jawab Membantu meningkatkan lead. Membuat landing page. Menjalankan campaign marketing. Menganalisa pasar.&nbsp;<br><br>Menganalisa marketing yang sedang dijalankan. Persyaratan Freshgraduate are welcome, berpengalaman (bernilai plus). Paham HTML Paham social media marketing Pendataan rapi teliti ketik 10 jari 40-60 WPM Analitis. Siap kontrak kerja 1 tahun.&nbsp;<br><br>Tidak sedang kuliah. Mengetahui tentang HTML dan Social Media. Siap bekerja dalam deadline. Amanah, detail dan pendataan rapi.&nbsp;<br><br>Sanggup kerja 8.00-17.00, Libur Minggu. Keuntungan Penempatan Yogyakarta. Gaji pokok. Insentif performa harian.&nbsp;<br><br>Bonus prestasi. Bonus hari raya. Free drink everyday (tea or coffee). Free pengembangan diri.&nbsp;<br><br>Suasana kerja profesional fun. Waktu Bekerja 08 00-17 00 WIB, Minggu libur.', 1000000, '2018-06-29', '2018-07-20', 1, '2018-06-23 11:12:42', 'Contoh_Formulir4.doc'),
(48, 'Great People Trainee Program Batch VIII', 'Management, Strategic Planning, Social Community Development, Sales, Risk Management, Relationship Management, Regulatory Management &amp; Government, Marketing, Legal &amp; Compliance, Internal Audit, Information Technology, Human Capital, General Affairs, Finance, Digital Product &amp; Service, Corporate Communication, Business Effectiveness, Business Development<br>', 'Kontrak', '<ol><li>Lulusan D4 / S1 / S2 :<ul><li>Lulusan S1/D4 Fresh Graduate : belum berusia 24 tahun per 1 Juli 2018</li><li>Lulusan S1/D4 Berpengalaman (minimal 2 tahun) : belum berusia 27 tahun per 1 Juli 2018 yang dibuktikan dengan sertifikat / surat keterangan kerja </li><li>Lulusan S2 Fresh Graduate : belum berusia 27 tahun per 1 Juli 2018</li><li>Lulusan S2 Berpengalaman (minimal 2 tahun) : belum berusia 30 tahun per 1 Juli 2018 yang dibuktikan dengan sertifikat / surat keterangan kerja</li></ul></li><li>TOEFL PBT Min. 500 / IBT Min. 61 / IELTS Min. 6</li><li>Jurusan sesuai dengan bidang pekerjaan</li><li>Telah menyelesaikan masa studi dengan melampirkan ijazah atau SKL.</li><li>Bersedia ditempatkan di seluruh wilayah kerja PT. Telkom.</li><li>Bersedia menjalani ikatan dinas.</li><li>Hanya pelamar yg memenuhi kualifikasi &amp; persyaratan yang akan diproses</li></ol>', 1800000, '2018-07-31', '2018-09-09', 1, '2018-07-26 13:27:07', 'Contoh_Formulir52.doc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan_industri`
--

CREATE TABLE `lowongan_industri` (
  `id` int(11) UNSIGNED NOT NULL,
  `lowongan_id` int(11) UNSIGNED DEFAULT NULL,
  `industri_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `lowongan_industri`
--

INSERT INTO `lowongan_industri` (`id`, `lowongan_id`, `industri_id`) VALUES
(182, 1, 4),
(192, 2, 4),
(178, 3, 4),
(183, 4, 1),
(173, 8, 1),
(179, 9, 5),
(174, 10, 5),
(181, 11, 6),
(208, 13, 4),
(175, 26, 6),
(180, 27, 4),
(172, 28, 4),
(171, 29, 5),
(202, 30, 7),
(170, 31, 1),
(167, 32, 4),
(186, 33, 7),
(201, 34, 6),
(165, 37, 5),
(164, 38, 5),
(188, 39, 1),
(163, 40, 7),
(190, 41, 4),
(191, 42, 5),
(206, 48, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan_katagori`
--

CREATE TABLE `lowongan_katagori` (
  `id` int(11) UNSIGNED NOT NULL,
  `lowongan_id` int(11) UNSIGNED DEFAULT NULL,
  `katagori_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `lowongan_katagori`
--

INSERT INTO `lowongan_katagori` (`id`, `lowongan_id`, `katagori_id`) VALUES
(102, 1, 8),
(112, 2, 8),
(98, 3, 4),
(103, 4, 8),
(93, 8, 8),
(99, 9, 6),
(94, 10, 8),
(101, 11, 6),
(128, 13, 4),
(95, 26, 1),
(100, 27, 6),
(92, 28, 8),
(91, 29, 8),
(122, 30, 6),
(90, 31, 8),
(87, 32, 4),
(106, 33, 3),
(121, 34, 6),
(85, 37, 7),
(84, 38, 1),
(108, 39, 5),
(83, 40, 6),
(110, 41, 8),
(111, 42, 2),
(126, 48, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `location` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `sex` enum('Laki-laki','Perempuan') NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `religion` varchar(10) NOT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `filefoto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `email`, `password`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `salt`, `first_name`, `last_name`, `location`, `birthdate`, `phone`, `sex`, `address`, `religion`, `skill`, `filefoto`) VALUES
(1, '127.0.0.1', 'administrator', 'admin@admin.com', '$2y$08$VDKz0OzVXsJs96pbFQ9OZu74YSf2SUB01C/DE.zds.EhJX/lYk5ZK', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2018-09-19 09:40:07', 1, '', 'Admin', 'istrator', 'Yogyakarta', '1997-03-26', '0', 'Laki-laki', 'ADMINISTRATOR', '', NULL, ''),
(2, '::1', 'ilhamanasruloh26@gmail.com', 'ilhamanasruloh26@gmail.com', '$2y$08$esx05xs7KDrCrBAjna4qyOBAqSohtzGm7X7x/mvYP0B4RT0k8FQF.', NULL, '4OyuqFSXdHXFN9Wio.LdnOddc6fd69af9bf20742', 1523987748, NULL, '0000-00-00 00:00:00', '2018-08-01 02:03:01', 1, NULL, 'Ilham', 'Anasruloh', 'Cirebon', '1997-03-26', '+6282219259952', 'Laki-laki', 'Jl.Swasembada No.14, Kav Cimanuk Majasem RT:03/RW:14', 'Islam', 'Codeigniter', ''),
(3, '::1', 'galihmalela@gmail.com', 'galihmalela@gmail.com', '$2y$08$csrEy5epB.xAvliCRtynpO0.7xJKzTPzPtxJoMqLy/Xh5N6bjWjse', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Galih', 'Malela Damaraji', '', '0000-00-00', '081121210909', 'Laki-laki', 'Simpus jojo', '', NULL, ''),
(4, '::1', 'abdulrochim@gmail.com', 'abdulrochim@gmail.com', '$2y$08$1QlFR8K2yXt/ctpumrImAei18MM6MrvSCKiuJt15xkc0VRRUIY64a', '3938b262415b78434bba5aa9515c634010e060ab', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 0, NULL, 'Muhammad Abdul', 'Rochim', '', '0000-00-00', '087122221111', 'Laki-laki', 'BEM FT UNY 2017', '', NULL, ''),
(5, '::1', 'fathianw@gmail.com', 'fathianw@gmail.com', '$2y$08$3HyQFZzwnvPVvyaFQqIETOh1tyZ7ZaHUJdInYxgI3R4vUfTxIfJ.a', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2018-03-12 05:39:41', 1, NULL, 'Fathia', 'Nurwansono', '', '0000-00-00', '+681338410090', 'Laki-laki', 'Delithias', '', NULL, ''),
(13, '::1', 'annurreni@gmail.com', 'annurreni@gmail.com', '$2y$08$xiviSvgv6t6gK/3W.VvQxObECZnOkC4nBQhCzbSrz2yvkSTAs3JeG', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2018-03-13 16:51:24', 1, NULL, 'Annur', 'Reni Hasanah', '', '0000-00-00', '', 'Laki-laki', '', '', NULL, ''),
(14, '::1', 'andri@gmail.com', 'andri@gmail.com', '$2y$08$UaVUIzyTom6v4cb/a7nylOZ7B.aWqc7ri8ulnd6RclKLaC29kNNfi', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Andri Ahmad', 'Muhyidin', '', '0000-00-00', '', 'Laki-laki', 'Jl.Hayam Wuruk No.15', '', NULL, ''),
(15, '::1', 'wiwi@gmail.com', 'wiwi@gmail.com', '$2y$08$GKBJODjTxzdpcNGi3dXtbuGRGcBion.WZtHUG5QVCCdCusXFFbQty', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Wiwi a', 'Lestari', '', '0000-00-00', '', 'Laki-laki', 'Jl.Burung', '', NULL, ''),
(18, '::1', 'rioharyanto@gmail.com', 'rioharyanto@gmail.com', '$2y$08$IB52ST2I3a6BFu5llBn2zOGEsvKvfDlApCdeonrtgla4/qcgDiy02', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Rio Ahmad', 'Haritanuwijaya', '', '0000-00-00', '', 'Laki-laki', '', '', NULL, ''),
(19, '::1', 'lindaagustin@gmail.com', 'lindaagustin@gmail.com', '$2y$08$kX1zoP7NEzJGj7RAvjBLTuZfQnHU/wD4Q5eNrC0JRNO9X1733tlp2', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Linda', 'Agustina', '', '0000-00-00', NULL, 'Laki-laki', NULL, '', NULL, ''),
(21, '::1', 'superjajang@gmail.com', 'superjajang@gmail.com', '$2y$08$006E8J//Qnbio205yRDOsOi2lGnZpyXjnXMw58Cel7f/dGDER9Js6', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Jajang', 'Supermen', '', '0000-00-00', NULL, 'Laki-laki', NULL, '', NULL, ''),
(22, '::1', 'hodayahsofi@gmail.com', 'hodayahsofi@gmail.com', '$2y$08$0qgN8QS2rl63ykltAWIKo.oOkIkZSVeMmUoumDdK5mSGQfOA8Xzs2', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Sofi', 'Hidayah', '', '0000-00-00', NULL, 'Laki-laki', NULL, '', NULL, ''),
(23, '::1', 'hodaytii@gmail.com', 'hodaytii@gmail.com', '$2y$08$N3D46yh1SCC7iMT6scqg5uFcyKxuR/8JBpLv3GKmSdDpPKmQGwwUi', NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, 1, NULL, 'Hidayati', 'Havan', '', '0000-00-00', NULL, 'Laki-laki', NULL, '', NULL, ''),
(24, '::1', 'anwarjok@gmail.com', 'anwarjok@gmail.com', '$2y$08$nfgu/fzyrFU8MAcQveCG1uhB6V4.mNq2a7kNp54aMHw.KZftPRrFy', NULL, NULL, NULL, NULL, '2018-02-14 03:12:17', '2018-04-25 15:16:46', 1, NULL, 'Joko', 'Anwar', 'Bandung', '1996-03-23', '+6282222223333', 'Laki-laki', 'Jl.Manis No.12 Bandung', '', NULL, ''),
(26, '::1', 'ilhamanasruloh@ymail.com', 'ilhamanasruloh@ymail.com', '$2y$08$haPOs8zNjRWtyNF6yW1useim83a2doXRLDKeViAjp2ufQ61G2OrCq', NULL, NULL, NULL, NULL, '2018-04-20 19:19:31', '2018-04-20 19:24:15', 1, NULL, 'Ilham', 'Anasruloh', 'Cirebon', '1997-03-26', '0822192599123', 'Laki-laki', 'Jl.Swasembada No.2', '', NULL, ''),
(27, '::1', 'ajimasha@gmail.com', 'ajimasha@gmail.com', '$2y$08$0ohB5h6KWrtFFYj81zl7QeLbtzde/Mb6F/tA.kfd5EnlOhPzuSIem', NULL, NULL, NULL, NULL, '2018-04-26 07:46:15', NULL, 1, NULL, 'Aji', 'Masha', '', '0000-00-00', '083244422225', 'Laki-laki', 'Jl.Swakelola Malang', '', NULL, ''),
(30, '::1', 'elni@gmail.com', 'elni@gmail.com', '$2y$08$TkvZ9KkHbGTWyt70mSXGOO3yiF7gc2Jmtl6xIVNMNUF1Kr0sea1FK', NULL, NULL, NULL, NULL, '2018-05-21 22:19:46', '2018-05-21 22:21:13', 1, NULL, 'Wirahmi', 'Elniasari', '', '0000-00-00', NULL, 'Laki-laki', NULL, '', NULL, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(78, 1, 1),
(80, 2, 2),
(79, 2, 3),
(16, 3, 2),
(15, 4, 2),
(17, 5, 2),
(37, 13, 2),
(49, 14, 2),
(48, 15, 2),
(51, 18, 2),
(32, 19, 2),
(34, 21, 2),
(39, 22, 2),
(40, 23, 2),
(60, 24, 2),
(59, 26, 2),
(58, 26, 3),
(61, 27, 2),
(68, 30, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_lowongan`
--

CREATE TABLE `users_lowongan` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `lowongan_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industri`
--
ALTER TABLE `industri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `katagori`
--
ALTER TABLE `katagori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lowongan_industri`
--
ALTER TABLE `lowongan_industri`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lowongan_industri` (`lowongan_id`,`industri_id`) USING BTREE,
  ADD KEY `lowongan_id` (`lowongan_id`) USING BTREE,
  ADD KEY `industri_id` (`industri_id`) USING BTREE;

--
-- Indexes for table `lowongan_katagori`
--
ALTER TABLE `lowongan_katagori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_lowongan_katagori` (`lowongan_id`,`katagori_id`) USING BTREE,
  ADD KEY `lowongan_id` (`lowongan_id`) USING BTREE,
  ADD KEY `katagori_id` (`katagori_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `users_lowongan`
--
ALTER TABLE `users_lowongan`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uc_users_lowongan` (`user_id`,`lowongan_id`) USING BTREE,
  ADD KEY `fk_user_id` (`user_id`) USING BTREE,
  ADD KEY `fk_lowongan_id` (`lowongan_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `industri`
--
ALTER TABLE `industri`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `katagori`
--
ALTER TABLE `katagori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `lowongan_industri`
--
ALTER TABLE `lowongan_industri`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
--
-- AUTO_INCREMENT for table `lowongan_katagori`
--
ALTER TABLE `lowongan_katagori`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `users_lowongan`
--
ALTER TABLE `users_lowongan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `lowongan_industri`
--
ALTER TABLE `lowongan_industri`
  ADD CONSTRAINT `lowongan_industri_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_industri_ibfk_2` FOREIGN KEY (`industri_id`) REFERENCES `industri` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lowongan_katagori`
--
ALTER TABLE `lowongan_katagori`
  ADD CONSTRAINT `lowongan_katagori_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lowongan_katagori_ibfk_2` FOREIGN KEY (`katagori_id`) REFERENCES `katagori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `users_lowongan`
--
ALTER TABLE `users_lowongan`
  ADD CONSTRAINT `users_lowongan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_lowongan_ibfk_2` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
