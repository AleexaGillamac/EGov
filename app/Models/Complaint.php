<?php
namespace App\Models;

use App\ComplaintStatus;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $fillable = [
        'office_id',
        'category_id',
        'subject',
        'description',
        'anonymous',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var bool
     */

    protected $casts = [
        'anonymous' => 'boolean',
        'status'    => ComplaintStatus::class,
    ];

    /**
     * The relationship with the Attachment model.
     */

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * The relationship with the Category model.
     */
    public function category()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Get all of the feedbacks for the Complaint
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * The relationship with the Office model.
     */

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * The relationship with the User model.
     */

    public function citizen()
    {
        return $this->belongsTo(User::class);
    }
}
