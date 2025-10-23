import json
import mysql.connector
import numpy as np
import pandas as pd
from sqlalchemy import create_engine
from datetime import datetime


mysql_conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="cedur",
    charset="utf8mb4",     # wichtig für Emojis
    use_unicode=True       # stellt sicher, dass Python Unicode-Strings nutzt
)

cursor = mysql_conn.cursor(dictionary=True)
engine = create_engine("mysql+mysqlconnector://root:@localhost/cedur")


usergroup_str = "usergroup > 0"

if 1 == 0: 

    base_user = {}

    base_user['summary'] = {}
    query = "SELECT COUNT(DISTINCT fcid) AS cnt FROM `forms_10010` WHERE " + usergroup_str
    cursor.execute(query)
    row = cursor.fetchone()
    count = row['cnt']
    base_user['summary']['visits'] = count

    query = "SELECT COUNT(DISTINCT fcid) AS cnt FROM `forms_10003` WHERE " + usergroup_str
    cursor.execute(query)
    row = cursor.fetchone()
    count = row['cnt']
    base_user['summary']['patients'] = count

    query = "SELECT fcont, COUNT(*) cnt FROM `forms_10003` WHERE fid=96 AND " + usergroup_str +  " GROUP BY fcont"
    cursor.execute(query)
    rows = cursor.fetchall()
    base_user['gender'] = {}
    for row in rows:
        base_user['gender'][row['fcont']] = row['cnt']

    query ="SELECT fcont, COUNT(*) cnt FROM `forms_10003` WHERE fid=95 AND " + usergroup_str +  " GROUP BY fcont"    
    cursor.execute(query)
    rows = cursor.fetchall()
    base_user['diagnosis'] = {}
    for row in rows:
        base_user['diagnosis'][row['fcont']] = row['cnt']

    print(json.dumps(base_user, indent=2, ensure_ascii=False))

query = "SELECT DISTINCT fcid FROM `forms_10010` WHERE " + usergroup_str
df = pd.read_sql(query, engine)
print(df)


# Verbindung schließen (wichtiger Schritt)
cursor.close()
mysql_conn.close()