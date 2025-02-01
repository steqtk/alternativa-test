<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @OA\PathItem(
     *     path="/api/transaction"
     * )
     */
    /**
     * @OA\Post(
     *     path="/api/transaction",
     *     summary="Создание транзакции (пополнение/списание)",
     *     tags={"Транзакции"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id", "amount", "description"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="amount", type="number", format="float", example=100.50),
     *             @OA\Property(property="description", type="string", example="Пополнение баланса")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Транзакция успешно выполнена"),
     *     @OA\Response(response=400, description="Недостаточно средств")
     * )
     */
    public function store(Request $request)
    {
        $balance = Balance::where('user_id', $request->user_id)->first();
        if ($request->amount < 0 && $balance->amount + $request->amount < 0) {
            return response()->json(['error' => 'Insufficient funds'], 400);
        }
        $balance->amount += $request->amount;
        $balance->save();
        $transaction = Transaction::create($request->all());
        return response()->json($transaction, 201);
    }

    /**
     * @OA\PathItem(
     *     path="/api/transactions"
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/transactions",
     *     summary="Получение истории транзакций",
     *     tags={"Транзакции"},
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Сортировка по дате",
     *         @OA\Schema(type="string", enum={"asc", "desc"}, example="desc")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Поиск по описанию транзакции",
     *         @OA\Schema(type="string", example="Пополнение")
     *     ),
     *     @OA\Response(response=200, description="История транзакций успешно получена")
     * )
     */
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user_id)
            ->orderBy('created_at', $request->get('sort', 'desc'))
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('description', 'like', '%' . $request->search . '%');
            })
            ->get();
        return response()->json($transactions);
    }
}

