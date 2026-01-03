<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\reportes\reportesRequest;
use App\Services\ReportesService;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function index(reportesRequest $request, ReportesService $service)
    {
        $fecha = Carbon::parse($request->input('fecha'));

        $data = $service->ReportesUsuarios($fecha);
        return view('reportes.reportes', compact('data'));
    }

}
