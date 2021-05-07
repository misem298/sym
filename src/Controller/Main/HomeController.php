<?php


namespace App\Controller\Main;
use Psr\Container\ContainerInterface;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends BaseController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        $forRender = parent::renderDefault();
        $forRender['title'] = 'main page';
        return $this->render('main/index.html.twig', $forRender);
    }
}