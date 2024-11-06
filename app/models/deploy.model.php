<?php 
class DeployModel {
    protected $db;
    
    public function __construct() {
        $this->db = new PDO("mysql:host=".MYSQL_HOST .";dbname=".MYSQL_DB.";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
            CREATE TABLE `usuarios` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `usuario` varchar(40) NOT NULL,
                `password` varchar(60) NOT NULL,
                PRIMARY KEY (`id`)
            );
            CREATE TABLE `propietarios` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `nombre` VARCHAR(100) NOT NULL,
                `apellido` VARCHAR(100) NOT NULL,
                PRIMARY KEY (`id`)
            );
            CREATE TABLE `propiedades` (
                `id` INT(11) NOT NULL AUTO_INCREMENT,
                `ubicacion` VARCHAR(255) NOT NULL,
                `m2` INT(11) NOT NULL,
                `modalidad` VARCHAR(100) NOT NULL,
                `precio_inicial` DECIMAL(10, 2) NOT NULL,
                `precio_flexible` TINYINT(1) NOT NULL,
                `imagen` VARCHAR(255) DEFAULT NULL,
                `id_propietario` INT(11) NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`id_propietario`) REFERENCES `propietarios`(`id`) 
                ON DELETE CASCADE
            );
            END;
            
            $this->db->query($sql);
        }
    }
}
