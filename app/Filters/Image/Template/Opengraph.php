<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Opengraph implements FilterInterface
{
  protected $size = 1500;
  
  public function applyFilter(Image $image)
  {
    return $image->fit($this->size)->orientate();
  }
}