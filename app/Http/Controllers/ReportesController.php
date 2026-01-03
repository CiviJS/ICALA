<?php

namespace App\Http\Controllers;
use App\Http\Requests\reportes\ReportesRequest;
use App\Services\ReportesService;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function index(ReportesRequest $request, ReportesService $service)
    {
        $fecha = Carbon::parse($request->input('fecha'));

        $data = $service->reportesUsuarios($fecha);
        return view('reportes.reportes', compact('data'));
    }

}
