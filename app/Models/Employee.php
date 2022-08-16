<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    public $timestamps = false;
    protected $fillable = ['id', 'email', 'name', 'password', 'type', 'adress', 'tel', 'born_date'];

    const _EMPLOYEE_USER = 0;
    const _ADMIN_USER = 1;
  


    /**
     * Get the company that owns the employee.
     */
    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
