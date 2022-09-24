<?php

namespace App\Models;

use App\Models\Employer as ModelsEmployer;
use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Apps\Models\Employer;
use Apps\Models\User;

class Shift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'user_id',
        'employer_id',
        'hours',
        'avg_hour',
        'taxable',
        'status',
        'shift_type',
        'paid_at',
    ];


    public function user()
    {
        return $this->belongsTo(ModelsUser::class);
    }

    public function employer()
    {
        return $this->belongsTo(ModelsEmployer::class);
    }
}
