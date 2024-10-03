<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\InvalidLoanDataException;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{
    CreateLoanOutputPort,
    CreateLoanRequestModel,
    CreateLoanResponseModel,
    CreateLoanUseCase
};

final class CreateLoanService implements CreateLoanUseCase
{
    /**
     * @param CreateLoanOutputPort $output
     * @param LoanRepository $loanRepository
     */
    public function __construct(
        private CreateLoanOutputPort $output,
        private LoanRepository $loanRepository
    ) {
    }

    /**
     * @param CreateLoanRequestModel $requestModel
     *
     * @return ViewModel
     */
    public function execute(CreateLoanRequestModel $requestModel): ViewModel
    {
        // Validar a requisição
        $this->validate($requestModel);

        // Criar a entidade Loan
        $loan = new Loan(
            $requestModel->getBookId(),
            $requestModel->getAuthorId(),
            $requestModel->getUserId(),
            $requestModel->getLoanDate(),
            $requestModel->getReturnDate(),
            'Pendente'  // O status inicial do empréstimo é "Pendente"
        );

        // Persistir o empréstimo no repositório
        $loan = $this->loanRepository->create($loan);

        // Retornar a resposta via output port
        return $this->output->present(new CreateLoanResponseModel($loan));
    }

    /**
     * Valida o requestModel para garantir que os dados de empréstimo estão corretos.
     *
     * @param CreateLoanRequestModel $requestModel
     *
     * @throws InvalidLoanDataException
     *
     * @return void
     */
    private function validate(CreateLoanRequestModel $requestModel): void
    {
        if (empty($requestModel->getBookId())) {
            throw new InvalidLoanDataException("O campo bookId é obrigatório.");
        }

        if (empty($requestModel->getAuthorId())) {
            throw new InvalidLoanDataException("O campo authorId é obrigatório.");
        }

        if (empty($requestModel->getUserId())) {
            throw new InvalidLoanDataException("O campo userId é obrigatório.");
        }

        if (empty($requestModel->getLoanDate())) {
            throw new InvalidLoanDataException("O campo loanDate é obrigatório.");
        }

        if (empty($requestModel->getReturnDate())) {
            throw new InvalidLoanDataException("O campo returnDate é obrigatório.");
        }

        // Verificação adicional: a data de devolução deve ser posterior ou igual à data de empréstimo
        if (strtotime($requestModel->getReturnDate()) < strtotime($requestModel->getLoanDate())) {
            throw new InvalidLoanDataException("A data de devolução não pode ser anterior à data de empréstimo.");
        }
    }
}
