<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\{
    Model, SoftDeletes, Builder
};

class File extends Model
{
    use SoftDeletes, HasApprovals;

    const APPROVAL_PROPERTIES = [
        'title', 'overview_short', 'overview'
    ];

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
    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }

    /**
     * @param array $properties
     */
    public function createApproval(array $properties): void
    {
        $this->approvals()->create($properties);
    }

    /**
     * @param array $properties
     * @return bool
     */
    public function needsApproval(array $properties): bool
    {
        if ($this->approvalPropertiesHasDifference($properties)) {
            return true;
        }

        if ($this->detectingUploadApprovals()) {
            return true;
        }

        return false;
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
    public function isFree(): bool
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

    /**
     * @param array $properties
     * @return bool
     */
    protected function approvalPropertiesHasDifference(array $properties): bool
    {
        return array_only($this->toArray(), self::APPROVAL_PROPERTIES) != $properties;
    }

    /**
     * @return mixed
     */
    protected function detectingUploadApprovals()
    {
        return $this->uploads()->notApproved()->count();
    }
}
