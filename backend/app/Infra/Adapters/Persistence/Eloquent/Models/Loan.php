<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models;

use Database\Factories\LoanFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Loan extends Model
{
    use HasFactory;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loans';

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'book_id', 'author_id', 'user_id', 'loan_date', 'return_date', 'status'];

    /**
     * Define a relação com o modelo `Book`.
     *
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Define a relação com o modelo `Author`.
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Define a relação com o modelo `User`.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retorna uma nova instância de `LoanFactory` para gerar dados fictícios.
     *
     * @return Factory
     */
    protected static function newFactory(): Factory
    {
        return LoanFactory::new();
    }
}
