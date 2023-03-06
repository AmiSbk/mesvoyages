<?php

namespace App\Controller\admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VisiteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Visite;
use App\Form\VisiteType;







/**
 * Description of VoyagesController
 *
 * @author HP
 */
class AdminVoyagesController extends AbstractController{
    

    /**
    * 
    * @var VisiteRepository
    */
   private $repository;

   /**
    * 
    * @param VisiteRepository $repository
    */
   public function __construct(VisiteRepository $repository){

       $this->repository = $repository;
   }
   
     /**
     * @Route("/admin", name="admin.voyages")
     * @return Response
     */
    public function index(): Response{
        $visites = $this->repository->findAllOrderBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", [
            'visites'=> $visites
        ]);        
    }
        
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite) : Response{
        $this->repository->remove($visite, true);
        return $this->redirectToRoute('admin.voyages');
    }
    
     /**
     * @Route("/admin/edit/{id}", name="admin.voyage.edit")
     * @param Visite $visite
     * @param Request $request
     * @return Response
     */
    public function edit(Visite $visite, Request $request) : Response{
        $formVisite = $this->createForm(VisiteType::class, $visite);
        
        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted() && $formVisite->isValid()){
            $this->repository->add($visite, true);
            return $this->redirectToRoute('admin.voyages');
        }
        return $this->render("admin/admin.voyage.edit.html.twig", [
            'visite' => $visite,   
            'formvisite' => $formVisite->createView()
        ]);
    }
    
    /**
     * @Route("/admin/ajout", name="admin.voyage.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout( Request $request) : Response{
        $visite = new Visite();
        $formVisite = $this->createForm(VisiteType::class, $visite);
        
        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted() && $formVisite->isValid()){
            $this->repository->add($visite, true);
            return $this->redirectToRoute('admin.voyages');
        }
        return $this->render("admin/admin.voyage.ajout.html.twig", [
            'visite' => $visite,   
            'formvisite' => $formVisite->createView()
        ]);
    }
    
   /**
    * @Route("/voyages/tri/{champ}/{ordre}", name="voyages.sort")
    * @param type $champ
    * @param type $ordre
    * @return Response
    */
  #  public function sort($champ, $ordre): Response{
    #   $visites = $this->repository->findAllOrderBy($champ, $ordre);
     #  return $this->render("admin/admin.voyages.html.twig", [
      #     'visites'=> $visites
       #]);   
    #}
    /**
     * @Route("/voyages/recherche/{champ}", name="voyages.findallequal")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
   # public function findAllEqual($champ, Request $request): Response{
    #    $valeur = $request->get("recherche");
     #   $visites = $this->repository->findByEqualValue($champ, $valeur);
      #  return $this->render("admin/admin.voyages.html.twig", [
       #     'visites'=> $visites
        #]);   
   # }
    
    /**
     * @Route("/voyages/voyage/{id}", name="voyages.showone")
     * @param type $id
     * @return Response
     */
  #  public function showOne($id): Response{
   #     $visite = $this->repository->find($id);
    #    return $this->render("admin/admin.voyages.html.twig", [
     #       'visite'=> $visite
      #  ]);        
    #}

 
    
}
