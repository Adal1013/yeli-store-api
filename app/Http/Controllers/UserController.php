<?php

namespace App\Http\Controllers;

use App\Database\Eloquent\UserEloquent;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Exports\UsersExport;
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
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, StoreUserRequest $request)
    {
        $user->fill($request->all())->save();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
       
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function usersPdf(User $user)
    {
        FacadePdf::setPaper('A4');
        $users = User::all();
        $pdf = FacadePdf::loadView('pdf.users', compact('users'));
        return $pdf->stream('users.pdf');
    }
}
