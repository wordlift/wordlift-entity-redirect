#!/usr/bin/env bash

docker run --rm --volumes-from docker_wordlift-entity-redirect-wordpress_1 --network container:docker_wordlift-entity-redirect-wordpress_1 --user 33:33 wordpress:cli --path=/var/www/html "$@"
