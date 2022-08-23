## Background

This is an unfinished version of a non-commercial image server. It started as an attempt to learn principles of TDD,
benefits of static code analysis and new features of PHP 8. While it isn't a code I'm ashamed of, it is certainly not
perfect, nor is it production ready.

Currently the project contains a functionality of collecting allowed image extensions and mime types from PHP classes
contained in a specified directory. It works simply by iterating classes in a directory and reading its attributes. 

## Running/proof of work

Though the project isn't finished, it can be started using docker by following the steps below.

### Starting the project

1. I'm in the project's root directory.
1. I make sure that project files are accessible by www-data.
    1. `sudo chown -R <your Linux user name>:www-data .`. Given your Linux user name is damian: `sudo chown -R damian:www-data .`.
    1. `sudo find . -type d -exec chmod 775 {} \;`.
    1. `sudo find . -type f -exec chmod 664 {} \;`.
1. I run the docker container `docker-compose up -d`.
1. I wait for image-server container to install composer dependencies. This can be verified with `docker-compose logs -f image-server`.
   
### Sending an empty POST request /image

1. I send a request to `curl --location --request POST 'http://127.0.0.1:81/image' \
   --data-raw ''`.
1. I see available image extensions and mime types contained in `src/Upload/ImageType`.

### Running unit tests

```sh
docker-compose exec image-server php vendor/bin/phpunit
```

### Running phpstan

```sh
docker-compose exec image-server php vendor/bin/phpstan
```

### Running code-style fixer

```sh
docker-compose exec image-server php vendor/bin/php-cs-fixer fix --allow-risky=yes
```
