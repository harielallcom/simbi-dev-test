<?php

namespace App\Core\Services\Library;

use App\Core\Common\Ports\ViewModel;
use App\Core\Domain\Library\Exceptions\AuthorNotFoundException;
use App\Core\Domain\Library\Ports\Persistence\AuthorRepository;
use App\Core\Domain\Library\Ports\UseCases\UpdateAuthor\{
    UpdateAuthorOutputPort,
    UpdateAuthorRequestModel,
    UpdateAuthorResponseModel,
    UpdateAuthorUseCase
};

final class UpdateAuthorService implements UpdateAuthorUseCase
{
    public function __construct(private UpdateAuthorOutputPort $output, private AuthorRepository $authorRepository)
    {
    }

    public function execute(UpdateAuthorRequestModel $requestModel): ViewModel
    {
        // Buscar o autor pelo ID
        $author = $this->authorRepository->findById($requestModel->getId());

        // Verificar se o autor foi encontrado
        if (!$author) {
            throw new AuthorNotFoundException();
        }

        // Atualizar os dados do autor
        $author->firstName = $requestModel->getFirstName();
        $author->lastName = $requestModel->getLastName();

        // Persistir as alterações no banco de dados (passando apenas a entidade $author)
        return $this->output->present(
            new UpdateAuthorResponseModel($this->authorRepository->update($author))
        );
    }

}
