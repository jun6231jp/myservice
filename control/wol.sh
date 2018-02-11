#!/bin/bash

sudo etherwake MACaddress -i wlan0

for i in {0..30}
do
 ret=`ping -c 1 IPaddress | grep "1 received"`
 if [ "$ret" != "" ]; then
  exit 0
 fi
 sleep 3s
done

exit 1
