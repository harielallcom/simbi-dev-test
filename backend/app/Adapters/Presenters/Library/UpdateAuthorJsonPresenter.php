<?php

namespace App\Adapters\Presenters\Library;

use App\Adapters\ViewModel\JsonResourceViewModel;
use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Ports\UseCases\UpdateAuthor\{UpdateAuthorOutputPort, UpdateAuthorResponseModel};
use App\Http\Resources\Library\UpdateAuthorResource;

final class UpdateAuthorJsonPresenter implements UpdateAuthorOutputPort
{
    /**
     * @param UpdateAuthorResponseModel $responseModel
     *
     * @return ViewModel
     */
    public function present(UpdateAuthorResponseModel $responseModel): ViewModel
    {
        return new JsonResourceViewModel(new UpdateAuthorResource($responseModel->getAuthor()));
    }
}
