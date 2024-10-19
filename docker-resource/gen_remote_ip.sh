#!/bin/bash

echo 'RemoteIPHeader CF-Connecting-IP'
echo 'RemoteIPTrustedProxy' $(curl -s https://www.cloudflare.com/ips-v4 | tr '\n' ' ')
echo 'RemoteIPTrustedProxy' $(curl -s https://www.cloudflare.com/ips-v6 | tr '\n' ' ')
