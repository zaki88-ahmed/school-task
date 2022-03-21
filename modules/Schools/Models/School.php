<?php

namespace modules\Schools\Models;

use App\Events\RegisterEventMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use modules\Products\Models\Product;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use modules\Students\Models\Student;
use Spatie\Permission\Traits\HasRoles;


class School extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;


    protected $fillable = ['name', 'status', 'order'];
    protected $guard_name = 'student';
    protected $hidden = ['id', 'password', 'email_verified_at', 'remember_token', 'deleted_at', 'created_at', 'updated_at', 'Oauth_token', 'fcm_token', 'roles'];

    public function students()
    {
        return $this->hasMany(Student::class, 'school_id', 'id');
    }


}
