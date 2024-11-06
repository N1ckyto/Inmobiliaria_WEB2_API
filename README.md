# TPE 2024 - Proyecto Inmobiliaria-FN-API

# Desarolladores
Escudero Nicolas - Barberia Facundo

## Descripción
Este proyecto consiste en una base de datos para una inmobiliaria. El objetivo es gestionar propiedades y propietarios que quieran mostrar sus viviendas a las personas. La base de datos está diseñada para facilitar la administración de las propiedades y las interacciones con los usuarios.

# Explicacion de la Inmobiliaria
## Tablas
1.  **`propietarios`**  
   Contiene propietarios de propiedades (Categorías).

2. **`propiedades`**  
   Describe las propiedades, asociadas a `propietarios` con `id_propietario` y se actualizan automáticamente si el `id` de `propietario` cambia (Elemento).

3. **`usuario`**  
   Describe los usuarios, asiciasdos al login en el sitio web con `usuario` y `password` para que si los valores considen el usuario pueda hacer cambios en los campos `propietarios` y `propiedades`.
   
# Diagrama del Modelo de Datos
![](https://github.com/N1ckyto/Inmobiliaria_WEB2/blob/main/Inmobiliria_db.png)

# Desplegar sitio web
Pasos a seguir para poder desplegar el sitio web:

1. Instalar XAMPP en la computadora local junto con PhpMyAdmin.
2. Encender Apache y MySQL para utilizar la misma como servidor local.
3. Crear una base de datos en PhpMyAdmin.
4. Importar el archivo `inmobiliaria_db.sql` en PHPMyAdmin para cargar la estructura y datos iniciales.
5. Navegar por la pagina WEB.

# Usuario admin
Para poder loguearse como administrador es necesario contar con la siguiente información:
1. Username: `webadmin`.
2. Password: `admin`.



