<?php

class Stadt {

    private $id;
    private $name;

    // Konstruktor
    public function __construct($name, $id = NULL) {
        $this->name = $name;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    // Getter
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public static function getAllByName($name) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM stadt WHERE name LIKE ?");
        $stmt->bindValue(1, $name, PDO::PARAM_STR);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stadt = [];
        foreach ($rows as $row) {
            $stadt[] = new Stadt($row['name'], $row['id']);
        }
        return $stadt;
    }
}
