<?php

namespace Zorbus\BannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZorbusBannerBundle:Default:index.html.twig', array('name' => $name));
    }
}
