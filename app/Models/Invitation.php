<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invitation extends Model
{
    use HasFactory;
    protected $table = 'invitations';
    public $timestamps = false;
    protected $fillable = ['id', 'employees_id', 'status'];

    const _SENT_INVITATION = 0;
    const _VALIDATED_INVITATION = 1;
    const _CANCELED_INVITATION = 2;
    const _CONFIRMED_PROFILE = 13;

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
