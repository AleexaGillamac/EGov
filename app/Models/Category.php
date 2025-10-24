<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'label',
        'description',
        'office_id',
    ];

    /**
     * The relationship with the Complaint model.
     */

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * The relationship with the Office model.
     */

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

}
