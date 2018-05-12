f = open("result.php", "r")
content = f.read()
counter = 1
while counter <= 100:
    target = open("result"+str(counter)+".php", "w")
    target.write(content)
    target.close()
    counter += 1
f.close()
