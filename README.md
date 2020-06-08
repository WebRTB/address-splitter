# PHP Address splitter
Ultimate goal is to split street, house number and addition from address input for all country formats.

## Currently supported:
- Netherlands address format (nl_NL)
- Belgian address (nl_BE)

## Wantend formats:
- French (fr_FR)
- German
- British

## Testing:
After running `composer install` you can run tests locally with composer using `./vendor/bin/phpunit`.

Or be lazy like me and use our docker container, just run:
```
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php ./vendor/bin/phpunit
```