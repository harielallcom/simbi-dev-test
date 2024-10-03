<?php

namespace App\Http\Controllers;

use App\Core\Domain\Library\Ports\UseCases\UpdateAuthor\{UpdateAuthorRequestModel, UpdateAuthorUseCase};
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateAuthorController extends Controller
{
    /**
     * @param UpdateAuthorUseCase $useCase
     */
    public function __construct(private UpdateAuthorUseCase $useCase)
    {
    }

    /**
     * Permite editar um autor existente
     *
     * @OA\Put(
     *    path="/api/authors/{id}",
     *    summary="Edita um autor na API",
     *    tags={"Authors"},
     *    @OA\Parameter(
     *      name="id",
     *      in="path",
     *      description="ID do autor a ser editado",
     *      required=true,
     *      @OA\Schema(type="string")
     *    ),
     *    @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(
     *        type="object",
     *        required={"name"},
     *        @OA\Property(property="name", type="string"),
     *      )
     *    ),
     *    @OA\Response(
     *      response=200,
     *      description="Author Updated",
     *      @OA\JsonContent(
     *        type="object",
     *        @OA\Property(property="id", type="string", example="13b35be6-65a7-4d7f-9ad2-8caaf3c75344"),
     *        @OA\Property(property="name", type="string", example="Novo Nome do Autor"),
     *        @OA\Property(property="updatedAt", type="string", example="2022-12-14T22:24:26+00:00"),
     *      )
     *    ),
     *    @OA\Response(response="400", description="Requisição com erro"),
     *    @OA\Response(response="404", description="Autor não encontrado"),
     *    @OA\Response(response="500", description="Erro interno")
     * )
     *
     * @param UpdateAuthorRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function __invoke(UpdateAuthorRequest $request, string $id)
    {
        $viewModel = $this->useCase->execute(new UpdateAuthorRequestModel($id, $request->validated()));
        return response()->json($viewModel->getResponse(), Response::HTTP_OK);
    }
}
