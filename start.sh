#!/bin/bash

##
## Start nginx, mysql and redis Docker containers
##
dstart(){
   echo "start docker container..."
   echo
   cd linkable/laradock 
   docker-compose up -d nginx mysql redis
   echo
}

##
## Stop all docker containers :O
##
dstop(){
   echo "Stop docker container..."
   echo
   docker kill $(docker ps -q)   
   echo
}

##
## Exit on script
##
dexit(){
  echo "Bye :)"
  echo 
}

##
## Invalid option script
##
invalid(){
   echo "Invalid option :("
   echo
}

## User friendly script messages
clear
echo
echo "Welcome to Linkable, this is your new url shorted"
echo 
echo "Select one option to continue:"
echo "1 - Start system"
echo "2 - Shutdown system"
echo "3 - Exit"
echo

## Read console option
read option

## Match the selected option
if [ "$option" = 1 ];then
  dstart
elif [ "$option" = 2 ];then
  dstop
elif [ "$option" = 3 ];then
  dexit
else
  invalid
fi
