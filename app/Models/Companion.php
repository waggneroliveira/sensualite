<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Companion extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable, HasFactory, LogsActivity;
    
    protected $fillable = [
        'slug',
        'name',
        'mention',
        'email',
        'password',
        'description',
        'active',
        'phone',
        'go_out_with', 
        'age', 
        'type', 
        'gender', 
        'body_type', 
        'height', 
        'weight',
        'shoe_size', 
        'eye_color', 
        'availability', 
        'meeting_places', 
        'rate', 
        'payment_methods', 
        'available_for_travel',
        'path_file_profile',
        'path_file_horizontal_cover',
        'path_file_vertical_cover',
        'top_love',        
        'city',        
        'state',    
        'companion_status_verification',  
        'is_courtesy',  
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    public function feedback(){
        return $this->hasMany(FeedbackClient::class);
    }
    public function subscribeds(){
        return $this->hasMany(Subscribed::class);
    }
    public function liked()
    {
        return $this->hasMany(Liked::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(CompanionCategory::class, 'companion_category_has_companions', 'companion_id', 'companion_category_id');
    }

    public function hasActiveSubscription()
    {
        return $this->subscribeds?->contains('status', 'paid');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
    public function post()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }
    public function announcetement()
    {
        return $this->hasMany(Announcement::class);
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopesorting(){
        return $this->orderBy('name', 'ASC');
    }
    public function getActivitylogOptions(): LogOptions
    {
        $activityLogService = new ActivityLogService($this);
        
        return LogOptions::defaults()
            ->logOnly($activityLogService->getLoggableAttributes());
    }
}
