<?php

namespace App\Exports;

use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;

// class UsersExportPDF
// {
//     /**
//     * Exporta los datos de usuarios a un archivo PDF.
//     *
//     * @return \Dompdf\Dompdf
//     */
//     public function exportPDF()
//     {
//         // Obtener datos de los usuarios
//         $users = User::all();

//         // Opciones de dompdf
//         $options = new Options();
//         $options->set('isHtml5ParserEnabled', true);

//         // Inicializar dompdf
//         $dompdf = new Dompdf($options);

//         // Renderizar el PDF
//         $dompdf->render();

//         // Devolver el objeto dompdf
//         return $dompdf;
//     }
// }
