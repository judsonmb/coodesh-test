# Open Food Import Project

## About

This project is a REST API designed to utilize data from the Open Food Facts project, which is an open database containing nutritional information for various food products. The goal of the project is to support the nutritionist team at Fitness Foods LC by providing a quick way to review the nutritional information of food products submitted by users through the mobile application.

- This is a challenge by [coodesh](http://coodesh.com).

## You need

- PHP 8.2;
- Docker;
- Docker compose;

## Installing

- The repo: https://github.com/judsonmb/coodesh-test/tree/master/open-food

- create the .env file and after update the db password (default root)

```
cp .env.example .env
```

- build the docker containers

```
make up
```

- if you dont want use ip to access the application, 

```
sudo /etc/hosts
```

- and add 127.0.0.1 api-openfood.local register

- if you have problems with permissions, run:

```
make permissions
```

- Finally, you can access the application using in browser: http://api-openfood.local/


