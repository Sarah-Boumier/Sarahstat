from selenium import webdriver
import codecs
import os
import mysql.connector as MC

try:
    mydb = MC.connect(host='localhost', database='twitter', user='root', password='')
    cursor = mydb.cursor()

    requette = "SELECT id FROM id WHERE id NOT IN (SELECT id2 FROM id2)"
    cursor.execute(requette)
    idlist = cursor.fetchall()
except MC.Error as err :
          print(err) 

finally:
    if(mydb.is_connected()):
        cursor.close()
        mydb.close()

if os.path.exists("bdd7983.txt"):
  os.remove("bdd7983.txt")
else:
  print("The file does not exist")

f = codecs.open("bdd7983.txt", "x", "utf-8")

driver = webdriver.Chrome(executable_path=r"chromedriver.exe")
driver.get(r"https://virtualfollow.com")


for id in idlist:
    id = format(id[0])
    search_bar = driver.find_element_by_name("SearchMe")
    search_bar.send_keys(id)
    search_btn = driver.find_element_by_class_name("btn-primary")
    search_btn.click()
    try:
      infos = driver.find_element_by_class_name("bcw")
      the_text = infos.find_elements_by_tag_name("li")
      pseudo = the_text[0].text
      handle = the_text[3].text.split(":")[1].strip()
      out = id + "  \"" + pseudo + " (" + handle + ")\"\n"
      f.write(out)
    except:
      out = id + "  \"Compte qui n existe plus\"\n"
      f.write(out)
  
    print(out)
  
   
f.close()
