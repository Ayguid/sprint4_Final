# sprint4

Installation

1) Clone the repository

2) Switch to the repo folder
  - cd srint4

3) Install all the dependencies using composer
  - composer install

4) Copy the example env file and make the required configuration changes in the .env file
  - cp .env.example .env

5) Generate a new application key
  - php artisan key:generate

6) Run the database migrations (Set the database connection in .env before migrating)
  - php artisan migrate

-Just in case:
  1) cd into public, and run // rm storage
  2) cd .. one step up
  3) Run> php artisan storage:link

7) Start the local development server
  - php artisan serve

* For image resize to work.
sudo apt-get install php7.2-gd



SPANISH : 

cosas importantisimas para proyecto en Laravel

1.Crear una base de datos llamada textual "usuariosSoyBuenoEn1"
2.Pararse dentro de la carpeta master del repo..y correr//Composer install.
3.Generar .env
4.php artisan k:g //dentro de la carpeta master
5.php artisan migrate. //dentro de la carpeta master
6.Parado adentro de la carpeta master...correr//cd public
7.Ejecutar...//rm storage
8.Subir un escalon...//cd ..
9.php artisan storage:link...//dentro de la carpeta master
10.Levantar el server...//php artisan serve


CLAVE PARA EL IMAGE RESIZE!!!!
sudo apt-get install php7.2-gd



Cumple con los siguientes optativos.

Para la red social buscamos agregar:
La posibilidad de "Seguir Usuarios". De esta forma, en nuestro feed ya no apareceran posteos al azar sino los de las personas que sigamos
Buscador de usuarios
La posibilidad de que los posteos sean de alguna de las siguientes categorías:
Texto
Hipervinculo
Imágen
