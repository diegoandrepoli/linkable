#!/bin/bash

dstart(){
   echo "start docker container..."
   echo
   cd linkable/laradock 
   docker-compose up -d nginx mysql redis
   echo
}

dstop(){
   echo "Stop docker container..."
   echo
   docker kill $(docker ps -q)   
   echo
}

dexit(){
  echo "Bye :)"
  echo 
}

invalid(){
   echo "Invalid option :("
   echo
}

clear
echo
echo "Welcome to Linkable, this is your new url shorted"
echo 
echo "Select one option to continue:"
echo "1 - Start system"
echo "2 - Shutdown system"
echo "3 - Exit"
echo

read option

if [ "$option" = 1 ];then
  dstart
elif [ "$option" = 2 ];then
  dstop
elif [ "$option" = 3 ];then
  dexit
else
  invalid
fi
