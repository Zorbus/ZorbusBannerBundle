<?php

namespace Zorbus\BannerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlockController extends Controller
{

    public function bannerAction($block)
    {
        $parameters = json_decode($block->getParameters());
        $banner = $this->getDoctrine()->getRepository('ZorbusBannerBundle:Banner')->find($parameters->banner_id);

        return $this->render('ZorbusBannerBundle:Block:banner.html.twig', array(
                    'block' => $block, 'banner' => $banner
                ));
    }

}
