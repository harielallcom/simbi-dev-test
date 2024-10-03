<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Author;
use App\Core\Domain\Library\Ports\Persistence\AuthorRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\AuthorMapper;
use App\Infra\Adapters\Persistence\Eloquent\Models\Author as EloquentAuthor;

final class AuthorEloquentRepository implements AuthorRepository
{
    /**
     * Cria um novo autor no banco de dados.
     *
     * @param Author $author
     * @return Author
     */
    public function create(Author $author): Author
    {
        $eloquentAuthor = AuthorMapper::toEloquentModel($author);
        $eloquentAuthor->save();

        return AuthorMapper::toDomainEntity($eloquentAuthor);
    }

    /**
     * Atualiza um autor existente no banco de dados.
     *
     * @param Author $author
     * @return Author
     */
    public function update(Author $author): Author
    {
        // Encontrar o autor no Eloquent
        $eloquentAuthor = EloquentAuthor::find($author->getId());

        if (!$eloquentAuthor) {
            throw new \Exception('Autor não encontrado.');
        }

        // Atualizar os dados do autor
        $eloquentAuthor->first_name = $author->getFirstName();
        $eloquentAuthor->last_name = $author->getLastName();

        // Salvar no banco de dados
        $eloquentAuthor->save();

        return AuthorMapper::toDomainEntity($eloquentAuthor);
    }

    /**
     * Busca um autor pelo ID.
     *
     * @param string $id
     * @return Author|null
     */
    public function findById(string $id): ?Author
    {
        // Buscar o autor no banco de dados usando Eloquent
        $eloquentAuthor = EloquentAuthor::find($id);

        if (!$eloquentAuthor) {
            return null;
        }

        return AuthorMapper::toDomainEntity($eloquentAuthor);
    }
}
