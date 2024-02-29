# Symfony Base Repository

This repository contains the basic configuration to run Symfony applications with MySQL database

## Content
- PHP-APACHE container running version 8.2
- MySQL container running version 8.2.0

## Instructions
- `make build` to build the containers
- `make start` to start the containers
- `make stop` to stop the containers
- `make restart` to restart the containers
- `make prepare` to install dependencies with composer (once the project has been created)
- `make logs` to see application logs
- `make ssh` to SSH into the application container

## Create and Run the application
- [Optional] Replace all the occurrences of symfony-app in the whole project with some name more meaningful for your project
- `make start` to build and start the containers (you can use your IDE find and replace option to do so)
- SSH into the container with `make ssh`
- Create a Symfony project using the CLI (e.g. `symfony new --no-git --dir project`). See `symfony`command info for more options
- Move all the content in the `project` folder to the root of the repository (do not forget to move also `.env`file)
- Add the content of `.gitignore` file to the root one, it should look like this
```
.idea
.vscode
docker-compose.yml

###> symfony/framework-bundle ###
/.env.local
/.env.local.php
/.env.*.local
/config/secrets/prod/prod.decrypt.private.php
/public/bundles/
/var/
/vendor/
###< symfony/framework-bundle ###
```
- Once you have installed you Symfony application go to http://localhost:1000




1. DOMAIN

    - Entity (ej User)
      - ORM mapping doctrine
      - create or construct para inicializar
      - setters y getters
      - toString or jsonSerialize

    - Repositorio (Interficies impl en Arquitech)
      - Solo declarar los métodos a utilizar
      - [PSxS] Single responsability principle
      - [PSxD] Inversión de dependencias

^

1. APPLICATION 

    - Caso de uso N

      - Instanciamos Interficie de dominio (para acceder a los datos independientemente de la capa de persistencia [PSxD] Inversión de dependencias)
    
      - Inicializamos en privado el repositorio
  
      - Método execute que se lanza desde el controller donde recogemos los datos del repositorio según método ($repo->method) del caso de uso, y devolvemos el resultado al controller

      - Desde aquí 


^

3. ARQUITECTURE






** CONCEPTOS **


* Enfoque: La arquitectura hexagonal se centra principalmente en la estructura técnica y la separación de capas de una aplicación. DDD se enfoca más en el modelado del dominio y la lógica de negocio.

* Dominio: En DDD el dominio es el centro y la prioridad. En la arquitectura hexagonal el dominio es solo una capa más.

* Modelos: DDD hace mucho énfasis en la creación de modelos de dominio ricos. La arquitectura hexagonal no impone nada sobre los modelos.

* Patrones: DDD utiliza patrones como Aggregate, Entity, Value Object, Repository, etc. La arquitectura hexagonal no define patrones específicos.

* Testing: DDD permite el testing fácil al tener los modelos separados. La arquitectura hexagonal se enfoca más en testing a nivel de capas.

* Flexibilidad: La arquitectura hexagonal permite cambiar capas internas sin afectar el exterior. DDD se enfoca más en el dominio que en los detalles técnicos.


Casos:

Tener múltiples métodos relacionados con la misma entidad en un repository interface es una práctica común y no viola necesariamente SRP o ISP.

Lo importante es que cada interfaz y clase tenga una única responsabilidad bien definida. Pero puedes balancear el número de interfaces para mantener un diseño simple y legible.


** UNIT TESTS **

* Misma estructura, los unit test from use cases, pero en vez de usar el controller, se usa el repositorio.

* 
