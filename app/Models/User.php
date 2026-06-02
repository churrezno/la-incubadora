<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
     * Attribute getter and setter to format register-form data to and from DB
     */
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strtolower($value)
        );
    }

    /**
     * Admin LTE
     */
    public function adminlte_desc()
    {
        $userRole = $this->getRoleNames()->first();
        return ucfirst($userRole);
    }


    // Relación uno a uno
    public function slate() {

        return $this->hasOne('App\Models\Slate');
    }

    // Relación uno a muchos
    public function inscripciones() {

        return $this->hasMany('App\Models\Inscripcion');
    }
    
    public function asignaciones() {

        return $this->hasMany('App\Models\Asignacion');
    }

    public function valoraciones() {

        return $this->hasManyThrough('App\Models\Valoracion', 'App\Models\Asignacion');
    }



    // Get User initials
    public function userInitials() {
        
        $username = $this->name;
        $initials = '';
        $words = array_slice(explode(" ", $username ), 0, 2);
        foreach($words as $word) {
            $initials .= $word[0];
        }
        //$initials = $words[0][0].$words[1][0];
        return strtoupper($initials);
    }
}
