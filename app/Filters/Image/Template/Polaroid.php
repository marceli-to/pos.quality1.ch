<?php
namespace App\Filters\Image\Template;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class Polaroid implements FilterInterface
{
  protected $size = 640;
  
  public function applyFilter(Image $image)
  {
    return $image->fit($this->size)->orientate();
  }
}