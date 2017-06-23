<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, SoftDeletes
};

class FileApproval extends Model
{
	use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'file_approvals';

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

        static::creating(function ($approval) {
            $approval->file->approvals->each->delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
