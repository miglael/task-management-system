<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'murid_id',
        'file_path',
        'submitted_at',
        'grade',
        'feedback',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function murid()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
