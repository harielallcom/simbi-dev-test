<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models\Mappers;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;

final class LoanMapper
{
    /**
     * Converte a entidade de domínio Loan para o modelo Eloquent Loan.
     *
     * @param DomainLoan $loan
     * @return EloquentLoan
     */
    public static function toEloquentModel(DomainLoan $loan): EloquentLoan
    {
        return new EloquentLoan([
            'id' => $loan->getId(),
            'book_id' => $loan->getBookId(),
            'author_id' => $loan->getAuthorId(),
            'user_id' => $loan->getUserId(),
            'loan_date' => $loan->getLoanDate(),
            'return_date' => $loan->getReturnDate(),
            'status' => $loan->getStatus(),
        ]);
    }

    /**
     * Converte o modelo Eloquent Loan para a entidade de domínio Loan.
     *
     * @param EloquentLoan $eloquentLoan
     * @return DomainLoan
     */
    public static function toDomainEntity(EloquentLoan $eloquentLoan): DomainLoan
    {
        return new DomainLoan(
            id: $eloquentLoan->id,
            bookId: $eloquentLoan->book_id,
            authorId: $eloquentLoan->author_id,
            userId: $eloquentLoan->user_id,
            loanDate: $eloquentLoan->loan_date,
            returnDate: $eloquentLoan->return_date,
            status: $eloquentLoan->status,
            createdAt: $eloquentLoan->created_at,
            updatedAt: $eloquentLoan->updated_at,
        );
    }
}
