<?php

namespace App\Http\Controllers\employees;

use App\Http\Controllers\Controller;
use App\Models\Areas;
use App\Models\Employee;
use App\Models\Roles;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::join('areas', 'areas.id', '=', 'empleado.area_id')
            ->select(
                'empleado.id',
                'empleado.nombre',
                'empleado.email',
                'empleado.sexo',
                'empleado.boletin',
                'empleado.descripcion',
                'areas.nombre as nombrearea'
            )->orderBy('empleado.id', 'desc')->get();

        foreach ($employees as $employee) {
            if ($employee->boletin == 1) {
                $employee->boletin = 'Si';
            } else {
                $employee->boletin = 'No';
            }
        }

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $roles = Roles::all();
        $areas = Areas::all();

        return view('employees.create', compact('roles', 'areas'));
    }

    public function save(Request $request)
    {

        $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email',
            'gender' => 'required',
            'area' => 'required',
            'description' => 'required',
            'newsletter' => 'sometimes|accepted',
            'roles' => 'required'
        ]);

        $newsletter = $request->input('newsletter') == 'on' ? 1 : 0;

        $employee = Employee::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'sexo' => $request->gender,
            'area_id' => $request->area,
            'boletin' => $newsletter,
            'descripcion' => $request->description,
        ]);

        $roles = $request->input('roles');

        foreach ($roles as $role) {
            $employee->roles()->attach($role);
        }

        return redirect()->route('index.employee')->with('guardar', 'ok');
    }

    public function edit(Employee $data)
    {
        $roles = Roles::all();
        $areas = Areas::all();

        return view('employees.edit', compact('data', 'areas', 'roles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email',
            'gender' => 'required',
            'area' => 'required',
            'description' => 'required',
            'newsletter' => 'sometimes|accepted',
            'roles' => 'required'
        ]);

        $id = $request->route('id');
        $name = $request->input("name");
        $email = $request->input("email");
        $gender = $request->input("gender");
        $area = $request->input("area");
        $newsletter = $request->input("newsletter") == 'on' ? 1 : 0;
        $description = $request->input("description");
        $roles = $request->input("roles");

        Employee::where("id", $id)->update([
            'nombre' => $name,
            'email' => $email,
            'sexo' => $gender,
            'area_id' => $area,
            'boletin' => $newsletter,
            'descripcion' => $description,
        ]);

        $employee = Employee::find($id);
        $employee->roles()->sync($roles);

        return redirect()->route('index.employee')->with('actualizar', 'ok');
    }

    public function delete(Request $request)
    {
        $id = $request->route('id');
        $employee = Employee::find($id);
        $employee->roles()->detach();
        $employee->delete();
        return redirect()->route('index.employee')->with('eliminar', 'ok');
    }
}
