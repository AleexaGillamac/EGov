<?php

namespace App\Models;

use App\Models\User;
use App\Models\Office;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'office_id',
        'complaint_id',
        'employee_id',
        'subject',
        'description',
    ];


    /**
     * Get the complaint that owns the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    /**
     * Get the employee that owns the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the office that owns the Feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'employee_id');
    }
}
