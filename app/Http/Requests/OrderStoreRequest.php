<?php
namespace App\Http\Requests;
use App\Http\Requests\Api\FormRequest;

class OrderStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      // plate_front, plate_back and flag are mutually exclusive, value must be higher than 0
      'plate_front' => 'required_without_all:plate_back,flag',
      'plate_back' => 'required_without_all:plate_front,flag',
      'flag' => 'required_without_all:plate_front,plate_back',
      'company' => 'required',
      'name'    => 'required',
      'street'  => 'required',
      'zip'     => 'required',
      'city'    => 'required',
      'email'   => 'required|string|email',
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  public function messages()
  {
    return [
      'plate_front.required_without_all' => 'product_required',
      'plate_back.required_without_all' => 'product_required',
      'flag.required_without_all' => 'product_required',
      'flag.min' => 'product_required',
      'company.required' => 'company_required',
      'name.required' => 'name_required',
      'street.required' => 'street_required',
      'zip.required' => 'zip_required',
      'city.required' => 'city_required',
      'email.required' => 'email_required',
      'email.email' => 'email_invalid',
    ];
  }
}
