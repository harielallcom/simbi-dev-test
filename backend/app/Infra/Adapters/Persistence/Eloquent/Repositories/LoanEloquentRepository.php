<?php

namespace App\Core\Infra;

use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;

class LoanEloquentRepository implements LoanRepository
{
    /**
     * Cria um novo empréstimo no banco de dados.
     *
     * @param Loan $loan
     * @return Loan
     */
    public function createLoan(Loan $loan): Loan
    {
        $eloquentLoan = EloquentLoan::create([
            'id' => $loan->getId(),
            'book_id' => $loan->getBookId(),
            'author_id' => $loan->getAuthorId(),
            'user_id' => $loan->getUserId(),
            'loan_date' => $loan->getLoanDate(),
            'return_date' => $loan->getReturnDate(),
            'status' => $loan->getStatus(),
        ]);

        return $this->toDomainEntity($eloquentLoan);
    }

    /**
     * Encontra um empréstimo pelo ID.
     *
     * @param string $loanId
     * @return Loan|null
     */
    public function findLoanById(string $loanId): ?Loan
    {
        $eloquentLoan = EloquentLoan::find($loanId);
        return $eloquentLoan ? $this->toDomainEntity($eloquentLoan) : null;
    }

    /**
     * Atualiza um empréstimo existente no banco de dados.
     *
     * @param Loan $loan
     * @return Loan
     */
    public function updateLoan(Loan $loan): Loan
    {
        $eloquentLoan = EloquentLoan::findOrFail($loan->getId());
        $eloquentLoan->update([
            'status' => $loan->getStatus(),
            'return_date' => $loan->getReturnDate(),
        ]);

        return $this->toDomainEntity($eloquentLoan);
    }

    /**
     * Verifica se um livro já está emprestado (status 'Pendente').
     *
     * @param string $bookId
     * @return bool
     */
    public function isBookLoaned(string $bookId): bool
    {
        return EloquentLoan::where('book_id', $bookId)
            ->where('status', 'Pendente')  // Verifica o status do empréstimo
            ->exists();
    }

    /**
     * Mapeia um EloquentLoan para a entidade de domínio Loan.
     *
     * @param EloquentLoan $eloquentLoan
     * @return Loan
     */
    private function toDomainEntity(EloquentLoan $eloquentLoan): Loan
    {
        return new Loan(
            $eloquentLoan->id,
            $eloquentLoan->book_id,
            $eloquentLoan->author_id,
            $eloquentLoan->user_id,
            $eloquentLoan->loan_date,
            $eloquentLoan->return_date,
            $eloquentLoan->status
        );
    }
}
