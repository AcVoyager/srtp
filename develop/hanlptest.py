from pyhanlp import *
f = open("php_to_python", "r", encoding="utf-8")
document = f.read()
f.close();
#err = open("error.log", "w")
#err.write(document)
ls = HanLP.extractKeyword(document, 4)
#print(ls)
target = open("python_to_php", "w", encoding="utf-8")
for item in ls:
   target.write(item)
   target.write("\n")
target.close()
# 自动摘要
# 依存句法分析
#print(HanLP.parseDependency("徐先生还具体帮助他确定了把画雄鹰、松鼠和麻雀作为主攻目标。"))
