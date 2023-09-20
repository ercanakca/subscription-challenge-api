<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Note: Doğrulama kuralları projenin gereksinimlerine göre ileride güncellenmeli. Geçici olarak hepsini required yaptım.

        return [
            'device_uid' => 'required|string|min:10|max:10',
            'app_id' => 'required|string|min:10|max:10',
            'language' => 'required|string|min:5|max:5',
            'os' => 'required|string|min:3|max:7',
        ];
    }
}
