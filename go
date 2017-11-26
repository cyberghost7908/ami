echo OK Start.. GoodLuck
nmap -iL $1 -Pn -p5038 --open | awk '/is up/ {print up}; {gsub (/\(|\)/,""); up = $NF}' | tee tmpfile
php ami.php tmpfile pass.txt
echo done!
rm tmpfile
