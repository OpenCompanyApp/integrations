<?php

namespace OpenCompany\Integrations\Nasa;

use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Nasa\Tools\NasaGetApod;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroid;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroids;
use OpenCompany\Integrations\Nasa\Tools\NasaGetCurrentUser;
use OpenCompany\Integrations\Nasa\Tools\NasaGetMarsRoverPhotos;
use OpenCompany\Integrations\Nasa\Tools\NasaSearchImages;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NasaToolProvider implements ToolProvider, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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



/**
     * Get the application name used for registration.
     */
    public function appName(): string
    {
        return 'nasa';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'NASA',
            'description' => 'NASA space and science data',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:nasa',
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
            'name' => 'NASA',
            'description' => 'NASA space and science data',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:nasa',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api.nasa.gov/',
        ];
    }

    public function tools(): array
    {
        return [
            'nasa_get_apod' => [
                'class' => NasaGetApod::class,
                'type' => 'read',
                'name' => 'NASA Get APOD',
                'description' => 'Get the NASA Astronomy Picture of the Day (APOD). Returns the daily astronomical image or photo along with an explanation written by a professional astronomer. You can request a specific date or a range of dates.',
                'icon' => 'ph:wrench',
            ],
            'nasa_get_asteroid' => [
                'class' => NasaGetAsteroid::class,
                'type' => 'read',
                'name' => 'NASA Get Asteroid',
                'description' => 'Get detailed information about a specific Near Earth Object (asteroid) by its NASA ID. Returns orbital data, estimated diameter, close approach history, and hazard assessment.',
                'icon' => 'ph:wrench',
            ],
            'nasa_get_asteroids' => [
                'class' => NasaGetAsteroids::class,
                'type' => 'read',
                'name' => 'NASA Get Asteroids',
                'description' => 'Get Near Earth Objects (asteroids) for a date range from NASA. Returns a list of asteroids with their estimated diameter, velocity, distance from Earth, and whether they are potentially hazardous.',
                'icon' => 'ph:wrench',
            ],
            'nasa_get_current_user' => [
                'class' => NasaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'NASA Get Current User',
                'description' => 'Get information about the current NASA API configuration. The NASA API is public and does not require user authentication — this tool returns the API key status and available endpoints.',
                'icon' => 'ph:wrench',
            ],
            'nasa_get_mars_rover_photos' => [
                'class' => NasaGetMarsRoverPhotos::class,
                'type' => 'read',
                'name' => 'NASA Get Mars Rover Photos',
                'description' => 'Get photos from NASA Mars rovers (Curiosity, Opportunity, Spirit, Perseverance). Query by sol (Martian day) or Earth date, and optionally filter by camera. Returns photo URLs and metadata.',
                'icon' => 'ph:wrench',
            ],
            'nasa_search_images' => [
                'class' => NasaSearchImages::class,
                'type' => 'read',
                'name' => 'NASA Search Images',
                'description' => 'Search the NASA Image and Video Library for space, astronomy, and mission imagery. Returns image URLs, titles, descriptions, and metadata from NASA\'s vast collection.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/nasa.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false, 'placeholder' => 'DEMO_KEY'],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.nasa.gov'],
        ];
    }

    /**
     * Create a tool instance.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context (unused for public API).
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new NasaService(
                apiKey: $creds->get('nasa', 'api_key', 'DEMO_KEY', $account),
                baseUrl: $creds->get('nasa', 'url', 'https://api.nasa.gov', $account),
            );

            return new $class($service);
        }

        return new $class(app(NasaService::class));
    }
}
