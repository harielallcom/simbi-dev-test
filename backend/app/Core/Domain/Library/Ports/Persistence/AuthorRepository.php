<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Author;

interface AuthorRepository
{
    /**
     * Cria um novo autor no sistema.
     *
     * @param Author $author
     * @return Author
     */
    public function create(Author $author): Author;

    /**
     * Busca um autor pelo ID.
     *
     * @param string $id
     * @return Author|null
     */
    public function findById(string $id): ?Author;

    /**
     * Atualiza um autor existente.
     *
     * @param Author $author
     * @return Author
     */
    public function update(Author $author): Author;


}
