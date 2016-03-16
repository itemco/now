#!/bin/sh

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

#SHELL=$(ls -l --time-style=long-iso $1 | grep '^d' | grep -v '\->' | awk '{print $1"|"$2"|"$3"|"$4"|"$5"|"$6"|"$7"|"$8}')
#SHELL=$(tree -Fifa --noreport /home/andhan/ | sed 's/*//g' | awk -F"/" '{out=""; for(i=2;i<=NF;i++){out=out"|"$i}; print out}')
#SHELL=$(tree -Fifa --noreport $1 | sed 's/*//g' | grep -v "\->")

#removing inaccessible files and folders, and remove links too
SHELL=$(tree -Fifa --noreport $1 | sed 's/*//g' | grep -v '\[error opening dir\]' | grep -v "\->" | tail -n +2)

#OBS! files only, p-flag

#header manually added here...
echo "${SHELL}"

