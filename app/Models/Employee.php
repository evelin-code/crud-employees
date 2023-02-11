<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "empleado";
    protected $fillable = [
        'nombre',
        'email',
        'sexo',
        'area_id',
        'boletin',
        'descripcion',
    ];
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'empleado_rol', 'empleado_id', 'rol_id');
    }
}
