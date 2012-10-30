<?php

namespace Zorbus\BannerBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\BannerBundle\Entity\Banner
 */
abstract class Banner
{
    public function __toString()
    {
        return $this->getName();
    }
}
