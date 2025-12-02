<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $document
 * @property string $subdomain
 * @property string|null $whatsapp_number
 * @property string $status
 * @property string $email
 * @property string|null $logo_path
 * @property string|null $phone
 * @property bool $is_completed
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip_code
 * @property string $plan
 */
class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'subdomain',
        'whatsapp_number',
        'status',
        'email',
        'logo_path',
        'phone',
        'is_completed',
        'address',
        'city',
        'state',
        'zip_code',
        'plan',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    public function dentists(): HasMany
    {
        return $this->hasMany(Dentist::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
