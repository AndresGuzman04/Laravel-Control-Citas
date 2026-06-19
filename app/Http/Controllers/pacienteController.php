<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Models\Paciente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $pacientes = Paciente::latest()->get();
        //dd($pacientes);

        return view('paciente.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePacienteRequest $request, Paciente $paciente)
    {
        //dd($request->all());
        try {
            DB::beginTransaction();

            //obtener los datos validados
            $validatedData = $request->validated();

            //creae el paciente
            $paciente = Paciente::create($validatedData);
            //dd($paciente);
            DB::commit();
            return redirect()->route('pacientes.index')->with('success', 'Paciente creado exitosamente');

        } catch (Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error al crear el paciente: ' . $e->getMessage());
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
    public function edit(Paciente $paciente)
    {
        //
        return view('paciente.edit', ['paciente' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
        Paciente::where('id', $paciente->id)->update($request->validated());
        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        //
        if ($paciente->estado == 1) {
            $paciente->update(['estado' => 0]);
            return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado exitosamente');
        } else {
            $paciente->update(['estado' => 1]);
            return redirect()->route('pacientes.index')->with('success', 'Paciente activado exitosamente');
        }
    }
}
