<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
      'hash' => 'required',
      'uuid' => 'required|exists:posts,uuid'
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
      'hash.required' => 'Voter wird benötigt!',
      'uuid.required' => 'Post wird benötigt!',
      'uuid.exists'   => 'Gültiger Post wird benötigt!',
    ];
  }
}
