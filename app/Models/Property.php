<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'properties';

    protected $appends = [
        'photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        '1' => 'Active',
        '2' => 'In-Active',
    ];

    public const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
        'Unisex' => 'Unisex',
    ];

    protected $fillable = [
        'name',
        'address',
        'landmark',
        'country',
        'state',
        'city',
        'pincode',
        'description',
        'property_type_id',
        'gender',
        'amount',
        'payment_remark',
        'latitude',
        'longitude',
        'status',
        'youtube_link',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function property_type()
    {
        return $this->belongsTo(PropertType::class, 'property_type_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }
}
