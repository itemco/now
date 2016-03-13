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

#original
SHELL=$(ls -lp --time-style=long-iso $1 | grep -v '/' | grep -v '\->' | sed '1 d' | awk '{print $1"|"$2"|"$3"|"$4"|"$5"|"$6"|"$7"|<a href=#>"$8"</a>"}')

#header manually added here...
echo "Permission|Links|Owner|Group|Size|Date|Time|Name";
echo "${SHELL}"

