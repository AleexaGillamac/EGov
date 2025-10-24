<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'complaint_id',
        'file_path',
        'file_type',
    ];

    /**
     * The relationship with the Complaint model.
     *
     */

    public function complaints()
    {
        return $this->belongsToMany(Complaint::class);
    }
}
