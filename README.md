## Background

This is an unfinished version of a non-commercial image server. It started as an attempt to learn principles of TDD,
benefits of static code analysis and new features of PHP 8. While it isn't a code I'm ashamed of, it is certainly not
perfect, nor is it production ready.

Currently the project contains a functionality of collecting allowed image extensions and mime types from PHP classes
contained in a specified directory. It works simply by iterating classes in a directory and reading its attributes. 

## Running/proof of work

While the project isn't finished, it can be started using docker by following the steps below.

1. I'm in the project's root directory.
1. I make sure that project files are accessible by www-data.
    1. `sudo chown -R <your Linux user name>:www-data .`. Given your Linux user name is damian: `sudo chown -R damian:www-data .`.
    1. `sudo find . -type d -exec chmod 775 {} \;`.
    1. `sudo find . -type f -exec chmod 664 {} \;`.
1. I run the docker container `docker-compose up -d`.
1. I send a request to `curl --location --request POST 'http://127.0.0.1:81/image' \
   --data-raw ''`.
1. I see available image extensions and mime types contained in `src/Upload/ImageType`.
