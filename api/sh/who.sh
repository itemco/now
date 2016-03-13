if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

SHELL=$(whoami)

#header manually added here...
echo "User"
echo "${SHELL}"
