<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Sort;
use App\Http\Requests\CardsRequest;
use App\Services\CardService;
use Illuminate\Http\JsonResponse;
use JsonException;

class CardsController extends Controller
{
    /**
     * @throws JsonException
     */
    public function index(CardsRequest $request, CardService $service): JsonResponse
    {
        /** @var null|Sort $sort */
        $sort = null;
        if ($request->has('sort') && $request->filled('sort')) {
            $sort = Sort::from((int)$request->get('sort'));
        }

        $data = $service->fetch();

        if ($sort) {
            $data = $service->sort($data, $sort);
        }

        return response()->json($data);
    }

    public function store(CardsRequest $request): JsonResponse
    {
        $data = $request->getPayload();

        return response()->json($data->all());
    }
}
