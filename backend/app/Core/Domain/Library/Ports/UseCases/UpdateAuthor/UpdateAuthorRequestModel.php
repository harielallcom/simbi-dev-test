<?php

namespace App\Core\Domain\Library\Ports\UseCases\UpdateAuthor;

final class UpdateAuthorRequestModel
{
    /**
     * @param string $id
     * @param array $attributes
     */
    public function __construct(private string $id, private array $attributes = [])
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): string|null
    {
        return $this->attributes['firstName'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getLastName(): string|null
    {
        return $this->attributes['lastName'] ?? null;
    }
}
