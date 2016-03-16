if [ $2 ]; then
  echo "ERROR|This resource only allow 1 params"
  exit
fi

if [ $1 ]; then
  SHELL=$(ps -ef | sed 'i d' | grep $1 | grep -v "grep $1")
else
  SHELL=$(ps -ef | sed '1 d')
fi

NEW="${SHELL}"
NEW=$(echo "${NEW}" | sed 's/\(.\{8\}\)./\1|/')
NEW=$(echo "${NEW}" | sed 's/\(.\{14\}\)./\1|/')
NEW=$(echo "${NEW}" | sed 's/\(.\{20\}\)./\1|/')
NEW=$(echo "${NEW}" | sed 's/\(.\{23\}\)./\1|/')
NEW=$(echo "${NEW}" | sed 's/\(.\{29\}\)./\1|/')
NEW=$(echo "${NEW}" | sed 's/\(.\{38\}\)./\1|/')
NEW=$(echo "${NEW}" | sed 's/\(.\{47\}\)./\1|/')

echo "UID|PID|PPID|C|STIME|TTY|TIME|CMD"
echo "${NEW}"

