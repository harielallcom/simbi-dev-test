<?php

namespace App\Core\Domain\Library\Ports\UseCases\UpdateAuthor;

use App\Core\Common\Ports\ViewModel;

interface UpdateAuthorOutputPort
{
    /**
     * @param UpdateAuthorResponseModel $responseModel
     * @return ViewModel
     */
    public function present(UpdateAuthorResponseModel $responseModel): ViewModel;
}
