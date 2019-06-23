<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 23.06.19
 * Time: 17:19
 */
declare(strict_types=1);


namespace App\Http\Requests\Users;


use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ];
    }
}