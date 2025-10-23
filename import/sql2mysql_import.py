# SQL- Defs

sql_drop = "DROP TABLE IF EXISTS `forms_10000`, `forms_10003`, `forms_10005`, `forms_10010`, `forms_10020`, `forms_10050`, `forms_99901`, `forms_99902`, `forms_definition`, `token_store`, `user_miq`, `user_miq_log`;"
    
sql_create = """
    CREATE TABLE IF NOT EXISTS `forms_10000` (
    `fcid` bigint(20) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `mts` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_10003` (
    `fcid` bigint(11) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL,
    `mts` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_10005` (
    `fcid` bigint(11) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL,
    `mts` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_10010` (
    `fcid` bigint(11) NOT NULL,
    `fid` bigint(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL,
    `mts` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_10020` (
    `fcid` bigint(11) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL,
    `mts` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_10050` (
    `fcid` bigint(11) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL,
    `mts` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_99901` (
    `fcid` bigint(11) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `mts` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_99902` (
    `fcid` bigint(11) NOT NULL,
    `fid` int(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `fcont` text DEFAULT NULL,
    `mts` text DEFAULT NULL,
    `usergroup` int(11) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `forms_definition` (
    `fid` int(11) NOT NULL,
    `fg` int(11) NOT NULL,
    `ftype` text DEFAULT NULL,
    `fname` text DEFAULT NULL,
    `foptions` text DEFAULT NULL,
    `ftitle` text DEFAULT NULL,
    `mts` datetime DEFAULT NULL,
    `shortname` text DEFAULT NULL,
    `in_view` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `token_store` (
    `id` bigint(11) NOT NULL,
    `master_uid` bigint(11) DEFAULT NULL,
    `token` text DEFAULT NULL,
    `expires_at` datetime DEFAULT NULL,
    `used` int(11) DEFAULT 0,
    `params` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `user_miq` (
    `master_uid` bigint(11) NOT NULL,
    `muid` bigint(11) DEFAULT NULL,
    `login_name` text DEFAULT NULL,
    `login_pass` text DEFAULT NULL,
    `rights` text DEFAULT NULL,
    `mts` text DEFAULT NULL,
    `email` text DEFAULT NULL,
    `usergroup` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    CREATE TABLE IF NOT EXISTS `user_miq_log` (
    `muid` bigint(11) NOT NULL,
    `logged_in` text NOT NULL,
    `logged_out` text DEFAULT NULL,
    `ip_address` text DEFAULT NULL,
    `mts` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
"""
sql_alter = """

    ALTER TABLE `forms_10000`
    ADD PRIMARY KEY (`fcid`,`fid`);

    ALTER TABLE `forms_10003`
    ADD PRIMARY KEY (`fcid`,`fid`),
    ADD KEY `idx_forms_10003_fcid` (`fcid`),
    ADD KEY `idx_forms_10003_fid` (`fid`),
    ADD KEY `idx_forms_10003_fcont_fid` (`fcont`(30),`fid`),
    ADD KEY `idx_forms_10003_usergroup` (`usergroup`);

    ALTER TABLE `forms_10005`
    ADD PRIMARY KEY (`fcid`,`fid`),
    ADD KEY `idx_forms_10005_fcid` (`fcid`),
    ADD KEY `idx_forms_10005_fid` (`fid`),
    ADD KEY `idx_forms_10005_fcont_fid` (`fcont`(30),`fid`),
    ADD KEY `idx_forms_10005_usergroup` (`usergroup`);

    ALTER TABLE `forms_10010`
    ADD PRIMARY KEY (`fcid`,`fid`),
    ADD KEY `idx_forms_10010_fcid` (`fcid`) USING BTREE,
    ADD KEY `idx_forms_10010_fid` (`fid`) USING BTREE,
    ADD KEY `idx_forms_10010_fcont_fid` (`fcont`(30),`fid`),
    ADD KEY `idx_forms_10010_usergroup` (`usergroup`);

    ALTER TABLE `forms_10020`
    ADD PRIMARY KEY (`fcid`,`fid`);

    ALTER TABLE `forms_10050`
    ADD PRIMARY KEY (`fcid`,`fid`);

    ALTER TABLE `forms_99901`
    ADD PRIMARY KEY (`fcid`,`fid`);

    ALTER TABLE `forms_99902`
    ADD PRIMARY KEY (`fcid`,`fid`);

    ALTER TABLE `forms_definition`
    ADD PRIMARY KEY (`fg`,`fid`);

    ALTER TABLE `token_store`
    ADD PRIMARY KEY (`id`);

    ALTER TABLE `user_miq`
    ADD PRIMARY KEY (`master_uid`);

    ALTER TABLE `user_miq_log`
    ADD PRIMARY KEY (`muid`,`logged_in`(255));
"""

# Modules and connection

import sqlite3
import mysql.connector
import mariadb
import hashlib


# -----------------------------
# SQLite-Verbindung
# -----------------------------
sqlite_conn = sqlite3.connect(r"C:\xampp\htdocs\MIQ_projects\cedur\db\cedur.sqlite3")
sqlite_conn.row_factory = sqlite3.Row  # erlaubt Zugriff per Spaltenname
sqlite_cur = sqlite_conn.cursor()

