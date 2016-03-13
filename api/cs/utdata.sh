if [ $1 ]; then
  echo "ERROR|This resource doesn't allow params"
  exit
fi

USER="streamserve"

SERVICE[0]="AccountStatement"
SERVICE[1]="ApplicationForm"
SERVICE[2]="DecisionLetter"
SERVICE[3]="DocumentBrokerPlus"
SERVICE[4]="FundFact"
SERVICE[5]="InformationLetter"
SERVICE[6]="PrintMaterial"
SERVICE[7]="Statistics"
SERVICE[8]="ManagementGateway"
SERVICE[9]="ManagementNanny"

#header manually added here...
echo "SERVICE|UID|PID|PPID|C|STIME|TTY|TIME|STATUS"

for i in "${SERVICE[@]}"
do
  SHELL=$(ps -ef | grep $USER | grep $i | awk '{print "REPLACE|"$1"|"$2"|"$3"|"$4"|"$5"|"$6"|"$7"|RUNNING"}')
  if [ $SHELL ]; then
    SHELL=$(echo "$SHELL" | sed s/REPLACE/$i/g)
  else
    SHELL="${i}|${USER}|0|0|0|00:00|?|00:00:00|STOPPED"
  fi
  echo "${SHELL}"
done
