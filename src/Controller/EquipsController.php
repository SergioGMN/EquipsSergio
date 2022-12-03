<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipsController
{
    private $equips = array(
        array("codi" => 1, "nom" => "Equip Roig",
            "curs" => "22/23", "membres" => array("Elena", "Vicent", "Joan", "Maria")),
        array("codi" => 2, "nom" => "Os Tres Porquinhos",
            "curs" => "22/23", "membres" => array("Sergio", "Marcos", "David")),
        array("codi" => 3, "nom" => "Equip Blau",
            "curs" => "22/23", "membres" => array("Xavi", "Andrea", "Pau", "Jose")),
        array("codi" => 4, "nom" => "Equip Verd",
            "curs" => "22/23", "membres" => array("Pedro Sánchez", "Carla", "Antoni", "Raul")),
    );

    /**
     * @Route("/equip/{codi}", name="dades_equip")
     */
    public function equip($codi = 1)
    {
        $resultat = array_filter($this->equips,
            function ($equip) use ($codi) {
                return $equip["codi"] == $codi;
            });
        if (count($resultat) > 0) {
            $resposta = "";
            $resultat = array_shift($resultat); #torna el primer element

            $llistaMembres = "";

            foreach ($resultat["membres"] as $membre) {
                $llistaMembres .= $membre . " ";
            }

            $resposta .= "<ul><li>" . $resultat["nom"] . "</li>" .
                "<li>" . $resultat["curs"] . "</li>" .
                "<li>" . $llistaMembres . "</li></ul>";
            return new Response("<html><body>$resposta</body></html>");
        } else {
            return new Response("No s’ha trobat l’equip: " . $codi);
        }
    }

}