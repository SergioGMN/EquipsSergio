<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipsController extends AbstractController
{
    private $equips = array(
        array("codi" => 1, "nom" => "Os Tres Porquinhos", "curs" => "22/23", "membres" => array("Sergio", "Marcos", "David")),
        array("codi" => 2, "nom" => "Equip Roig", "curs" => "22/23", "membres" => array("Laura", "Jordi", "Sara", "Marc")),
        array("codi" => 3, "nom" => "Equip Verd", "curs" => "22/23", "membres" => array("Anna", "Pere", "Núria", "Albert")),
        array("codi" => 4, "nom" => "Equip Gris", "curs" => "22/23", "membres" => array("Marcos", "Irene", "Marta", "Rocío")),
    );

    /**
     * @Route("/equip/{codi}", name="dades_equips")
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
            return $this->render("equips.html.twig", array(
                "equip" => $resultat
            ));
        } else {
            return $this->render("equips.html.twig", array(
                "equip" => NULL
            ));
        }
    }

}