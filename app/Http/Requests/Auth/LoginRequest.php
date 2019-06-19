<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 19.06.19
 * Time: 20:13
 */
declare(strict_types=1);


namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Auth
 */
class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }
}