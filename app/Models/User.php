<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'login',
//        'password',
//    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Boots the model after it has been instantiated.
     *
     * This method is called after the model has been instantiated but before its
     * connections are initialized.
     *
     * @return void
     */
    protected static function booted(): void
    {
        parent::boot();
        // Generate a unique ID for each new user when creating a new model.
        static::creating(function ($utilisateur) {
            $utilisateur->id = (string)Str::uuid();
        });
    }

    public function personnelAdministratifs(): HasOne
    {
        return $this->hasOne(PersonnelAdministratif::class);
    }

    public function professeurs(): HasMany
    {
        return $this->hasMany(Professeur::class);
    }

    public function etudiants(): HasMany
    {
        return $this->hasMany(Etudiant::class);
    }

    public function isEtudiant(): bool
    {
        return $this->etudiants()->exists();
    }

    public function isProfesseur(): bool
    {
        return $this->professeurs()->exists();
    }

    public function isPersonnelAdministratif(): bool
    {
        return $this->personnelAdministratifs()->exists();
    }

}
