<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'histories';
    public $timestamps = false;
    protected $guarded = ['id', 'companies_id', 'histories_id', 'date_history'];

    /**
     * Get the employee for the history.
     */
    public function comments()
    {
        return $this->hasMany(History::class);
    }

    /**
     * Get the invitation that owns the hisory.
     */
    public function Invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    /**
     * Get the invitation that owns the employe.
     */
    public function Employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
