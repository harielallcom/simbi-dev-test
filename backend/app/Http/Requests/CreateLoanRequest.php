<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CreateLoanRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "bookId" => ["uuid", "required"],       // ID do livro que está sendo emprestado
            "authorId" => ["uuid", "required"],     // ID do autor do livro
            "userId" => ["uuid", "required"],       // ID do usuário que está fazendo o empréstimo
            "loanDate" => ["date", "required"],     // Data em que o empréstimo foi feito
            "returnDate" => ["date", "required", "after_or_equal:loanDate"],  // Data de devolução prevista (deve ser igual ou posterior à data do empréstimo)
        ];
    }

    /**
     * Custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'bookId.required' => 'O campo bookId é obrigatório.',
            'authorId.required' => 'O campo authorId é obrigatório.',
            'userId.required' => 'O campo userId é obrigatório.',
            'loanDate.required' => 'O campo loanDate é obrigatório.',
            'returnDate.required' => 'O campo returnDate é obrigatório.',
            'returnDate.after_or_equal' => 'A data de devolução deve ser igual ou posterior à data de empréstimo.',
        ];
    }
}
