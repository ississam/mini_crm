<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    public $timestamps = false;
    protected $guarded = ['id', 'company_name'];

    /**
     * Get the employee for the companyt.
     */
    public function comments()
    {
        return $this->hasMany(Employee::class);
    }
}
