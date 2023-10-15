<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = Auth::user();

        if ($user->email === "ludovico.pellecchia@gmail.com") {
            return true;
        }


        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "titolo"=>"required",
            "descrizione"=>"required",
            "link_github"=>"nullable",
            "immagine"=>"nullable",
            "type_id"=>"nullable",
            "technologies"=>"nullable"   
            //
        ];
    }
}
