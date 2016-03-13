if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

#SHELL=$(free -k | grep -v 'buffers/cache')
SHELL=$(free -kt | sed '1 d' | awk '{print $1"|"$2"|"$3"|"$4"|"$5"|"$6"|"$7}')

#header manually added here...
echo "Type|Total|Used|Free|Shared|Buff/Cache|Cached"
echo "${SHELL}"
