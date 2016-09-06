<?php

class Teilnehmer {

    private $id;
    private $vorname;
    private $nachname;
    private $stadtname;

    // Konstruktor
    public function __construct($vorname, $nachname, $stadtname, $id = NULL) {
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->stadtname = $stadtname;
        if (!is_null($id)) {
            $this->id = $id;
        }
    }

    // Getter
    public function getId() {
        return $this->id;
    }

    public function getVorname() {
        return $this->vorname;
    }

    public function getNachname() {
        return $this->nachname;
    }

    public function getStadtId() {
        return $this->stadtname;
    }

    public static function getTeilnehmerBystadtId($stadt) {
        $db = DbConnect::getConnection();
        
        $stmt = $db->prepare("SELECT * FROM teilnehmer WHERE stadt_id=?");
        $stmt->bindValue(1, $stadt->id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $teilnehmer = [];
        $i = 0;
        foreach ($rows as $row) {
            $teilnehmer[$i] = new Teilnehmer($row['vorname'], $row['nachname'], $stadt->name);
        }
        return $teilnehmer;
    }
}