# -----------------------------
# MySQL-Verbindung (utf8mb4!)
# -----------------------------
mysql_conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="cedur",
    charset="utf8mb4",     # wichtig für Emojis
    use_unicode=True       # stellt sicher, dass Python Unicode-Strings nutzt
)

mysql_cur = mysql_conn.cursor()
mysql_cur.execute("SET NAMES utf8mb4")


# mysql_cur.execute("CREATE TABLE emoji_test (txt VARCHAR(255) CHARACTER SET utf8mb4)")
# mysql_cur.execute("INSERT INTO emoji_test (txt) VALUES (%s)", ("Hallo 😀",))
# mysql_conn.commit()

# mysql_cur.execute("SELECT txt FROM emoji_test")
# print(mysql_cur.fetchone())


# -----------------------------
# MySQL-Create
# -----------------------------
# sql_drop

mysql_cur.execute(sql_drop)
mysql_cur.fetchall()
mysql_conn.commit()

sql_create_a = [cmd.strip() for cmd in sql_create.split(';') if cmd.strip()]
try:
    for command in sql_create_a:
        mysql_cur.execute(command)
        mysql_cur.fetchall()
        mysql_conn.commit()
        print("Tabellen erfolgreich erstellt.")
except mariadb.Error as e:
        print(f"Fehler beim Erstellen der Tabellen: {e}")

sql_alter_a = [cmd.strip() for cmd in sql_alter.split(';') if cmd.strip()]
try:
    for command in sql_alter_a:
        mysql_cur.execute(command)
        mysql_cur.fetchall()
        mysql_conn.commit()
        print("Tabellen erfolgreich erstellt.")
except mariadb.Error as e:
        print(f"Fehler beim Erstellen der Tabellen: {e}")




# Functions

def hash_bytes(data):
    if data is None:
        data = b""  # leeres Byte-Objekt
    elif isinstance(data, str):
        data = data.encode("utf-8", errors="surrogateescape")
    elif isinstance(data, memoryview):
        data = data.tobytes()
    return hashlib.md5(data).hexdigest()

def import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, fg):
    # Ziel-Tabelle vorher leeren
    mysql_cur.execute(f"DELETE FROM `forms_{fg}`")
    mysql_conn.commit()

    # Quelle lesen
    sqlite_cur.execute(f"SELECT fcid, fid, muid, fcont, mts, usergroup FROM forms_{fg}")
    rows = sqlite_cur.fetchall()

    total = len(rows)
    success = 0

    insert_sql = f"""
        INSERT INTO forms_{fg} (fcid, fid, muid, fcont, mts, usergroup)
        VALUES (%s, %s, %s, %s, %s, %s)
        ON DUPLICATE KEY UPDATE
            muid = VALUES(muid),
            fcont = VALUES(fcont),
            mts = VALUES(mts),
            usergroup = VALUES(usergroup)
    """

    for row in rows:
        fcid, fid, muid, fcont, mts, usergroup = row

        # fcont als Bytes, falls SQLite es als str liefert
        if isinstance(fcont, str):
            fcont_bytes = fcont.encode("utf-8", errors="surrogateescape")
        else:
            fcont_bytes = fcont

        # Insert ausführen
        mysql_cur.execute(insert_sql, (fcid, fid, muid, fcont_bytes, mts, usergroup))

        # -----------------------------
        # Validierung
        # -----------------------------
        mysql_cur.execute(
            f"SELECT fcid, fid, muid, fcont, mts, usergroup FROM forms_{fg} WHERE fcid=%s AND fid=%s",
            (fcid, fid),
        )
        result = mysql_cur.fetchone()

        if result:
            r_fcid, r_fid, r_muid, r_fcont, r_mts, r_usergroup = result
            if hash_bytes(r_fcont) == hash_bytes(fcont_bytes):
                success += 1
            else:
                print(f"[WARN] Zeile fcid={fcid}, fid={fid} fcont stimmt nicht!")
        else:
            print(f"[ERROR] Zeile fcid={fcid}, fid={fid} wurde nicht gefunden!")

    # Commit nach allen Inserts (viel schneller!)
    mysql_conn.commit()

    print(f"Import {fg} abgeschlossen: {success}/{total} Zeilen korrekt übertragen.")

def import_user(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur):
    sqlite_cur.execute("SELECT master_uid, muid, login_name, login_pass, rights, mts, email, usergroup FROM user_miq")
    rows = sqlite_cur.fetchall()

    print(f"[INFO] {len(rows)} Zeilen aus SQLite gelesen")

    insert_sql = """
    INSERT INTO user_miq (master_uid, muid, login_name, login_pass, rights, mts, email, usergroup)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        muid = VALUES(muid),
        login_name = VALUES(login_name),
        login_pass = VALUES(login_pass),
        rights = VALUES(rights),
        mts = VALUES(mts),
        email = VALUES(email),
        usergroup = VALUES(usergroup);
    """

    for row in rows:
        mysql_cur.execute(insert_sql, tuple(row))  
        # mysql_cur.execute(insert_sql, row)

    mysql_conn.commit()
    print(f"[INFO] {len(rows)} Zeilen in MySQL eingefügt/aktualisiert")

    # 4. Validierung: gleiche Anzahl Zeilen?
    mysql_cur.execute("SELECT COUNT(*) FROM user_miq")
    mysql_count = mysql_cur.fetchone()[0]

    sqlite_count = len(rows)

    if mysql_count == sqlite_count:
        print(f"[OK] Zeilenanzahl stimmt überein: {mysql_count}")
    else:
        print(f"[WARN] Unterschied: SQLite={sqlite_count}, MySQL={mysql_count}")

