<?php

namespace App\Controller;

use App\Entity\Equip;
use App\Entity\Membre;
use App\Service\ServeiDadesEquip;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
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
     * @Route("/equip/inserir", name="inserir_equip")
     */
    public function inserir(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $equip = new Equip();
        $equip->setNom("Simarrets");
        $equip->setCicle("DAW");
        $equip->setCurs("22/23");
        $equip->setNota(9);
        $equip->setImatge("equipPerDefecte.png");

        $entityManager->persist($equip);
        try {
            $entityManager->flush();
            return $this->render('insert_equip.html.twig', [
                'equip' => $equip,
                'success' => true,
            ]);
        } catch (Exception $e) {
            return $this->render('insert_equip.html.twig', [
                'error' => $e->getMessage(),
                'success' => false,
            ]);
        }
    }

    /**
     * @Route("/equip/inserirmultiple", name="inserir_multiple")
     */
    public function inserirMultiple(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $success = true;
        $error = null;
        $equipsCreats = array();

        foreach ($this->equips as $equipDades) {
            $equip = new Equip();
            $equip->setNom($equipDades['nom']);
            $equip->setCicle($equipDades['cicle']);
            $equip->setCurs($equipDades['curs']);
            $equip->setNota($equipDades['nota']);
            $equip->setImatge($equipDades['img']);

            $entityManager->persist($equip);
            try {
                $entityManager->flush();
                $equipsCreats[] = $equip;
            } catch (Exception $e) {
                $error = $e->getMessage();
                $success = false;
                break;
            }
        }

        return $this->render('insert_equip_multiple.html.twig', array(
           'success' => $success,
           'error' => $error,
            'equips' => $equipsCreats
        ));
    }


    /**
     * @Route("/equip/{codi}", name="dades_equips", defaults={"codi": 1})
     */
    public function equip($codi, ManagerRegistry $doctrine)
    {
        $repositori = $doctrine->getRepository(Equip::class);
        $equip = $repositori->find($codi);

        if ($equip) {
//            $llistaMembres = "";
//
//            foreach ($resultat["membres"] as $membre) {
//                $llistaMembres .= $membre . " ";
//            }

            return $this->render("equips.html.twig", array(
                "equip" => $equip
            ));
        } else {
            return $this->render("equips.html.twig", array(
                "equip" => NULL
            ));
        }
    }

    /**
     * @Route("/equip/nota/{nota}", name="filtrar_notes", requirements={"nota"="^(1[0]|[0-9])(\.[0-9]{1,2})?$"})
     */
    public function filtrarNotes($nota, ManagerRegistry $doctrine)
    {
        $qb = $doctrine->getRepository(Equip::class)->createQueryBuilder('e');
        $qb->andWhere('e.nota >= :nota')
            ->setParameter('nota', $nota);

        $equips = $qb->getQuery()->getResult();

        $updatedEquips = [];
        foreach ($equips as $equip) {
            $updatedEquipName = $equip->getNom() . ' (Nota: ' . $equip->getNota() . ')';
            $updatedEquips[] = [
                'id' => $equip->getId(),
                'nom' => $updatedEquipName,
            ];
        }

        return $this->render('inici.html.twig', [
            'equips' => $updatedEquips
        ]);
    }

}