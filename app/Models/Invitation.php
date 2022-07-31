<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invitation extends Model
{
    use HasFactory;
    protected $table = 'invitations';
    public $timestamps = false;
    protected $guarded = ['id', 'employees_id', 'status'];

    /**
     * Get the invitaion associated with the employee.
     */
    public function Invitation()
    {
        return $this->hasOne(Employee::class);
    }

    /**
     * Get the history for the invitation.
     */
    public function comments()
    {
        return $this->hasMany(History::class);
    }

    
}
