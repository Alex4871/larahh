<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'doi' => ['required', 'string', 'max:100'],
            'udk' => ['required', 'string', 'max:20'],
            'edn' => ['required', 'string', 'max:6'],
            'title_ru' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'annotation_ru' => ['required', 'string'],
            'annotation_en' => ['required', 'string'],
            'f_page' => ['required', 'integer', 'min:1'],
            'l_page' => ['required', 'integer', 'gte:f_page'],
            'date' => ['required', 'date'],
            'keywords_ru' => ['required', 'string'],
            'keywords_eng' => ['required', 'string'],
            'references_ru' => ['required', 'string'],
            'references_en' => ['required', 'string'],
            'copyright_ru' => ['required', 'string', 'max:255'],
            'copyright_en' => ['required', 'string', 'max:255'],

            // Правила для массива авторов
            'authors' => ['required', 'array'],
            'authors.*.surname_ru' => ['required', 'string:100'],
            'authors.*.surname_en' => ['required', 'string:100'],
            'authors.*.initials_ru' => ['required', 'string:150'],
            'authors.*.initials_en' => ['required', 'string:150'],
            'authors.*.orcid' => ['required', 'string', 'size:19'],
            'authors.*.email' => ['required', 'email', 'max:50', 'unique:authors,email'],
            'authors.*.position_ru' => ['required', 'string', 'max:255'],
            'authors.*.position_en' => ['required', 'string', 'max:255'],
            'authors.*.job_ru' => ['required', 'string', 'max:255'],
            'authors.*.job_en' => ['required', 'string', 'max:255'],
            'authors.*.rank_ru' => ['required', 'string', 'max:255'],
            'authors.*.rank_en' => ['required', 'string', 'max:255']
        ];
    }
}
