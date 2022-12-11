<?php

namespace App\Service;

class ServeiDadesEquip
{
    private $equips = array(
        array("codi" => 1, "nom" => "Os Tres Porquinhos", "curs" => "22/23", "nota" => 10, "cicle" => "DAW", "img" => "imatge-equip-1.png"),
        array("codi" => 2, "nom" => "Equip Roig", "curs" => "22/23", "nota" => 8, "cicle" => "DAM", "img" => "imatge-equip-2.png"),
        array("codi" => 3, "nom" => "Equip Verd", "curs" => "22/23", "nota" => 7, "cicle" => "ASIX", "img" => "imatge-equip-3.png"),
    );

    public function get() {
        return $this->equips;
    }
}