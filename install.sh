#!/bin/bash

migration(){
   echo "Executing data migration..."
   echo
   docker exec -it laradock_php-fpm_1 php artisan migrate
   echo
}

rollback(){
   echo "Execute data rolback..."
   echo
   docker exec -it laradock_php-fpm_1 php artisan migrate:rollback
   echo
}

tests(){
  echo "Execute unit testes..."
  echo
  docker exec -it laradock_php-fpm_1 php vendor/bin/phpunit
}

dbash(){
  echo "Connect on docker bash"
  echo
  cd linkable/laradock
  docker-compose exec workspace bash
}

invalid(){
   echo "Invalid option :("
   echo
}

dexit(){
  echo "Bye :)"
  echo
}

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

read option

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
