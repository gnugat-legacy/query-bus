#!/usr/bin/env bash

vendor/bin/phpspec run -f dot && vendor/bin/phpunit && vendor/bin/php-cs-fixer fix --dry-run --config=sf23 .
