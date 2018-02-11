#!/bin/bash

word=`echo ${1} | sed -e "s/ //g" | sed -e "s/+//g"`

wget http://ejje.weblio.jp/content/"${word}" -q -P /home/user/tmp/

word2=`cat /home/user/tmp/${word} | grep description | head -1 | cut -d " " -f 4- | cut -d "." -f 1 | sed "s/;/,/g" | sed -e "s/<//g" | sed -e "s/>//g" | sed -e "s/\&//g" | sed -e "s/^ //g" | sed -e "s/;/,/g" | sed -e "s/；/,/g" | sed -e "s/ \+//g" | sed -e "s/\n//g" | sed -e "s/\t//g" | sed -e "s/ //g"`
echo -n "${word2}"

rm -f /home/user/tmp/${word}
