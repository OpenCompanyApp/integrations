<?php

namespace OpenCompany\Integrations\Nasa;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Nasa\Tools\NasaBrowseAsteroids;
use OpenCompany\Integrations\Nasa\Tools\NasaGetApod;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroid;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroids;
use OpenCompany\Integrations\Nasa\Tools\NasaGetDonkiEvents;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEarthAssets;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEarthImagery;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEonetCategories;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEonetEvent;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEonetEvents;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEonetSources;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEpicImages;
use OpenCompany\Integrations\Nasa\Tools\NasaGetImageAsset;
use OpenCompany\Integrations\Nasa\Tools\NasaGetImageCaptions;
use OpenCompany\Integrations\Nasa\Tools\NasaGetImageMetadata;
use OpenCompany\Integrations\Nasa\Tools\NasaGetMarsRoverPhotos;
use OpenCompany\Integrations\Nasa\Tools\NasaSearchImages;

/**
 * Exposes NASA public data APIs as agent tools.
 *
 * Covers api.nasa.gov endpoints plus NASA Image Library and EONET public hosts.
 */
class NasaToolProvider implements ConfigurableIntegration, ToolProvider, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['NASA Image Library and EONET tools use public NASA hosts and do not send the api.nasa.gov key.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
            'description' => 'NASA space, imagery, and Earth science data',
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
            'description' => 'NASA open APIs for space science, Earth events, imagery, asteroids, and Mars rover photos',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:nasa',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api.nasa.gov/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'DEMO_KEY',
                'hint' => 'Optional NASA API key from <a href="https://api.nasa.gov/" target="_blank">api.nasa.gov</a>. DEMO_KEY works with stricter rate limits.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'default' => 'https://api.nasa.gov',
                'required' => false,
            ],
        ];
    }

    /**
     * Verify NASA API credentials with a lightweight APOD request.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? 'DEMO_KEY');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.nasa.gov'), '/');

        try {
            $response = Http::timeout(10)->get($baseUrl . '/planetary/apod', [
                'api_key' => $apiKey !== '' ? $apiKey : 'DEMO_KEY',
            ]);

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to NASA Open APIs.'];
            }

            $error = $response->json('msg') ?? $response->json('error.message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'NASA API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'nasa_get_apod' => [
                'class' => NasaGetApod::class,
                'type' => 'read',
                'name' => 'Get APOD',
                'description' => 'Get the NASA Astronomy Picture of the Day for a date, date range, or random count.',
                'icon' => 'ph:image',
            ],
            'nasa_get_mars_rover_photos' => [
                'class' => NasaGetMarsRoverPhotos::class,
                'type' => 'read',
                'name' => 'Mars Rover Photos',
                'description' => 'Get Mars rover photos from Curiosity, Opportunity, Spirit, or Perseverance.',
                'icon' => 'ph:camera',
            ],
            'nasa_get_asteroids' => [
                'class' => NasaGetAsteroids::class,
                'type' => 'read',
                'name' => 'Asteroid Feed',
                'description' => 'Get Near Earth Objects for a closest-approach date range.',
                'icon' => 'ph:planet',
            ],
            'nasa_browse_asteroids' => [
                'class' => NasaBrowseAsteroids::class,
                'type' => 'read',
                'name' => 'Browse Asteroids',
                'description' => 'Browse the overall Near Earth Object dataset with pagination.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'nasa_get_asteroid' => [
                'class' => NasaGetAsteroid::class,
                'type' => 'read',
                'name' => 'Asteroid Detail',
                'description' => 'Get detailed information about a specific Near Earth Object by NASA ID.',
                'icon' => 'ph:target',
            ],
            'nasa_get_donki_events' => [
                'class' => NasaGetDonkiEvents::class,
                'type' => 'read',
                'name' => 'DONKI Events',
                'description' => 'Query DONKI space-weather event endpoints including CME, solar flares, storms, and notifications.',
                'icon' => 'ph:cloud-lightning',
            ],
            'nasa_get_epic_images' => [
                'class' => NasaGetEpicImages::class,
                'type' => 'read',
                'name' => 'EPIC Images',
                'description' => 'Get EPIC Earth image metadata or available dates for natural and enhanced collections.',
                'icon' => 'ph:globe-hemisphere-east',
            ],
            'nasa_get_earth_imagery' => [
                'class' => NasaGetEarthImagery::class,
                'type' => 'read',
                'name' => 'Earth Imagery',
                'description' => 'Get NASA Earth imagery for a coordinate, date, and image dimension.',
                'icon' => 'ph:map-pin',
            ],
            'nasa_get_earth_assets' => [
                'class' => NasaGetEarthAssets::class,
                'type' => 'read',
                'name' => 'Earth Assets',
                'description' => 'Get available NASA Earth asset dates for a coordinate.',
                'icon' => 'ph:calendar-dots',
            ],
            'nasa_search_images' => [
                'class' => NasaSearchImages::class,
                'type' => 'read',
                'name' => 'Search Images',
                'description' => 'Search the NASA Image and Video Library by query and metadata filters.',
                'icon' => 'ph:magnifying-glass',
            ],
            'nasa_get_image_asset' => [
                'class' => NasaGetImageAsset::class,
                'type' => 'read',
                'name' => 'Image Asset',
                'description' => 'Get downloadable asset URLs for a NASA Image Library media ID.',
                'icon' => 'ph:file-image',
            ],
            'nasa_get_image_metadata' => [
                'class' => NasaGetImageMetadata::class,
                'type' => 'read',
                'name' => 'Image Metadata',
                'description' => 'Get metadata for a NASA Image Library media ID.',
                'icon' => 'ph:file-text',
            ],
            'nasa_get_image_captions' => [
                'class' => NasaGetImageCaptions::class,
                'type' => 'read',
                'name' => 'Image Captions',
                'description' => 'Get caption file locations for a NASA Image Library media ID.',
                'icon' => 'ph:closed-captioning',
            ],
            'nasa_get_eonet_events' => [
                'class' => NasaGetEonetEvents::class,
                'type' => 'read',
                'name' => 'EONET Events',
                'description' => 'List EONET v3 natural events with status, category, source, limit, and date filters.',
                'icon' => 'ph:activity',
            ],
            'nasa_get_eonet_event' => [
                'class' => NasaGetEonetEvent::class,
                'type' => 'read',
                'name' => 'EONET Event',
                'description' => 'Get one EONET v3 natural event by event ID.',
                'icon' => 'ph:crosshair',
            ],
            'nasa_get_eonet_categories' => [
                'class' => NasaGetEonetCategories::class,
                'type' => 'read',
                'name' => 'EONET Categories',
                'description' => 'List EONET v3 natural event categories.',
                'icon' => 'ph:tag',
            ],
            'nasa_get_eonet_sources' => [
                'class' => NasaGetEonetSources::class,
                'type' => 'read',
                'name' => 'EONET Sources',
                'description' => 'List EONET v3 natural event sources.',
                'icon' => 'ph:database',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/nasa.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Create a tool instance.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional multi-account context.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the NASA service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Optional multi-account context.
     */
    private function resolveService(array $context = []): NasaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new NasaService(
                apiKey: $creds->get('nasa', 'api_key', 'DEMO_KEY', $account),
                baseUrl: $creds->get('nasa', 'url', 'https://api.nasa.gov', $account),
            );
        }

        return app(NasaService::class);
    }
}
