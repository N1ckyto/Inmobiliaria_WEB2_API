<?php

class OwnerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getOwners($orderBy = false,$order = 'ASC', $filter = false)
    {
        $sql = 'SELECT p.id AS propietario_id, p.nombre, p.apellido, COUNT(pr.id) AS numero_de_propiedades
                FROM propietarios p
                LEFT JOIN propiedades pr ON p.id = pr.id_propietario
                GROUP BY p.id, p.nombre, p.apellido
                HAVING COUNT(pr.id) >= ?';
        

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
                case 'propiedades':
                    $sql .= ' ORDER BY numero_de_propiedades';
            }
        }
        
        $query = $this->db->prepare($sql);
        $query->execute([$filter ? $filter : 0]);
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
