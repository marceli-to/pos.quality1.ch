<?php
namespace App\Http\Requests;
use App\Http\Requests\Api\FormRequest;

class PostStoreRequest extends FormRequest
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
      'company' => 'required',
      'name'    => 'required',
      'email'   => 'required|string|email|unique:posts',
      'image'   => 'required',
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
      'company.required' => 'company_required',
      'name.required' => 'name_required',
      'email.required' => 'email_required',
      'email.email' => 'email_invalid',
      'email.unique' => 'email_in_use',
      'image.required' => 'image_required',
    ];
  }
}
