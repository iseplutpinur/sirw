<?php

namespace App\Models;

use App\Models\Address\District;
use App\Models\Address\Province;
use App\Models\Address\Regencie;
use App\Models\Address\Village;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    // role
    const ROLE_ADMIN = 'admin';
    const ROLE_MEMBER = 'member';

    const ROLE_ADMINISTRATOR = 'administrator';
    const ROLE_RT = 'rt';
    const ROLE_RW = 'rw';
    const ROLE_PKK = 'pkk';
    const ROLE_POSYANDU = 'posyandu';
    const ROLE_POSKB = 'poskb';

    const tableName = 'users';
    const image_default = 'assets/image/anggota_default.png';
    const image_folder = '/assets/pengurus/profile';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
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
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function getAllRole(): array
    {
        return [
            // self::ROLE_MEMBER,
            // self::ROLE_ADMIN,
            self::ROLE_ADMINISTRATOR,
            // self::ROLE_RT,
            // self::ROLE_RW,
            // self::ROLE_PKK,
            // self::ROLE_POSYANDU,
            // self::ROLE_POSKB,
        ];
    }

    public function fotoUrl()
    {
        $foto = $this->attributes['foto'];
        return $foto ? url(self::image_folder . '/' . $foto) : asset('assets/image/anggota_default.png');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function regencie()
    {
        return $this->belongsTo(Regencie::class, 'regency_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
