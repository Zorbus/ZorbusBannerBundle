<?php

namespace Zorbus\BannerBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zorbus\BannerBundle\Entity\Image
 */
abstract class Image
{
    protected $imageTemp;

    public function __toString()
    {
        return $this->getTitle() . '('.$this->getImage().')';
    }

    public function getImageTemp()
    {
        return $this->imageTemp;
    }

    public function setImageTemp($image)
    {
        $this->imageTemp = $image;
    }

    public function getAbsolutePath($file)
    {
        return null === $file ? null : $this->getUploadRootDir() . '/' . $file;
    }

    public function getWebPath($file)
    {
        return null === $file ? null : $this->getUploadDir() . '/' . $file;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/banner';
    }
}
