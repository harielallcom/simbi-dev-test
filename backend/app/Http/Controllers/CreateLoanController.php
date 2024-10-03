<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\CreateLoan\{CreateLoanRequestModel, CreateLoanUseCase};
use App\Http\Requests\CreateLoanRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateLoanController extends Controller
{
    /**
     * @param CreateLoanUseCase $useCase
     */
    public function __construct(private CreateLoanUseCase  $useCase)
    {
    }

    /**
     * Permite adicionar um novo empréstimo de livro
     *
     * @OA\Post(
     *    path="/api/loans",
     *    summary="Adiciona um novo empréstimo de livro na API",
     *    tags={"Loans"},
     *
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        required={"bookId", "authorId", "userId", "loanDate", "returnDate"},
     *        @OA\Property(property="bookId", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *        @OA\Property(property="authorId", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *        @OA\Property(property="userId", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *        @OA\Property(property="loanDate", type="string", format="date", example="2024-10-01"),
     *        @OA\Property(property="returnDate", type="string", format="date", example="2024-10-15"),
     *      )
     *    ),
     *
     *    @OA\Response(
     *      response=201,
     *      description="Loan Created",
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(
     *          property="id",
     *          type="string",
     *          example="d4e3fa67-5c7b-41f5-a9c2-bd8b26df62b1",
     *        ),
     *        @OA\Property(
     *          property="bookId",
     *          type="string",
     *          example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *        ),
     *        @OA\Property(
     *          property="authorId",
     *          type="string",
     *          example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *        ),
     *        @OA\Property(
     *          property="userId",
     *          type="string",
     *          example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344",
     *        ),
     *        @OA\Property(
     *          property="loanDate",
     *          type="string",
     *          format="date",
     *          example="2024-10-01",
     *        ),
     *        @OA\Property(
     *          property="returnDate",
     *          type="string",
     *          format="date",
     *          example="2024-10-15",
     *        ),
     *        @OA\Property(
     *          property="status",
     *          type="string",
     *          example="Pendente",
     *        ),
     *      )
     *    ),
     *
     *    @OA\Response(response="400", description="Requisição com erro",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Bad Request")
     *      )
     *    ),
     *    @OA\Response(response="401", description="Proibido",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Forbidden Error")
     *      )
     *    ),
     *    @OA\Response(response="403", description="Não autorizado",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Unauthorized Error")
     *      )
     *    ),
     *    @OA\Response(response="500", description="Erro interno",
     *      @OA\MediaType(
     *       mediaType="application/json",
     *          @OA\Schema(ref="#/components/schemas/Internal server error")
     *      )
     *    ),
     *
     * ),
     *
     * @param  CreateLoanRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateLoanRequest $request)
    {
        $viewModel = $this->useCase->execute(new CreateLoanRequestModel($request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_CREATED);
    }

}
