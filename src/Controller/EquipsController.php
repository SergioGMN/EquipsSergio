<?php

namespace App\Controller;

use App\Service\ServeiDadesEquip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipsController extends AbstractController
{
    private $equips;
    public function __construct(ServeiDadesEquip $dades)
    {
        $this->equips = $dades->get();
    }

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