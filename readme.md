

## About 

    Programa de teste para realização de cadastro, listagem, alteração e exclusão de médicos
e suas especialidades

## Instalação

    Clone o projeto no seu repositório

    utilize o comando:
        docker-compose up -d
    
    entre na pasta bash com o comando:
        docker exec -it hellodoctor_application_1 bash

    acesse a pasta app e utilize o comando:
        composer install

    utilize o comando:
        php artisan migrate

    para criar as tabelas e:
        php artisan db:seed

    para preencher as tabelas de especialidades com os dados iniciais

    saia da pasta bash e acesse o diretório principal do projeto, utitilize os comandos:
        npm install && npm run watch


## Como usar

## Biblioteca Postman