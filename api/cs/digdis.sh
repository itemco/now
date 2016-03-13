if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

USER="digdis"

SERVICE[0]="mediator-webservice"
SERVICE[1]="router-webservice"
SERVICE[2]="router-daemon"

#header manually added here...
echo "SERVICE|UID|PID|PPID|C|STIME|TTY|TIME|STATUS"

for i in "${SERVICE[@]}"
do
  SHELL=$(ps -ef | grep $USER | grep $i | grep jar | awk '{print "REPLACE|"$1"|"$2"|"$3"|"$4"|"$5"|"$6"|"$7"|RUNNING"}')
  if [ $SHELL ]; then
    SHELL=$(echo "$SHELL" | sed s/REPLACE/$i/g)
  else
    SHELL="${i}|${USER}|0|0|0|00:00|?|00:00:00|STOPPED"
  fi
  echo "${SHELL}"
done
