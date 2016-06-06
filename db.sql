CREATE DATABASE  IF NOT EXISTS `wtazil` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `wtazil`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: wtazil
-- ------------------------------------------------------
-- Server version	5.7.10-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) NOT NULL,
  `koddrzave` varchar(2) NOT NULL,
  `brojtelefona` varchar(45) NOT NULL,
  `korisnik_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_autor_korisnik1_idx` (`korisnik_id`),
  CONSTRAINT `fk_autor_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (1,'Amela Špica','ba','+387',2),(2,'Ime Prezime','ba','+387',3),(5,'novi','ba','+387',8),(6,'novi1','ba','+387',11);
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `komentar` varchar(2000) NOT NULL,
  `novost_id` int(10) unsigned NOT NULL,
  `komentar_id` int(10) unsigned DEFAULT NULL,
  `procitan` tinyint(1) NOT NULL,
  `korisnik_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_komentar_novost1_idx` (`novost_id`),
  KEY `fk_komentar_komentar1_idx` (`komentar_id`),
  KEY `fk_komentar_korisnik1_idx` (`korisnik_id`),
  CONSTRAINT `fk_komentar_komentar1` FOREIGN KEY (`komentar_id`) REFERENCES `komentar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_komentar_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_komentar_novost1` FOREIGN KEY (`novost_id`) REFERENCES `novost` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentar`
--

