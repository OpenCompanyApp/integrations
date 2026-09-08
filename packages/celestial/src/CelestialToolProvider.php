<?php

namespace OpenCompany\Integrations\Celestial;

use OpenCompany\Integrations\Celestial\Tools\CelestialLunarEclipse;
use OpenCompany\Integrations\Celestial\Tools\CelestialMoonInfo;
use OpenCompany\Integrations\Celestial\Tools\CelestialMoonPhase;
use OpenCompany\Integrations\Celestial\Tools\CelestialNightSky;
use OpenCompany\Integrations\Celestial\Tools\CelestialPlanetPosition;
use OpenCompany\Integrations\Celestial\Tools\CelestialSolarEclipse;
use OpenCompany\Integrations\Celestial\Tools\CelestialSunInfo;
use OpenCompany\Integrations\Celestial\Tools\CelestialTimeInfo;
use OpenCompany\Integrations\Celestial\Tools\CelestialZodiacReport;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CelestialToolProvider implements ToolProvider, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'none',
            'legacy_auth_type' => 'none',
            'credential_mode' => 'none',
            'setup_flows' =>
            [
              0 => 'none',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'celestial';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Celestial',
            'description' => 'Astronomical calculations and night sky',
            'icon' => 'ph:moon-stars',
            'logo' => 'ph:moon-stars',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Celestial',
            'description' => 'Astronomical calculations and night sky',
            'icon' => 'ph:moon-stars',
            'logo' => 'ph:moon-stars',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://aa.usno.navy.mil/data',
        ];
    }
    public function tools(): array
    {
        return [
            'celestial_moon_phase' => [
                'class' => CelestialMoonPhase::class,
                'type' => 'read',
                'name' => 'Moon Phase',
                'description' => 'Current moon phase, illumination, age, and next new/full moon.',
                'icon' => 'ph:moon',
            ],
            'celestial_sun_info' => [
                'class' => CelestialSunInfo::class,
                'type' => 'read',
                'name' => 'Sun Info',
                'description' => 'Sunrise/sunset, altitude, twilight, and day length for a location.',
                'icon' => 'ph:sun',
            ],
            'celestial_moon_info' => [
                'class' => CelestialMoonInfo::class,
                'type' => 'read',
                'name' => 'Moon Info',
                'description' => 'Moon position, illumination, and visibility from a location.',
                'icon' => 'ph:moon-stars',
            ],
            'celestial_planet_position' => [
                'class' => CelestialPlanetPosition::class,
                'type' => 'read',
                'name' => 'Planet Position',
                'description' => 'Planet altitude, azimuth, zodiac position, and rise/set times.',
                'icon' => 'ph:planet',
            ],
            'celestial_solar_eclipse' => [
                'class' => CelestialSolarEclipse::class,
                'type' => 'read',
                'name' => 'Solar Eclipse',
                'description' => 'Solar eclipse type, obscuration, contacts, and magnitude.',
                'icon' => 'ph:sun-dim',
            ],
            'celestial_lunar_eclipse' => [
                'class' => CelestialLunarEclipse::class,
                'type' => 'read',
                'name' => 'Lunar Eclipse',
                'description' => 'Lunar eclipse type, magnitude, gamma, and contact times.',
                'icon' => 'ph:moon',
            ],
            'celestial_night_sky' => [
                'class' => CelestialNightSky::class,
                'type' => 'read',
                'name' => 'Night Sky',
                'description' => 'What\'s visible now: positions, darkness, and stargazing quality.',
                'icon' => 'ph:star',
            ],
            'celestial_zodiac_report' => [
                'class' => CelestialZodiacReport::class,
                'type' => 'read',
                'name' => 'Zodiac Report',
                'description' => 'All celestial bodies mapped to zodiac signs with alignments.',
                'icon' => 'ph:shooting-star',
            ],
            'celestial_time_info' => [
                'class' => CelestialTimeInfo::class,
                'type' => 'read',
                'name' => 'Astronomical Time',
                'description' => 'Julian Day, sidereal time, and equation of time.',
                'icon' => 'ph:clock',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/celestial.md';
    }    public function credentialFields(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $service = app(CelestialService::class);

        return new $class($service, $context['timezone'] ?? 'UTC');
    }
}
