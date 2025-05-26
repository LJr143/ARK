<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;

    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'google_id',
        'temp_password',
        'is_approved',
        'profile_photo_path',

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
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'google_id',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date',
            'prc_date_issued' => 'date',
            'prc_valid_until' => 'date',
            'year_graduated' => 'integer',
            'post_graduate_year' => 'integer',
            'years_of_practice' => 'integer',
        ];
    }

    public static function usernameRules(?int $ignoreId = null): array
    {
        return [
            'required',
            'string',
            'max:25',
            'min:3',
            'unique:users,username,'.$ignoreId,
            'regex:/^[a-z0-9_]+$/i',
            'not_in:admin,superuser'
        ];
    }

    public function findForPassport($username) {
        return $this->where('username', $username)->first();
    }
}
