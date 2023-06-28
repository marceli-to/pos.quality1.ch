<?php
namespace App\View\Components;
use Illuminate\View\Component;

class Picture extends Component
{
  /**
   * Image
   *
   * @var object
   */
  public $image;

  /**
   * Caption
   *
   * @var string
   */
  public $caption;

  /**
   * Slug
   *
   * @var string
   */
  public $slug;

  /**
   * Width
   *
   * @var integer
   */
  public $width;

  /**
   * Height
   *
   * @var integer
   */
  public $height;

  /**
   * Lazy loading
   *
   * @var boolean
   */
  public $hasLazy;

  /**
   * Slide
   *
   * @var boolean
   */
  public $isSlide;

  /**
   * Css class
   *
   * @var string
   */
  public $cssClass;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($image = NULL, $caption = NULL, $slug = NULL, $width = NULL, $height = NULL, $hasLazy = FALSE, $isSlide = FAlSE, $cssClass = NULL)
  {
    $this->image    = $image;
    $this->caption  = $caption;
    $this->slug     = $slug;
    $this->width    = $width;
    $this->height   = $height;
    $this->hasLazy  = $hasLazy;
    $this->isSlide  = $isSlide;
    $this->cssClass = $cssClass;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('web.components.content.picture');
  }
}
