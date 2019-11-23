#!/bin/bash

sudo etherwake 30:5A:3A:56:34:41 -i wlan0
sudo etherwake 30:5A:3A:56:34:41 -i wlan0
sudo etherwake 30:5A:3A:56:34:41 -i wlan0
 ret=`ping -c 1 192.168.11.11 | grep "1 received"`
 if [ "$ret" != "" ]; then
  exit 0
 else
  exit 1
 fi
