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
if [ ! -r "$1" ]; then
  echo "ERROR|Permission denied or No such file or directory"
  exit
fi
if [ ! -e "$1" ]; then
  echo "ERROR|Permission denied or No such file or directory"
  exit
fi

SHELL=$(tail -500 $1)
echo "${SHELL}"

