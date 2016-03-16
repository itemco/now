if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

SHELL=$(lscpu | awk -F":" '{print $1"|"$2}' | awk '{$2=$2}1' | sed 's/| /|/g')

#header manually added here...
echo "Name|Value"
echo "${SHELL}"
