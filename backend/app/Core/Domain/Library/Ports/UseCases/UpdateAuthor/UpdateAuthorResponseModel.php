<?php

namespace App\Core\Domain\Library\Ports\UseCases\UpdateAuthor;

use App\Core\Domain\Library\Entities\Author;

final class UpdateAuthorResponseModel
{
    /**
     * @param Author $author
     */
    public function __construct(private Author $author)
    {
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }
}
