if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

COL1=$(curl -s http://psysdiv1u.ppm.nu/puppetbranch/ | tail -18 | head -15 | sed -n '/^$/!{s/<[^>]*>//g;p;}' | sed -n '0~2!p' | sed -n '0~2!p')
COL2=$(curl -s http://psysdiv1u.ppm.nu/puppetbranch/ | tail -18 | head -15 | sed -n '/^$/!{s/<[^>]*>//g;p;}' | sed -n '0~2!p' | sed -n '1~2!p')

SHELL=$(paste -d"|" <(echo "${COL1}") <(echo "${COL2}"))

#header manually added here...
echo "Name|Branch"
echo "${SHELL}"

