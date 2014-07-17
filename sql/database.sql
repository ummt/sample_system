/* ユーザ作成 */
GRANT ALL PRIVILEGES ON sample.* to dbuser@'localhost' IDENTIFIED BY 'dbpass';

/* sampleデータベースを作成する */
CREATE DATABASE sample DEFAULT CHARACTER SET utf8;

/* sampleデータベースを使用する */
USE sample;

/* userテーブルを作成する */
CREATE TABLE user
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  login_id varchar(30) NOT NULL UNIQUE KEY,
  login_password char(32) NOT NULL,
  name varchar(30) NOT NULL,
  is_deleted CHAR(1) NOT NULL DEFAULT '0',
  update_date DATETIME NOT NULL
);

/* user情報作成 */
INSERT INTO user
(login_id, login_password, name, is_deleted, update_date)
VALUES
('user', '1a1dc91c907325c69271ddf0c944bc72', 'テストユーザー', '0', NOW());

/* infoテーブルを作成する */
CREATE TABLE info (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
subject VARCHAR(100) NOT NULL,
post_date DATETIME NOT NULL,
contents TEXT NOT NULL,
update_date DATETIME NOT NULL
);

/* info情報作成 */
INSERT INTO info
(subject, post_date, contents, update_date)
VALUES
(
'テストタイトル',
'1900-01-01 00:00:00',
'テストコンテンツ',
NOW()
);

INSERT INTO info
(subject, post_date, contents, update_date)
VALUES
(
'管理サーバーにおける早朝のネットワーク強化メンテナンスのお知らせ',
'2014-07-11 09:30:45',
'<p>次のとおり、システムメンテナンスを実施します</p>
<table>
<tr><td style="width: 50px">日時</td><td>20XX年04月02日&nbsp;AM3:00～AM5:00</td></tr>
<tr><td>内容</td><td>フロア間ルータの入替作業</td></tr>
</table>
<p>作業中もシステムを利用可能となっておりますが、通信速度が落ちることが予想されます。</p>
<p>以上</p>',
NOW()
);

/* 顧客マスタ作成 */
CREATE TABLE customer (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(50) NOT NULL,
name_kana VARCHAR(50) NOT NULL,
gender CHAR(1) NOT NULL,
birth_date DATETIME NOT NULL,
zip_code CHAR(7) NOT NULL,
prefecture_id INT NOT NULL,
address1 VARCHAR(100) NOT NULL,
address2 VARCHAR(100) NOT NULL,
tel VARCHAR(15) NOT NULL,
mail VARCHAR(50) NOT NULL,
is_deleted CHAR(1) NOT NULL
);

INSERT INTO customer
(name, name_kana, gender, birth_date, zip_code, prefecture_id, address1, address2, tel, mail, is_deleted)
VALUES
(
'長崎太郎',
'タナカタロウ',
'1',
'1982-05-03',
'8508570',
42,
'長崎市江戸町',
'２‐１３',
'095-824-1111',
'toiawase@sample-nagasaki.com',
'0'
);

/* 都道府県マスタ作成 */
CREATE TABLE prefecture (
id INT NOT NULL PRIMARY KEY,
name VARCHAR(6) NOT NULL
);

INSERT INTO prefecture
(id, name)
VALUES
(1, '北海道'),
(2, '青森'),
(3, '岩手'),
(4, '宮城'),
(5, '秋田'),
(6, '山形'),
(7, '福島'),
(8, '茨城'),
(9, '栃木'),
(10, '群馬'),
(11, '埼玉'),
(12, '千葉'),
(13, '東京'),
(14, '神奈川'),
(15, '新潟'),
(16, '富山'),
(17, '石川'),
(18, '福井'),
(19, '山梨'),
(20, '長野'),
(21, '岐阜'),
(22, '静岡'),
(23, '愛知'),
(24, '三重'),
(25, '滋賀'),
(26, '京都'),
(27, '大阪'),
(28, '兵庫'),
(29, '奈良'),
(30, '和歌山'),
(31, '鳥取'),
(32, '島根'),
(33, '岡山'),
(34, '広島'),
(35, '山口'),
(36, '徳島'),
(37, '香川'),
(38, '愛媛'),
(39, '高知'),
(40, '福岡'),
(41, '佐賀'),
(42, '長崎'),
(43, '熊本'),
(44, '大分'),
(45, '宮崎'),
(46, '鹿児島'),
(47, '沖縄');
