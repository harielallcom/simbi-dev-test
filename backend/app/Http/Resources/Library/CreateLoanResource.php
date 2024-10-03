<?php

namespace App\Http\Resources\Library;

use App\Core\Domain\Library\Entities\Loan;
use DateTimeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateLoanResource extends JsonResource
{
    /**
     * @param Loan $loan
     */
    public function __construct(private Loan $loan)
    {
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request = null)
    {
        return [
            'id' => $this->loan->getId(),
            'bookId' => $this->loan->getBookId(),
            'authorId' => $this->loan->getAuthorId(),
            'userId' => $this->loan->getUserId(),
            'loanDate' => $this->loan->getLoanDate()->format(DateTimeInterface::ATOM),
            'returnDate' => $this->loan->getReturnDate()->format(DateTimeInterface::ATOM),
            'status' => $this->loan->getStatus(),
            'createdAt' => $this->loan->getCreatedAt()->format(DateTimeInterface::ATOM),
            'updatedAt' => $this->loan->getUpdatedAt()->format(DateTimeInterface::ATOM),
        ];
    }
}
