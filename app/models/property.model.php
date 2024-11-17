<?php

class PropertyModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getProperties($orderBy = false, $order = 'ASC', $filter = false, $valor = false)
    {
        $campos_validos = ['id', 'ubicacion', 'm2', 'modalidad', 'id_propietario', 'precio_inicial', 'precio_flex', 'imagenes'];

        $sql = 'SELECT * FROM propiedades';
        $order = strtoupper($order);
        $params = [];

        if (in_array($filter, $campos_validos) && $valor !== false) {
            $sql .= ' WHERE ' . $filter . ' = ?';
            $params[] = $valor;
        }

        if (in_array($orderBy, $campos_validos)) {
            $sql .= ' ORDER BY ' . $orderBy . ' ' . $order;
        }

        $query = $this->db->prepare($sql);
        $query->execute($params);

        $properties = $query->fetchAll(PDO::FETCH_OBJ);

        return $properties;
    }

    public function getProperty($id)
    {
        $query = $this->db->prepare('SELECT * FROM propiedades WHERE id = ?');

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute([$id]);
        $property = $query->fetch(PDO::FETCH_OBJ);

        return $property;
    }

    public function insertProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM propietarios WHERE id = :id_propietario");
        $stmt->execute(['id_propietario' => $id_propietario]);
        if ($stmt->fetchColumn() == 0) {
            die('Error: El propietario no existe');
        }

        $query = $this->db->prepare('INSERT INTO propiedades (ubicacion, m2, modalidad, id_propietario, precio_inicial, precio_flex, imagen) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    public function updateProperty($id, $ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen)
    {

        $query = $this->db->prepare("UPDATE propiedades SET ubicacion = ?, m2 = ?, modalidad = ?, id_propietario = ?, precio_inicial = ?, precio_flex = ?, imagen = ? WHERE id = ?");
        $query->execute([$ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex, $imagen, $id]);
    }
}
