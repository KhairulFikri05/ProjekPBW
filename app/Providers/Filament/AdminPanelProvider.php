<?php

namespace App\Providers\Filament;

use App\Filament\Resources\HeroSliderResource;
use App\Filament\Resources\AboutContentResource;
use App\Filament\Resources\AboutFeatureResource;
use App\Filament\Resources\AboutStatResource;
use App\Filament\Resources\MenuCategoryResource;
use App\Filament\Resources\MenuItemResource;
use App\Filament\Resources\TestimonialResource;
use App\Filament\Resources\ChefResource;
use App\Filament\Resources\ReservationResource;
use App\Filament\Resources\LocationResource;
use App\Filament\Resources\EventTypeResource;
use App\Filament\Resources\FeaturedEventResource;
use App\Filament\Resources\ContactResource;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->resources([
                HeroSliderResource::class,
                AboutContentResource::class,
                AboutFeatureResource::class,
                AboutStatResource::class,
                MenuCategoryResource::class,
                MenuItemResource::class,
                TestimonialResource::class,
                ChefResource::class,
                ReservationResource::class,
                LocationResource::class,
                EventTypeResource::class,
                FeaturedEventResource::class,
                ContactResource::class,
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
