<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        // NOT : Auth sistemi tamamlandığı zaman burası auth()->check() ile kontrol edilmeli.
        return true;
    }

    public function rules(): array
    {
        return [
            'client_token' => 'required|string|size:25',
            'receipt' => 'required|string|min:10|max:10',
        ];
    }
}
