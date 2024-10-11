#!/bin/bash
# This script is used to run artisan commands on a remote server

DB_SERVICE_NAME="Postgres"
CACHE_SERVICE_NAME="Redis"

TMP_ENV_FILE=$(mktemp)

# Get the environment variables from the remote server
railway variables --json | jq -r 'to_entries' > $TMP_ENV_FILE
railway variables -s $DB_SERVICE_NAME --json | jq -r 'to_entries | [.[] | select(.key | contains("PUBLIC_URL"))]' | sed 's/PUBLIC_URL/URL/' >> $TMP_ENV_FILE
railway variables -s $CACHE_SERVICE_NAME --json | jq -r 'to_entries | [.[] | select(.key | contains("PUBLIC_URL"))]' | sed 's/PUBLIC_URL/URL/' >> $TMP_ENV_FILE
ENV_STRING=$(cat $TMP_ENV_FILE | jq -cr '.[] | [.key, .value] | join("=")')
# echo $ENV_STRING

env $ENV_STRING php artisan "$@"

rm -f TMP_ENV_FILE
