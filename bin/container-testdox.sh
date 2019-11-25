#!/bin/bash

if [ -z "$1" ]
then
    PARAM=tests
else
    PARAM=$1
fi

docker exec -ti gpg-php71 ./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox $PARAM