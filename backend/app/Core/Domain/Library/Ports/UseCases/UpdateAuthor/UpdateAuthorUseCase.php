<?php

namespace App\Core\Domain\Library\Ports\UseCases\UpdateAuthor;

use App\Core\Common\Ports\ViewModel;

interface UpdateAuthorUseCase
{
    public function execute(UpdateAuthorRequestModel $requestModel): ViewModel;
}
