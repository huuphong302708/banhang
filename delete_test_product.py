import os
try:
    import mysql.connector
    mydb = mysql.connector.connect(host='localhost', user='root', password='', database='Bán Hàng')
    mycursor = mydb.cursor()
    mycursor.execute("DELETE FROM product WHERE title = 'áo thun na'")
    mydb.commit()
    print("Deleted via Python")
except Exception as e:
    print(e)
