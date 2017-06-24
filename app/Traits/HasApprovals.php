<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasApprovals
{
    /**
     * @param Builder $builder
     * @return $this
     */
    public function scopeApproved(Builder $builder)
    {
        return $builder->where('approved', true);
    }

    /**
     * @param Builder $builder
     * @return $this
     */
    public function scopeNotApproved(Builder $builder)
    {
        return $builder->where('approved', false);
    }
}