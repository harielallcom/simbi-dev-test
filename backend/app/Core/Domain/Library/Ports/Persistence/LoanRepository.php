<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Loan;

interface LoanRepository
{
    /**
     * Cria um novo empréstimo no banco de dados.
     *
     * @param Loan $loan
     * @return Loan
     */
    public function createLoan(Loan $loan): Loan;

    /**
     * Encontra um empréstimo pelo ID.
     *
     * @param string $loanId
     * @return Loan|null
     */
    public function findLoanById(string $loanId): ?Loan;

    /**
     * Atualiza um empréstimo existente no banco de dados.
     *
     * @param Loan $loan
     * @return Loan
     */
    public function updateLoan(Loan $loan): Loan;

    /**
     * Verifica se um livro já está emprestado (status 'Pendente').
     *
     * @param string $bookId
     * @return bool
     */
    public function isBookLoaned(string $bookId): bool;
}
