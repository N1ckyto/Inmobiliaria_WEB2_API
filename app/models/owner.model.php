<?php

class OwnerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getOwners($orderBy = false, $order = 'ASC', $filter = false, $valor = false)
    {
        $campos_validos = ['id', 'nombre', 'apellido', 'imagen', 'cantidad_propiedades'];

        $sql = 'SELECT p.id, p.nombre, p.apellido, p.imagen, COUNT(pr.id) AS cantidad_propiedades
            FROM propietarios p
            LEFT JOIN propiedades pr ON p.id = pr.id_propietario';

        $order = strtoupper($order);
        $params = [];

        if ($filter === 'cantidad_propiedades' && is_numeric($valor)) {
            $sql .= ' GROUP BY p.id, p.nombre, p.apellido, p.imagen HAVING cantidad_propiedades = ?';
            $params[] = $valor;
        } elseif (in_array($filter, $campos_validos) && $valor !== false) {
            $sql .= ' WHERE ' . $filter . ' = ? GROUP BY p.id, p.nombre, p.apellido, p.imagen';
            $params[] = $valor;
        } else {
            $sql .= ' GROUP BY p.id, p.nombre, p.apellido, p.imagen';
        }

        if (in_array($orderBy, $campos_validos)) {
            $sql .= ' ORDER BY ' . $orderBy . ' ' . $order;
        }

        $query = $this->db->prepare($sql);
        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function insertOwner($nombre, $apellido, $imagen)
    {
        $query = $this->db->prepare('INSERT INTO propietarios (nombre, apellido, imagen) VALUES (?, ?, ?)');
        $query->execute([$nombre, $apellido, $imagen]);
        return $this->db->lastInsertId();
    }

    public function getOwner($id)
    {
        $query = $this->db->prepare('
        SELECT p.id, p.nombre, p.apellido, p.imagen, COUNT(pr.id) AS cantidad_propiedades
        FROM propietarios p
        LEFT JOIN propiedades pr ON p.id = pr.id_propietario
        WHERE p.id = ?
        GROUP BY p.id, p.nombre, p.apellido, p.imagen
    ');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function updateOwner($id, $nombre, $apellido, $imagen)
    {
        $query = $this->db->prepare('UPDATE propietarios SET nombre = ?, apellido = ?, imagen = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $imagen, $id]);
    }
}
