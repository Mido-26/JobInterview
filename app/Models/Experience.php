<?php

namespace App\Models;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'company_name', 'role', 'duration'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
