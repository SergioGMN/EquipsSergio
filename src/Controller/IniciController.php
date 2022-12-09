<?php

namespace App\Controller;

use App\Service\ServeiDadesEquip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IniciController extends AbstractController
{
    private $logger;
    private $dades;

    public function __construct($logger, ServeiDadesEquip $dadesEquips)
    {
        $this->logger = $logger;
        $this->dades = $dadesEquips->get();
    }

    /**
     * @Route("/", name="inici")
     */
    public function inici()
    {
        $data_hora = new \DateTime();
        $this->logger->info("Accés el " . $data_hora->format("d/m/y H:i:s"));

        return $this->render("inici.html.twig", array(
            "equips" => $this->dades
        ));
    }
}