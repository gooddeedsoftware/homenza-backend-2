<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'enquiries';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const ENQUIRY_TYPE_SELECT = [
        '1' => 'Schedule a visit',
        '2' => 'Request a Callback',
    ];

    protected $fillable = [
        'name',
        'mobile',
        'enquiry_type',
        'whatsapp_update',
        'privacy',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
