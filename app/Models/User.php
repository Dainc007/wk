<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\DefaultSettings;
use Database\Factories\UserFactory;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Tags\HasTags;

final class User extends Authenticatable implements FilamentUser, HasMedia
    // ,MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory,
        HasRoles,
        HasTags,
        InteractsWithMedia,
        LogsActivity,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin(): bool
    {
        return $this->hasRole(['super-admin', 'admin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }

    /**
     * @throws Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->isAdmin(),
            'app' => auth()->check(),
        };
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        $media = $this->getFirstMedia('avatars');

        return $media?->getUrl('preview') ?? DefaultSettings::AvatarUrl->getUrl();
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function twitch(): MorphOne
    {
        return $this->morphOne(Twitch::class, 'twitchable');
    }

    public function discord(): MorphOne
    {
        return $this->morphOne(Discord::class, 'discordable');
    }

    public function canBeImpersonated(): bool
    {
        return ! $this->isAdmin();
    }

    public function canImpersonate(): true
    {
        return $this->isSuperAdmin();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

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
}
