<?php

namespace App\Service;

class ServeiDadesEquip
{
    private $equips = array(
        array("codi" => 1, "nom" => "Os Tres Porquinhos", "curs" => "22/23", "membres" => array("Sergio", "Marcos", "David"), "img" => "imatge-equip-1.png"),
        array("codi" => 2, "nom" => "Equip Roig", "curs" => "22/23", "membres" => array("Laura", "Jordi", "Sara", "Marc"), "img" => "imatge-equip-2.png"),
        array("codi" => 3, "nom" => "Equip Verd", "curs" => "22/23", "membres" => array("Anna", "Pere", "Núria", "Albert"), "img" => "imatge-equip-3.png"),
        array("codi" => 4, "nom" => "Equip Blau", "curs" => "22/23", "membres" => array("Marcos", "Irene", "Marta", "Rocío"), "img" => "imatge-equip-4.png"),
    );

    public function get() {
        return $this->equips;
    }
}