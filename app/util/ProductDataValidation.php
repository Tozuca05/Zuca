<?php

namespace App\Utils;

use Illuminate\Support\Facades\Validator;

class ProductDataValidate
{
    public static function validate($data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
        ]);
    }
}
