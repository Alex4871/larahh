<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJournalRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title_ru' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'issn' => ['required', 'string', 'size:9'],
            'eissn' => ['string', 'size:9'],
            'volume' => ['integer', 'min:0'],
            'issue' => ['integer', 'min:0'],
            'date' => ['date'],
            'publisher' => ['string', 'max:255']
        ];
    }
}
