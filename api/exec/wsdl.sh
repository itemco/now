#OBS!

#we should block some extensions, ex .php, .sh aso
#or perhaps all files that are 755
#fix later!
if [ ! $1 ]; then
  echo "ERROR|This resource require params"
  exit
fi
if [ $2 ]; then
  echo "ERROR|This resource only allow 1 params"
  exit
fi

SHELL=$(curl -ks $1)
echo "${SHELL}"

