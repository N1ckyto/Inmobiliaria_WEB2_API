<?php

class PropertyModel
{
    private $db;

    public function __construct()
    {
        // Conexión a la base de datos inmobiliaria_db
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    // Obtener todas las propiedades
    public function getProperties($orderBy = false, $order = 'ASC', $filter = false) // falta hacer que funcione el filtro
    {
        $campos_validos = ['id', 'ubicacion', 'm2', 'modalidad', 'id_propietario', 'precio_inicial', 'precio_flex', 'imagenes'];

        $sql = 'SELECT * FROM propiedades';

        if (in_array($orderBy, $campos_validos)) {
            $sql .= ' ORDER BY ' . $orderBy;
        }

        if ($order) {
            $order = strtoupper($order); //strtoupper convierte a mayuscula asc o desc
            if ($order === 'DESC') {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }
        }

        // Consulta para obtener todas las propiedades
        $query = $this->db->prepare($sql);
        $query->execute();

        // Obtiene las propiedades en un arreglo de objetos
        $properties = $query->fetchAll(PDO::FETCH_OBJ);

        return $properties;
    }

    // Obtener una propiedad específica por ID
    public function getProperty($id)
    {
        $query = $this->db->prepare('SELECT * FROM propiedades WHERE id = ?');

        // Obtiene la propiedad
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute([$id]);
        $property = $query->fetch(PDO::FETCH_OBJ);

        return $property;
    }

    public function getOwners()
    {
        $query = $this->db->prepare('SELECT id,nombre,apellido,imagen FROM propietarios');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Insertar una nueva propiedad en la base de datos
    public function insertProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM propietarios WHERE id = :id_propietario");
        $stmt->execute(['id_propietario' => $id_propietario]);
        if ($stmt->fetchColumn() == 0) {
            die('Error: El propietario no existe');
        }
        // Inserta una nueva propiedad con los campos necesarios
        $query = $this->db->prepare('INSERT INTO propiedades (ubicacion, m2, modalidad, id_propietario, precio_inicial, precio_flex, imagen) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen]);

        // Obtiene el último ID insertado
        $id = $this->db->lastInsertId();

        return $id;
    }

    public function updateProperty($id, $ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen)
    {
        // Actualiza una propiedad con los datos proporcionados

        $query = $this->db->prepare("UPDATE propiedades SET ubicacion = ?, m2 = ?, modalidad = ?, id_propietario = ?, precio_inicial = ?, precio_flex = ?, imagen = ? WHERE id = ?");
        $query->execute([$ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen, $id]);
    }
}
