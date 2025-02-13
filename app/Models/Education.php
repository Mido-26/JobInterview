<?php

namespace App\Models;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'institution_name', 'degree', 'year'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

