<?php
namespace App\Models;

use App\Models\Applicant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'skill_name'];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