LOCK TABLES `komentar` WRITE;
/*!40000 ALTER TABLE `komentar` DISABLE KEYS */;
INSERT INTO `komentar` VALUES (19,'komentar',27,NULL,1,2),(20,'komentar1',26,NULL,1,1),(21,'komentar2',26,20,1,1),(22,'nesto',23,NULL,0,1),(23,'jos komentara',27,19,1,1),(24,'komentar gosta',27,23,0,4),(25,'komnetar gosta 2',27,19,0,5);
/*!40000 ALTER TABLE `komentar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `tipkorisnika_id` int(10) unsigned NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_korisnik_tipkorisnika1_idx` (`tipkorisnika_id`),
  CONSTRAINT `fk_korisnik_tipkorisnika1` FOREIGN KEY (`tipkorisnika_id`) REFERENCES `tipkorisnika` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'admin',1,'8fe4c11451281c094a6578e6ddbf5eed'),(2,'amela',2,'0d9ad99e96409d70789612af3de8e15e'),(3,'neko',2,'8fe4c11451281c094a6578e6ddbf5eed'),(4,'gost',3,NULL),(5,'gost2',3,NULL),(6,'gost2',3,NULL),(8,'novi',2,'832f72b7a13b2cedcfb108603a10e2a6'),(11,'novi1',2,'e491c16599aa89756ce7d44ad0415ff6'),(12,'gost',3,NULL),(13,'gost2',3,NULL);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novost`
--

DROP TABLE IF EXISTS `novost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novost` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `komentaridozvoljeni` tinyint(1) NOT NULL,
  `naslov` varchar(500) NOT NULL,
  `opis` varchar(10000) NOT NULL,
  `urlslike` varchar(500) DEFAULT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  `vrijeme` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_novost_autor1_idx` (`autor_id`),
  CONSTRAINT `fk_novost_autor1` FOREIGN KEY (`autor_id`) REFERENCES `autor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novost`
--

LOCK TABLES `novost` WRITE;
/*!40000 ALTER TABLE `novost` DISABLE KEYS */;
INSERT INTO `novost` VALUES (23,1,'Pravila Pas Usvajanje','Ako razmi&scaron;ljate o usvajanju psa iz skloni&scaron;ta za životinje , humanog dru&scaron;tva ili organizacije usvajanje ljubimac , va&scaron; najteži izazov može odabirom iz tolikih velikih četveronožnih drugova . Kretanje proces posvojenja nije tako te&scaron;ko kao &scaron;to mislite , kažeHumane Society iz SAD-a . Prije svega, morate biti sposobni i voljni da se brine za psa zdravlje i dobrobit . Usvajanje procedure \r\n\r\nVi živite u kući ili najam jedinice koja dopu&scaron;ta pse .\r\nPravila za usvajanje psa može se razlikovati od države do države , ali općenito , morate imati najmanje 18 godina . Vi ćete vjerojatno morati ispuniti zahtjev . Očekivati ​​da će platiti naknade za pokriće cjepiva , heartworm ispitivanja , identifikaciju mikročipa i sterilizaciju ili kastracija psa . Usvajanje Naknade se kreću od 40 do 300 dolara, ovisno o organizaciji . Također ćete trebati osigurati identifikaciju , kao &scaron;to je vozačku dozvolu i dokaz o prebivali&scaron;tu . Ako steVi ili homeowner s homeowner udruge , možda ćete morati dokazati da imate dopu&scaron;tenje za održavanje kućnog ljubimca ili dati podatke za kontakt kakoorganizacija može potvrditi da su kućni ljubimci . \r\nDozvola je potrebno \r\nNemojte zaboraviti zahtjevima pas licenci u va&scaron;oj državi .\r\n\r\nposjedovanje psa će morati imati dozvolu u va&scaron;oj državi prebivali&scaron;ta , pa pitati o Member kada su izrade Va&scaron;e posjete usvojiti psa . Neki skloni&scaron;ta za životinje i organizacije će biti u mogućnosti da biste se mogli kupiti licencu ima , ali na drugi način, obično možete ispuniti obrazac i poslati naknadu za psa licencom online , osobno u državnoj ili lokalnoj agenciji ili običnom po&scaron;tom. Možda ćete morati obnoviti va&scaron;eg psa licencu svakih godinu ili dvije u skladu sa svojim državnim zakonima , provjerite s va&scaron;im web stranicama državne vlasti za potvrdu obnove razdoblja i postupke . Pretplata se u rasponu od 5 do 35 dolara, ovisno o tome gdje živite . \r\n\r\nLifestyle razmatranja \r\nWalking tvoj pas je odličan način da se vježba uz svog ljubimca .\r\n\r\nPet usvajanje agencije naporno raditi kako bi prona&scaron;li odgovarajuće , stalne domove za izgubljenim , vrati ili spa&scaron;ene životinje u svojim skloni&scaron;tima . Trebat će pomoći i skloniti se na taj tvoj &quot; pas &quot; domaću zadaću prije nego &scaron;to krenete da usvoji psa . Poku&scaron;ajte saznati informacije na internetu ili negdje drugdje o kojima pasmine ili mje&scaron;ovite pasmine moglo biti najbolje za va&scaron; stil života . Razmislite o veličini psa i razmislite možete li osigurati razinu aktivnosti koje su potrebne određene ljubimca . Zapamtite da će se tro&scaron;kovi za veterinarske skrbi , stjecanje licence , pseće hrane , pas dotjerivanje ili ljubimac sjedi , ako ste na putovanju . \r\nPočetna Okoli&scaron; \r\nMorate uzeti u obzir u svom domu pri usvajanju pas .\r\n\r\nHumane Society sugerira da prije nego krenete u skloni&scaron;te , ti si postaviti neka pitanja . Budite svjesni , ako imate malu djecu - neke pasmine su bolji od drugih kad je riječ o djeci . Akopas će biti obiteljski ljubimac , poku&scaron;ati dobiti svačije ulaz i utvrditi je li ljubimac alergije mogao biti problem . Iako će se neka pravila za usvajanje psa , sjetite se da ćete imati odnos s va&scaron;eg ljubimca za mnogo godina da dođem , pa se isplati biti strpljiv i uzimanje svoje vrijeme pažljivo razmotriti kakav ljubimac - veliki ili mali , energični ili opu&scaron;teni , stariji i mlađi - je prava stvar za vas i va&scaron;u obitelj ','http://r.ddmcdn.com/w_830/s_f/o_1/cx_0/cy_220/cw_1255/ch_1255/APL/uploads/2014/11/dog-breed-selector-australian-shepherd.jpg',5,'2016/06/05 21:22:47'),(24,1,'RAZMISLITE DOBRO: usvajanje psa i &scaron;ta sve ono nosi','usvajanje psa: &Scaron;tenci su tako neodoljivi! Čim ih ugledamo, odmah poželimo da jedno ponesemo kući. Međutim, imati psa za ljubimca nosi sa sobom i veliku odgovornost!\r\n\r\nEvo devet stvari koje morate imati na umu pre nego &scaron;to psu pružite svoju ljubav i svoj dom:\r\n\r\nTo je dugoročan &bdquo;ugovor&ldquo;!\r\nPsi žive u proseku oko petnaest godina. Pre nego &scaron;to se odlučite da usvojite jednog, trebalo bi da budete sigurni da ćete moći da se brinete o njemu tokom celog tog perioda, bez obzira na promene koje će mu se vremenom sigurno de&scaron;avati.\r\n\r\nTo mnogo ko&scaron;ta!\r\nNa godi&scaron;njem nivou, briga o psu može ko&scaron;tati i preko 1000 eura: ishrana, oprema i dodatni proizvodi, redovne posete veterinaru, vakcinacije i drugi tretmani po potrebi&hellip; Dobro razmislite: ukoliko pas poživi 12 godina, ukupna suma iznosila bi 12000 eura!\r\n\r\nPsa treba naučiti urednosti!\r\nZa razliku od mačaka, psima urednost nije urođena. Treba ih tome naučiti, &scaron;to iziskuje veliku posvećenost, mnogo pažnje i disci&scaron;linovanja. Kada su u pitanju &scaron;tenci, uvek treba predvideti i nezgode&hellip;','http://static.independent.co.uk/s3fs-public/thumbnails/image/2016/02/04/19/1-Dogs-Gods-Getty.jpg',1,'2016/06/04 21:24:34'),(25,1,'Usvajanje pasa: Bitan je prvi kontakt','Budući vlasnici pasa, osim sa razmi&scaron;ljanjima o tome kako će se porodica organizovati u brizi i &scaron;etanju ljubimca, najče&scaron;će se suočavaju i sa dilemom da li će usvojiti &scaron;tene ili odraslog psa. U poslednje vreme na dru&scaron;tvenim mrežama i internet sajtovima pojavljuju se mnogobrojni tekstovi o prednostima usvajanja odraslih pasa, ali je prema rečima zaposlenih u gradskim azilima, presudan prvi kontakt usvojitelja i životinje. \r\n\r\nIskustvo je pokazalo da sugrađani u prihvatili&scaron;ta dolaze sa jasnom idejom kakvog psa žele, misleći pri tom, na određenu starost psa, veličinu i boju. \r\n\r\n- Ipak, najče&scaron;će se desi da iz prihvatili&scaron;ta u dom dovedu potpuno drugačijeg psa od onog kojeg su priželjkivali, pa se svi zabavimo kada građani žele malog, a kući odvedu velikog i starijeg psa - kažu u &quot;Veterini Beograd&quot;. - Razlog je u tome &scaron;to je zapravo presudni faktor u odlučivanju sam kontakt između usvojitelja i određenog psa. Tog momenta &quot;padaju u vodu&quot; sve ranije predstave o željenom ljubimcu i rađa se ljubav na prvi pogled. \r\n','http://www.b92.net/news/pics/2013/01/26/16878894385103ace58ce97419811512_w640.jpg',2,'2016/06/01 21:26:49'),(26,1,'Usvajanje','Psi su osjetljivi, inteligentni i emotivni, stoga se ne mogu praviti i prodavati kao kakvi predmeti. Mora biti odgojen svjesno, ozbiljno i s ljubavlju. Treba obratiti paznju na njegovu ljepotu i karakter.\r\n\r\n Kao prvo, da li ste sigurni da imate dovoljno vremena za vaseg Samojeda!? On ne moze bez ljudske blizine. Da li ste spremni razumjeti njegove nestasluke i linjanje? Pas trazi brigu kao i dijete. Ne zaboravite da bavljenje psom zahtjeva vremena i novca. Zenke su njeznije, poslusnije, elegantnije i inteligentnije. Istina je da zenka gubi krv (dva puta godisnje) kad naidje period parenja; ali nordijske rase su ciste i obracaju paznju na svoju higijenu. Muzjaci za vrijeme perioda parenja (suprotno od zenki) vole da pobjegnu.\r\n\r\nKuce Samojeda treba da se pokaze kao drustveno sa svima. Ako ostane u svom cosku i drhti, sigurno je da ima psihickih ili fizickih problema.','https://www.coopsandcages.com.au/blog/oe-content/uploads/2016/01/choosing-dog-cages-1.jpg',1,'2016/06/05 21:28:57'),(27,1,'Kako prići nepoznatom psu','Po&scaron;to ne znate karakter psa koji je ispred vas, ne možete pretpostaviti ni kako će reagovati. Na primer, upla&scaron;en pas na lancu će kidisati na vas, poku&scaron;ače bukom ili keženjem da ostavi utisak, ali se neće previ&scaron;e približiti.\r\n\r\nJedna od bitnih stvari u kontaktu sa psom je i sam prilazak. Naročito treba obratiti pažnju kad su u pitanju nepoznati psi na lancu, iza ograde, u nekom objektu sa životinjama koje čuvaju, u odgajivačnici ili skloni&scaron;tu. Psi reaguju drugačije kad su sami i neza&scaron;tićeni u odnosu na one koji se nalaze na poznatoj teritoriji i misle da su za&scaron;tićeni ili brojno nadmoćni.\r\n\r\nPravilan pristup\r\n\r\nPo&scaron;to ne znate karakter psa koji je ispred vas, ne možete pretpostaviti ni kako će reagovati. Na primer, upla&scaron;en pas na lancu će kidisati na vas, poku&scaron;ače bukom ili keženjem da ostavi utisak, ali se neće previ&scaron;e približiti. Ako priđe, učiniće to sa strane kako bi dohvatio va&scaron;u nogu ili nogavicu, jer u tom slučaju može da pobegne. Ako otresito viknete, verovatno će se skloniti, mada može nastaviti da vas napada, pa ćete morati o&scaron;trije da se branite. Potom možete očekivati da vas ostavi na miru, ali će biti u blizini, gledati vas ispod oka, ne direktno ako vidi da mu uzvraćate pogled, i potmulo će režati.\r\n\r\nAko je u pitanju hrabar pas, svestan svoje snage, očekujte da odmah uzurpira va&scaron; prostor ukoliko je na povodniku, jer ga dodatno ohrabruje prisustvo vlasnika. Ako psa gledate u oči, to je kao da ga pitate postoji li neko jači od vas, a po&scaron;to on misli da jeste, treba mu pokazati ko je gazda.\r\n\r\nZato ako prilazite nepoznatom psu, naročito u nekom od gorenavedenih slučajeva, ne činite to direktno, već se okrenite bočno i ne uspostavljajte kontakt očima. Budite mirni i opu&scaron;teni, ne pričajte mnogo i ne ma&scaron;ite previ&scaron;e rukama, bar dok se i pas ne opusti u va&scaron;em prisustvu.\r\n\r\nPas na povodniku\r\n\r\nS druge strane, neki psi su prijateljski raspoloženi te im ljudi stalno prilaze. I u ovom slučaju postoji pogre&scaron;an i ispravan pristup. Zamislite da vas neko odu&scaron;evljeno grli i ushićeno priča, a ne znate razlog takvom pona&scaron;anju! Ako mislite da psi to vole, varate se! Ima hladnokrvnih pasa koji su navikli na takve izlive emocija, i stoički ih podnose, ali ima i onih koji se uzjogune, počnu da skaču i poku&scaron;avaju da pobegnu. Ovo će postati problem ako se vlasnik trudio da vaspita ljubimca da ne skače na ljude, a onda naiđe na nekoga ko ohrabruje psa da se tako pona&scaron;a. Takav pristup zbunjuje psa koga su doskoro obučavali da ne&scaron;to ne radi, a onda mu se dozvoljava, da ba&scaron; to čini, čak ga i ohrabruju.\r\n\r\nKako prići lepo vaspitanom psu na povodniku, koji ne beži od ljudi i ne gleda ispod oka, već poku&scaron;ava mirno da vas onju&scaron;i kako biste se upoznali? Ne pokazujte ushićenje, već mirno dopustite psu da vas onju&scaron;i, ili čučnite ispred njega kako biste bili u istoj visini. Činite to sa strane, kako pas ne bi osećao izazov. Ne morate pružati ruku radi kontakta jer vas je njegovo čulo mirisa već obradilo. Grljenje ne dolazi u obzir jer pas to razume kao uzurpaciju prostora, pa će poku&scaron;ati da se izvuče iz zagrljaja. Mirno razgovarajte sa vlasnikom ili pričajte psu neutralnim, opu&scaron;tenim tonom. Tek kad vas bude znatiželjno onju&scaron;io, pomilujte ga po obrazu ili potap&scaron;ite po grudima, ukoliko mu ne smeta. Najbolji pokazatelj da ste sve uradili kako treba jeste gubitak interesovanja koje je pas u početku pokazao, posle čega će se okrenuti svom vlasniku ili nastaviti da gleda svoja posla.\r\n\r\nZapamtite: direktan pogled u oči i kretanje pravo prema psu predstavljaju izazov. Manje hrabar pas će se povući (&scaron;to se najče&scaron;će i de&scaron;ava), ali pas željan izazova će vam stati na put. Posle toga, ili ćete se skloniti i priznati da je jači, ili ćete se sukobiti. Odlučite sami!\r\n\r\nIgnorisanje\r\n\r\nNajbolji kontakt sa psom postiže se kad je on slobodan. U tom slučaju nema dopunskih stimulansa kako bi se pravio važan i pri svakom kontaktu sa drugom jedinkom biće oprezan. Njegovi kasniji postupci će zavisiti od upoznavanja. Pristup je potpuno isti kao i u prethodnom slučaju. Važno je da budete opu&scaron;teni. Pokažite psu kako vas uop&scaron;te ne interesuje i da samo želite da se upoznate, pa da nastavite svojim putem. Kad bude shvatio da ga ne izazivate i ne predstavljate opasnost po njega, opustiće se i možda ćete postati prijatelji.\r\n\r\nPo&scaron;tovanje\r\n\r\nOpu&scaron;teno i hladnokrvno priđite vlasniku psa, započnite razgovor i zatražite dozvolu da se upoznate sa njegovim ljubimcem. Ako posle toga čučnete i postupite kako treba, pas će osetiti va&scaron;e po&scaron;tovanje i dozvoliti da se zbližite.','http://thewayofthedog.co.uk/wp-content/uploads/2014/12/iStock_000010490372Large-e1420543005576-1024x573.jpg',1,'2016/06/05 21:32:43');
/*!40000 ALTER TABLE `novost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipkorisnika`
--

DROP TABLE IF EXISTS `tipkorisnika`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipkorisnika` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tip` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipkorisnika`
--

LOCK TABLES `tipkorisnika` WRITE;
/*!40000 ALTER TABLE `tipkorisnika` DISABLE KEYS */;
INSERT INTO `tipkorisnika` VALUES (1,'admin'),(2,'autor'),(3,'gost');
/*!40000 ALTER TABLE `tipkorisnika` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-06 12:57:02
