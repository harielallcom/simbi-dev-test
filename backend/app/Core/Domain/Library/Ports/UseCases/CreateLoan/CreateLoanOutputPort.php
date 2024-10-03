<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

use App\Core\Common\Ports\ViewModel;

interface CreateLoanOutputPort
{
    /**
     * @return ViewModel
     */
    public function present(CreateLoanResponseModel $responseModel): ViewModel;
}
