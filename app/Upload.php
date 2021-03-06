<?php

namespace App;

use App\Traits\HasApprovals;
use Illuminate\Database\Eloquent\{
    Model, SoftDeletes
};

class Upload extends Model
{
    use SoftDeletes, HasApprovals;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