def import_user_miq_log(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur):
    # 1. MySQL-Tabelle erstellen (falls nicht existiert)
    create_sql = """
    CREATE TABLE IF NOT EXISTS user_miq_log (
        muid BIGINT,
        logged_in DATETIME,
        logged_out DATETIME,
        ip_address TEXT,
        mts DATETIME,
        PRIMARY KEY (muid, logged_in)
    ) ENGINE=InnoDB;
    """
    mysql_cur.execute(create_sql)
    mysql_cur.fetchall()  # leeres Resultset abholen
    mysql_conn.commit()

    # 2. Daten aus SQLite lesen
    sqlite_cur.execute("SELECT muid, logged_in, logged_out, ip_address, mts FROM user_miq_log")
    rows = sqlite_cur.fetchall()

    print(f"[INFO] {len(rows)} Zeilen aus SQLite (user_miq_log) gelesen")

    # 3. In MySQL einfügen/aktualisieren
    insert_sql = """
    INSERT INTO user_miq_log (muid, logged_in, logged_out, ip_address, mts)
    VALUES (%s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        logged_out = VALUES(logged_out),
        ip_address = VALUES(ip_address),
        mts = VALUES(mts);
    """

    for row in rows:
        mysql_cur.execute(insert_sql, tuple(row)) 

    mysql_conn.commit()
    print(f"[INFO] {len(rows)} Zeilen in MySQL (user_miq_log) eingefügt/aktualisiert")

    # 4. Validierung: gleiche Anzahl Zeilen?
    mysql_cur.execute("SELECT COUNT(*) FROM user_miq_log")
    mysql_count = mysql_cur.fetchone()[0]
    sqlite_count = len(rows)

    if mysql_count == sqlite_count:
        print(f"[OK] Zeilenanzahl stimmt überein: {mysql_count}")
    else:
        print(f"[WARN] Unterschied: SQLite={sqlite_count}, MySQL={mysql_count}")

def import_forms_definition(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur):
    # 1. MySQL-Tabelle erstellen (falls nicht existiert)
    create_sql = """
    CREATE TABLE IF NOT EXISTS forms_definition (
        fid BIGINT,
        fg BIGINT,
        ftype TEXT,
        fname TEXT,
        foptions TEXT,
        ftitle TEXT,
        mts DATETIME,
        shortname TEXT,
        in_view TEXT,
        PRIMARY KEY (fg, fid)
    ) ENGINE=InnoDB;
    """
    mysql_cur.execute(create_sql)
    mysql_cur.fetchall()  # leeres Resultset abholen
    mysql_conn.commit()

    # 2. Daten aus SQLite lesen
    sqlite_cur.execute("SELECT fid, fg, ftype, fname, foptions, ftitle, mts, shortname, in_view FROM forms_definition")
    rows = sqlite_cur.fetchall()

    print(f"[INFO] {len(rows)} Zeilen aus SQLite (forms_definition) gelesen")

    # 3. In MySQL einfügen/aktualisieren
    insert_sql = """
    INSERT INTO forms_definition (fid, fg, ftype, fname, foptions, ftitle, mts, shortname, in_view)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)
    ON DUPLICATE KEY UPDATE
        ftype = VALUES(ftype),
        fname = VALUES(fname),
        foptions = VALUES(foptions),
        ftitle = VALUES(ftitle),
        mts = VALUES(mts),
        shortname = VALUES(shortname),
        in_view = VALUES(in_view);
    """

    for row in rows:
        mysql_cur.execute(insert_sql, tuple(row)) 

    mysql_conn.commit()
    print(f"[INFO] {len(rows)} Zeilen in MySQL (forms_definition) eingefügt/aktualisiert")

    # 4. Validierung: gleiche Anzahl Zeilen?
    mysql_cur.execute("SELECT COUNT(*) FROM forms_definition")
    mysql_count = mysql_cur.fetchone()[0]
    sqlite_count = len(rows)

    if mysql_count == sqlite_count:
        print(f"[OK] Zeilenanzahl stimmt überein: {mysql_count}")
    else:
        print(f"[WARN] Unterschied: SQLite={sqlite_count}, MySQL={mysql_count}")

# Main

import_user(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur)
import_forms_definition(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur)
import_user_miq_log(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 99901)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 99902)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 10000)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 10003)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 10005)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 10010)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 10020)
import_data_forms(mysql_conn, mysql_cur, sqlite_conn, sqlite_cur, 10050)
