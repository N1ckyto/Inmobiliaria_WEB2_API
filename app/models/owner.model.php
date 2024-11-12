<?php

class OwnerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getOwners($orderBy = false, $order = 'ASC')
    {
        $sql = 'SELECT * FROM propietarios';

        if ($orderBy) {
            $sql .= ' ORDER BY ';
            switch ($orderBy) { //"aca es depende el case es lo que queres ordenar"
                case 'id':
                    $sql .= ' id';
                    break;
                case 'nombre':
                    $sql .= ' nombre';
                    break;
                case 'apellido':
                    $sql .= ' apellido';
                    break;
            }
        }

        $order = strtoupper($order); //strtoupper convierte a mayuscula asc o desc
        if ($order === 'DESC') {
            $sql .= ' DESC';
        } else {
            $sql .= ' ASC';
        }

        $query = $this->db->prepare($sql);
        $query->execute();

        // Obtiene los propietarios en un arreglo de objetos
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function countPropertiesByOwner($id)
    {
        $query = $this->db->prepare('SELECT COUNT(*) AS total FROM propiedades WHERE id_propietario = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ)->total;
    }

    public function insertOwner($nombre, $apellido, $imagen)
    {
        $query = $this->db->prepare('INSERT INTO propietarios (nombre, apellido, imagen) VALUES (?, ?, ?)');
        $query->execute([$nombre, $apellido, $imagen]);
        return $this->db->lastInsertId();
    }

    // Obtener un propietario específico por ID
    public function getOwner($id)
    {
        $query = $this->db->prepare('SELECT id,nombre, apellido, imagen FROM propietarios WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateOwner($id, $nombre, $apellido, $imagen)
    {
        $query = $this->db->prepare('UPDATE propietarios SET nombre = ?, apellido = ?, imagen = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $imagen, $id]);
    }

    public function deleteOwner($id)
    {
        $query = $this->db->prepare('DELETE FROM propietarios WHERE id = ?');
        $query->execute([$id]);
    }
}
