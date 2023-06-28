<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  /**
   * Constructor
   * 
   */

  public function __construct()
  {

  }

  public function checkLocaleAndRedirect()
  {
    $browser_locale  = substr(\Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
    $route_locale    = locale();
    $allowed_locales = \Config::get('locales.supported');

    if (in_array($browser_locale, $allowed_locales))
    {
      if ($browser_locale != $route_locale)
      {
        if (session('has_locale_redirect'))
        {
          session('has_locale_redirect', TRUE);
          return redirect()->route('de.page.listing');
        }
      }
    }
  }
}
