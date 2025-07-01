<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    
    public static function getNextId()
    {
        $last = self::where('id', 'not like', 'X-%')->orderByRaw('convert(conv(id, 16, 10), signed) desc')->first();
        if (!$last) {
            return '100';
        }
        $nextId = $last->id + 1;
        return $nextId;
    }

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile()
    {
    return $this->hasOne(Profile::class, 'user_id');
    }

    public function userInfo()
    {
    return $this->hasOne(UserInfo::class, 'user_id');
    }

    public function plans()
    {
        return $this->hasOne(UserPlan::class);
    }

    public function UserPlan()
    {
        return $this->hasMany(UserPlan::class, 'user_id');
    }

    public function match()
    {
        return $this->hasOne(MatchProfile::class);
    }

    public function partnerProfile(){
        return $this->hasOne(PartnerProfile::class, 'user_id');
    }

    public function access(){
        return $this->hasOne(AdminAccess::class, 'user_id');
    }


    public function hasActivePurchasePlan()
    {

        return $this->hasMany(UserPlan::class)->where('end_date', '>', now())->exists();
      
    }
}
