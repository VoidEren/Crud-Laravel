<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $students = DB::select('SELECT * FROM students');

        return view('students', ['students' => $students]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
        ]);

        DB::insert('INSERT INTO students (name, grupo, created_at, updated_at) VALUES (?, ?, NOW(), NOW())', [
            $request->input('name'),
            $request->input('grupo'),
        ]);

        // Redirigir al listado con mensaje de éxito
        return redirect()->route('students.index')->with('success', 'Estudiante creado exitosamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
        ]);

        $updated = DB::update('UPDATE students SET name = ?, grupo = ?, updated_at = NOW() WHERE id = ?', [
            $request->input('name'),
            $request->input('grupo'),
            $id,
        ]);

        if ($updated) {
            // Redirigir al listado con mensaje de éxito
            return redirect()->route('students.index')->with('success', 'Estudiante actualizado exitosamente');
        } else {
            // Redirigir al listado con mensaje de error
            return redirect()->route('students.index')->with('error', 'Estudiante no encontrado');
        }
    }

    public function delete($id)
    {
        $deleted = DB::delete('DELETE FROM students WHERE id = ?', [$id]);

        if ($deleted) {
            // Redirigir al listado con mensaje de éxito
            return redirect()->route('students.index')->with('success', 'Estudiante eliminado exitosamente');
        } else {
            // Redirigir al listado con mensaje de error
            return redirect()->route('students.index')->with('error', 'Estudiante no encontrado');
        }
    }
}
