#!/bin/bash

##
## Execute Laravel migrations on Docker exec command
##
migration(){
   echo "Executing data migration..."
   echo
   docker exec -it laradock_php-fpm_1 php artisan migrate
   echo
}

##
## Execute Laravel rollback migration on Docker exec command
##
rollback(){
   echo "Execute data rolback..."
   echo
   docker exec -it laradock_php-fpm_1 php artisan migrate:rollback
   echo
}

##
## Execute Laravel tests on PHP Unit
##
tests(){
  echo "Execute unit testes..."
  echo
  docker exec -it laradock_php-fpm_1 php vendor/bin/phpunit
}

##
## Connect to bash Laravel application
##
dbash(){
  echo "Connect on docker bash"
  echo
  cd linkable/laradock
  docker-compose exec workspace bash
}

##
## Method on invalid script option
##
invalid(){
   echo "Invalid option :("
   echo
}

##
## Exit the script
##
dexit(){
  echo "Bye :)"
  echo
}

## print to friendly user options 
clear
echo
echo "Welcome to system install"
echo 
echo "Important: execute this script after start application, to start execute start.sh script"
echo
echo "To continue select one option:"
echo "1 - Execute data migration"
echo "2 - Remove data migration"
echo "3 - Execute test unit"
echo "4 - Conect the docker bash"
echo "5 - Exit"
echo

## read user option
read option

## match the option selected
if [ "$option" = 1 ];then
  migration
elif [ "$option" = 2 ];then
  rollback
elif [ "$option" = 3 ];then
  tests
elif [ "$option" = 4 ];then
  dbash
elif [ "$option" = 5 ];then
  dexit
else
  invalid
fi
