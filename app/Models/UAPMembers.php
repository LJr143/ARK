<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UAPMembers extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'u_a_p_members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_id',
        // Personal Information
        'family_name',
        'first_name',
        'middle_name',
        'birthdate',
        'birthplace',
        'sex',
        'civil_status',
        'permanent_address',
        'telephone',
        'fax',
        'mobile',
        'facebook_id',
        'twitter_id',
        'skype_id',
        'website',
        'email',
        // Professional Information
        'company_name',
        'company_address',
        'company_telephone',
        'company_fax',
        'designation',
        'school_graduated',
        'year_graduated',
        'honors',
        'post_graduate_school',
        'post_graduate_year',
        'post_graduate_honors',
        'special_courses',
        'awards',
        // PRC Information
        'prc_registration_number',
        'prc_date_issued',
        'prc_valid_until',
        // Expertise Information
        'expertise',
        'years_of_practice',
        'practice_type',
        'services_rendered',
        // CPE/CPD Information
        'cpe_seminars_attended',
        // Membership Information
        'current_chapter',
        'previous_chapter',
        'positions_held',
        // Status
        'status',
        'remarks',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
        'prc_date_issued' => 'date',
        'prc_valid_until' => 'date',
        'year_graduated' => 'integer',
        'post_graduate_year' => 'integer',
        'years_of_practice' => 'integer',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'google_id',
    ];

    /**
     * Get the user associated with this membership.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include pending applications.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include approved members.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include rejected applications.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Get the full name of the member.
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->family_name}";
    }

    /**
     * Get the member's contact number (prefers mobile, falls back to telephone).
     */
    public function getContactNumberAttribute(): ?string
    {
        return $this->mobile ?? $this->telephone;
    }
}
