<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Description of AccueilControler
 *
 * @author HP
 */
class AccueilControler {
    
    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function index(): Response{
        return new Response('Hello word !');
        
    }
}
