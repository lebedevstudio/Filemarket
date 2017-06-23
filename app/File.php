<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Builder
};

class File extends Model
{
	use SoftDeletes;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            $file->identifier = uniqid(true);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvals()
    {
        return $this->hasMany(FileApproval::class);
    }

    /**
     * @return mixed
     */
    public function isLive()
    {
        return $this->live;
    }

    /**
     * @return bool
     */
    public function isFree()
    {
        return $this->price == 0;
    }

    /**
     * @param Builder $builder
     * @return $this
     */
    public function scopeFinished(Builder $builder)
    {
        return $builder->where('finished', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
    	return 'identifier';
    }
}
