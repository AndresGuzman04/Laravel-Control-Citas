<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;
use App\Models\Cita;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class citaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $citas = Cita::with('paciente')->latest()->get();

    $citas_json = $citas->map(function ($cita) {
        return [
            'id' => $cita->id,
            'paciente_id' => $cita->paciente ? $cita->paciente->id : null,
            'paciente' => $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido ?? 'Paciente no encontrado',
            'empleado_id' => $cita->user_id ?? 1,
            'motivo' => $cita->motivo,
            'estado' => $cita->estado,
            'year' => $cita->fecha_hora->year,
            'month' => $cita->fecha_hora->month,
            'day' => $cita->fecha_hora->day,
            'hour' => $cita->fecha_hora->format('H:i'),
        ];
    });


        return view('cita.index', compact('citas_json'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $citas = Cita::with('paciente')->latest()->get();

        $citas_json = $citas->map(function ($cita) {
            return [
                'id' => $cita->id,
                'year' => $cita->fecha_hora->year,
                'month' => $cita->fecha_hora->month,
                'day' => $cita->fecha_hora->day,
                'hour' => $cita->fecha_hora->format('H:i'),
            ];
        });

        $pacientes = Paciente::all();

        return view('cita.create', compact('citas_json', 'pacientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitaRequest $request)
    {
        try {
        
            DB::beginTransaction();
            $data = $request->validated();

            $cita = Cita::create($data);

            DB::commit();

            return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente');
            


        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear la cita: ' . $e->getMessage())->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //
        $pacientes = Paciente::all();
        return view('cita.edit', compact('cita', 'pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitaRequest $request, Cita $cita)
    {
        //
       
        
            DB::beginTransaction();
            $data = $request->validated();

            $cita->update($data);

            DB::commit();

            return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
        //
        try {
            $cita->delete();
            return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la cita: ' . $e->getMessage());
        }

    }
}
