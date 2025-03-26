#!/bin/bash

CHECK_RECORD_FILE=$(mktemp)

cd $(dirname $0)

echo 'GitHub workflow migrator PHP version:'
cat .github/workflows/migrate-db.yml | awk '{if(match($0, /php-version: /)){print substr($0, RLENGTH+RSTART, 7)}}' | sed "s/'//g" | tee $CHECK_RECORD_FILE

echo 'Dockerfile (web) PHP version:'
cat Dockerfile | awk '{if(match($0, /php:/)){print substr($0, RLENGTH+RSTART, 5)}}' | tee -a $CHECK_RECORD_FILE

echo 'Dockerfile (batch) PHP version:'
cat batch.Dockerfile | awk '{if(match($0, /php:/)){print substr($0, RLENGTH+RSTART, 5)}}' | tee -a $CHECK_RECORD_FILE

LINES=$(cat $CHECK_RECORD_FILE | sort -u | wc -l)
if [ $LINES -gt 1 ]; then
	echo 'PHP version integrity check failed.'
	exit 1
else
	echo 'PHP version integrity checked.'
fi

