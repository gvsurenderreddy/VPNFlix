#!/bin/bash
HOSTS="   "
COUNT=4

pingtest(){
  for myHost in "$@"
  do
    ping -c "$COUNT" "$myHost" && return 1
  done
  return 0
}

if pingtest $HOSTS
then
  # 100% failed
  echo "Server failed at $(date)" | mail -s "Server Down" tompavey@gmail.com
  echo "All hosts ($HOSTS) are down (ping failed) at $(date)"
fi