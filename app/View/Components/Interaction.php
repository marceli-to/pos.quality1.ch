<?php
namespace App\View\Components;
use Illuminate\View\Component;

class Interaction extends Component
{
  /**
   * Id
   *
   * @var Integer
   */
  public $id;

  /**
   * Title
   *
   * @var String
   */
  public $title;

  /**
   * Share url
   *
   * @var String
   */
  public $shareUrl;

  /**
   * Has vote
   *
   * @var Boolean
   */
  public $hasVote;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($id = NULL, $title = NULL, $shareUrl = NULL, $hasVote = NULL)
  {
    $this->id = $id;
    $this->title = $title;
    $this->shareUrl = $shareUrl;
    $this->hasVote = $hasVote;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|string
   */
  public function render()
  {
    return view('web.components.content.interaction');
  }
}
