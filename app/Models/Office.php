<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'email',
        'phone',
    ];

    /**
     * The relationship with the Complaint model.
     *
     */

    public function complaint()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * The relationship with the Complaint model.
     *
     */

    public function employees()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the director for the Office
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function director(): HasOne
    {
        return $this->hasOne(User::class);
    }

}
