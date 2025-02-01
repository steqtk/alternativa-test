<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\PathItem(
     *     path="/api/register"
     * )
     */
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Регистрация нового пользователя",
     *     tags={"Пользователь"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email", "password"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="securepassword123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Пользователь успешно зарегистрирован"),
     *     @OA\Response(response=400, description="Ошибка валидации")
     * )
     */
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Balance::create(['user_id' => $user->id, 'amount' => 0]);
        return response()->json($user, 201);
    }

    /**
     * @OA\PathItem(
     *     path="/api/user/{id}"
     * )
     */
    /**
     * @OA\Get(
     *     path="/api/user/{id}",
     *     summary="Получение информации о пользователе",
     *     tags={"Пользователь"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Информация о пользователе успешно получена"),
     *     @OA\Response(response=404, description="Пользователь не найден")
     * )
     */
    public function show($id)
    {
        return response()->json(User::with('balance')->findOrFail($id));
    }
}
