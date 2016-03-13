#!/bin/sh

#THIS ACTUALLY WORKS! BUT CAN GIVE A HUGE LIST IF SELECTING ex "/" as param. So BEWARE!
#Add limit 100 somehow?
#or check if more than 100 and return exit!!!
#NOT SURE ABOUT dev null stuff, might show unredable as 0, fix later!

if [ ! $1 ]; then
  echo "ERROR|This resource require params"
  exit
fi
if [ $2 ]; then
  echo "ERROR|This resource only allow 1 params"
  exit
fi
if [ ! -e "$1" ]; then
  echo "ERROR|No such file or directory"
  exit
fi

if [ ! -r "$1" ]; then
  echo "ERROR|Permission denied"
  exit
fi

CHECK=$(find $1 -type d 2>/dev/null | wc -l)
if [ "$CHECK" -gt 255 ]; then
  echo "ERROR|Result contains ${CHECK} rows. Max 255 allowed";
  exit
fi

#header manually added here...
echo "Folder|Filecount";

DIRS=$(find $1 -type d 2>/dev/null)
while read line;
do
  COUNT=$(find $line -type f 2>/dev/null | wc -l)
  echo "${line}|${COUNT}";
done <<< "${DIRS}"

