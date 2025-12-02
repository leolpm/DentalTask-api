<?php

namespace App\Models\Concerns;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait BelongsToTenant
{
    public static function bootBelongsToTenant(): void
    {
        static::creating(function ($model) {
            // Se não veio tenant_id explícito, tenta pegar do usuário logado
            if (empty($model->tenant_id) && Auth::check()) {
                $model->tenant_id = data_get(Auth::user(), 'tenant_id');
            }
        });

        static::addGlobalScope('tenant', function (Builder $builder) {
            // Super admin enxerga tudo
            if (Auth::check() && Auth::user()->is_super_admin) {
                return;
            }

            if (Auth::check()) {
                $builder->where(
                    $builder->getModel()->getTable() . '.tenant_id',
                    Auth::user()->tenant_id
                );
            }
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
