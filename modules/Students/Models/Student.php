<?php

namespace modules\Students\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use modules\Schools\Models\School;
use Spatie\Permission\Traits\HasRoles;


class Student extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;


    protected $fillable = ['id', 'name', 'status', 'order', 'school_id'];
    protected $guard_name = 'student';
    protected $hidden = ['deleted_at', 'created_at', 'updated_at', 'roles'];

    public function schools()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }


}
