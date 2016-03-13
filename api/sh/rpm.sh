if [ $2 ]; then
  echo "ERROR|This resource only allow 1 params"
  exit
fi

if [ $1 ]; then
  SHELL=$(rpm -qa --queryformat '%{summary}|%{name}|%{version}|%{release}|%{size}\n' | sort | grep $1)
else
  SHELL=$(rpm -qa --queryformat '%{summary}|%{name}|%{version}|%{release}|%{size}\n' | sort)
fi
echo "Summary|Name|Version|Release|Size"
echo "${SHELL}"

