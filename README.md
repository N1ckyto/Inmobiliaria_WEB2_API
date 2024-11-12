# TPE 2024 - Proyecto Inmobiliaria-FN-API

---

# Desarolladores
Escudero Nicolas - Barberia Facundo

---

## Descripción
Este proyecto consiste en una base de datos para una inmobiliaria. El objetivo es gestionar propiedades y propietarios que quieran mostrar sus viviendas a las personas. La base de datos está diseñada para facilitar la administración de las propiedades y las interacciones con los usuarios.
   
---

# Diagrama del Modelo de Datos
![](https://github.com/N1ckyto/Inmobiliaria_WEB2/blob/main/Inmobiliria_db.png)

---

# URL de ejemplo
`.../api/propiedades`
`.../api/propietarios`


## Endpoints

### Propiedades

- **GET** `.../api/propiedades`  
  Devuelve todos los propiedades disponibles en la base de datos, permitiendo ordenar a los resultados.

  - **Query Params**:

    - **Ordenamiento**:

      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:

        - `Id`: Ordena los propiedades por id.
          ```http
          GET .../api/propiedades?orderBy=id
          ```
        - `Ubicacion`: Ordena los propiedades por ubicacion
          ```http
          GET .../api/propiedades?orderBy=ubicacion
          ```
        - `M2`: Ordena los propiedades por m2.
          ```http
          GET .../api/propiedades?orderBy=m2
          ```
        - `Modalidad`: Ordena los propiedades por modalidad.
          ```http
          GET .../api/propiedades?orderBy=modalidad
          ```
        - `Id propietario`: Ordena los propiedades por id del propietario.
          ```http
          GET .../api/propiedades?orderBy=id_propietario
          ```
        - `Precio inicial`: Ordena los propiedades por precoi inicial.
          ```http
          GET .../api/propiedades?orderBy=precio_inicial
          ```
        - `Precio flexible`: Ordena los propiedades por si el precio es flexible.
          ```http
          GET .../api/propiedades?orderBy=precio_flex
          ```

      - `order`: Dirección de orden para el campo especificado en `orderBy`. Puede ser:
        - `ASC`: Orden ascendente (por defecto).
        - `DESC`: Orden descendente.

      **Ejemplo de Ordenamiento**:  
      Para obtener todos las propiedades ordenadas por ubicacion en orden descendente:

      ```http
      GET .../api/propiedades?orderBy=ubicacion&order=desc
      ```
   
---

- **GET** `.../api/propiedades/:ID`  
  Devuelve la propiedad correspondiente al `ID` solicitado.

---

- **PUT** `.../api/propiedades/:ID`  
  Modifica la propiedad correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:
    - `ubicacion`
    - `m2`
    - `modalidad`
    - `id_propietario`
    - `precio_inicial`
    - `precio_flex`
    - `imagen`

---

### Propietarios

- **GET** `.../api/propietarios`  
  Devuelve todos los propietarios disponibles en la base de datos, permitiendo ordenar a los resultados.

  - **Query Params**:

    - **Ordenamiento**:

      - `orderBy`: Campo por el que se desea ordenar los resultados. Los campos válidos pueden incluir:
propietarios
        - `Id`: Ordena los propietarios por id.
          ```http
          GET .../api/propietarios?orderBy=id
          ```
        - `Nombre`: Ordena los propietarios por nombre
          ```http
          GET .../api/propietarios?orderBy=nombre
          ```
        - `Apellido`: Ordena los propietarios por apellido.
          ```http
          GET .../api/propietarios?orderBy=apellido
          ```

      - `order`: Dirección de orden para el campo especificado en `orderBy`. Puede ser:
        - `ASC`: Orden ascendente (por defecto).
        - `DESC`: Orden descendente.

      **Ejemplo de Ordenamiento**:  
      Para obtener todos las propietarios ordenados por nombre en orden descendente:

      ```http
      GET .../api/propietarios?orderBy=nombre&order=desc
      ```
   
---

- **GET** `.../api/propietarios/:ID`  
  Devuelve el propietarios correspondiente al `ID` solicitado.

---

- **PUT** `.../api/propietarios/:ID`  
  Modifica el propietario correspondiente al `ID` solicitado. La información a modificar se envía en el cuerpo de la solicitud (en formato JSON).

  - **Campos modificables**:
    - `nombre`
    - `apellido`
    - `imagen`

---


