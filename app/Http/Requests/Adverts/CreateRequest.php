<?php

declare(strict_types=1);


namespace App\Http\Requests\Adverts;


use App\Entity\Adverts\Category;
use App\Entity\Region;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateRequest
 * @package App\Http\Requests\Adverts
 * @property Category $category
 * @property Region $region
 *
 */
class CreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $items = [];

        foreach ($this->category->allAttributes() as $attribute) {
            $rules = [
                $attribute->required ? 'required' : 'nullable',
            ];
            if ($attribute->isInteger()) {
                $rules[] = 'integer';
            } elseif ($attribute->isFloat()) {
                $rules[] = 'numeric';
            } else {
                $rules[] = 'string';
                $rules[] = 'max:255';
            }
            $items['attribute.' . $attribute->id] = $rules;
        }

        return array_merge([
            'title' => 'required|string',
            'content' => 'required|string',
            'price' => 'required|integer',
            'address' => 'required|string',
        ], $items);
    }
}
