<?php

namespace App\Http\Controllers;

use App\Database\Eloquent\UserEloquent;
use App\Exports\UsersExport;
use App\Exports\UsersExportPDF;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;


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

    /**
    * Export users data to PDF.
    */
    public function exportPDF()
    {
        $users = User::all();
        $header = $this->generateHeader(); // Obtener el HTML del encabezado

        // Construir la tabla HTML para mostrar los usuarios
        $table = '<table border="1" style="border-collapse: collapse; width: 100%;">';
        $table .=    
        '<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de Creación</th>
        </tr>';

        foreach ($users as $user) {
            $table .= '<tr>';
            $table .= '<td>' . $user->id . '</td>';
            $table .= '<td>' . $user->name . '</td>';
            $table .= '<td>' . $user->email . '</td>';
            $table .= '<td>' . $user->created_at->format('Y-m-d H:i:s') . '</td>';
            $table .= '</tr>';
        }
        $table .= '</table>';

        // Combinar el encabezado, la tabla y el contenido del PDF
        $pdfContent = $header . '<h1>Usuarios</h1>' . $table;

        // Generar el PDF y devolverlo
        $pdf = PDF::loadHTML($pdfContent);
        return $pdf->stream('documento.pdf');
    }

   

    private function generateHeader()
    {
        $header = '<div style="text-align: center; padding: 20px; background-color: #FC5F1A">';
        $header .= '<h1>USUARIOS</h1>';
        $header .= '<img src="' . public_path('images/pngwing.png') . '" alt="Logo" style="max-width: 200px; margin-top: 10px;">';
        $header .= '</div>';

        return $header;
    }

    
}
