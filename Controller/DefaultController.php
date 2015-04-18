<?php

namespace Maalls\AddressBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Maalls\Pager\Request\Pager;
use Maalls\AddressBundle\Form\AddressType;
use Maalls\AddressBundle\Entity\Address;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $pager = new Pager(
            $request, 
            5, 
            array("page" => 1, "limit" => 50, "search" => ""), 
            $this->getRepository()->createQueryBuilder("a")
        );
            
        return $this->render('MaallsAddressBundle:Default:index.html.twig', array('pager' => $pager));
    }

    public function createAction() {

        $form = $this->createForm('address');

        return $this->render('MaallsAddressBundle:Default:edit.html.twig', array('form' => $form->createView()));

    }

    public function editAction($id, Request $request) 
    {

        $address = $this->getRepository()->find($id);

        $form = $this->createForm('address', $address);

        return $this->render('MaallsAddressBundle:Default:edit.html.twig', array('form' => $form->createView()));

    }

    public function updateAction(Request $request) {

        $params = $request->request->get("address");
        
        if($params["id"]) {

            $address = $this->getRepository()->find($params["id"]);

        }
        else {

            $address = new Address();

        }

        $form = $this->createForm('address', $address);
        $form->handleRequest($request);

        if($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();
            $this->addFlash('success', 'Address saved.');
            return $this->redirect($this->generateUrl('maalls_addresses'));

        }
        else {

            return $this->render('MaallsAddressBundle:Default:edit.html.twig', array('form' => $form->createView()));

        }

    }

    protected function getRepository() {

        return $this->getDoctrine()
            ->getManager()
            ->getRepository("MaallsAddressBundle:Address");

    } 
}
