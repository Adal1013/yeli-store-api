<?php

namespace App\Http\Controllers;

use App\Database\Eloquent\UserEloquent;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Exports\Excel\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserEloquent::getDataModel();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreUserRequest $request
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     * @param User $user
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param User $user
     * @param StoreUserRequest $request
     */
    public function update(User $user, StoreUserRequest $request)
    {
        $user->fill($request->all())->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     */
    public function destroy(User $user)
    {
        $user->delete();
       
        return new UserResource($user);
    }

    /**
     * Función exportar Excel.
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * Funcion expoertar PDF.
     * @param User $user
     */
    public function usersPdf(User $user)
    {
        $users = User::all();
        $pdf = FacadePdf::loadView('pdf.users', compact('users'))->setPaper('A3');

        return $pdf->stream('users.pdf');
    }
}
