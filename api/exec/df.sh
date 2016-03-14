if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

SHELL=$(df -Pk --total | sed '1 d' | awk '{print $1"|"$2"|"$3"|"$4"|"$5"|"$6}')

#header manually added here...
echo "Filesystem|Blocks|Used|Available|Capacity|Mounted on"
echo "${SHELL}"
