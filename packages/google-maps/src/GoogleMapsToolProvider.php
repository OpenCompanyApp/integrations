<?php

namespace OpenCompany\Integrations\GoogleMaps;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsGeocodeAddress;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsReverseGeocode;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsSearchPlaces;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsGetPlaceDetails;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsGetDirections;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsGetDistanceMatrix;
use OpenCompany\Integrations\GoogleMaps\Tools\GoogleMapsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleMapsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'google-maps';
    }    /**
     * Configuration schema for the Google Maps integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Google Maps API key',
                'hint' => 'Find your API key in the Google Cloud Console at <strong>APIs & Services → Credentials</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://maps.googleapis.com/maps/api',
                'hint' => 'Use <code>https://maps.googleapis.com/maps/api</code> (default).',
                'default' => 'https://maps.googleapis.com/maps/api',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://maps.googleapis.com/maps/api', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::timeout(10)->get($baseUrl . '/geocode/json', [
                'key' => $apiKey,
                'address' => 'Google HQ, Mountain View, CA',
            ]);

            $json = $response->json();

            if (isset($json['error_message'])) {
                return ['success' => false, 'error' => "Google Maps API error: {$json['error_message']}"];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Google Maps API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Google Maps API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'google_maps_geocode_address' => [
                'class' => GoogleMapsGeocodeAddress::class,
                'type' => 'read',
                'name' => 'Geocode Address',
                'description' => 'Convert a street address into geographic coordinates.',
                'icon' => 'ph:map-pin',
            ],
            'google_maps_reverse_geocode' => [
                'class' => GoogleMapsReverseGeocode::class,
                'type' => 'read',
                'name' => 'Reverse Geocode',
                'description' => 'Convert geographic coordinates into a street address.',
                'icon' => 'ph:map-pin-line',
            ],
            'google_maps_search_places' => [
                'class' => GoogleMapsSearchPlaces::class,
                'type' => 'read',
                'name' => 'Search Places',
                'description' => 'Search for places using a text query.',
                'icon' => 'ph:magnifying-glass',
            ],
            'google_maps_get_place_details' => [
                'class' => GoogleMapsGetPlaceDetails::class,
                'type' => 'read',
                'name' => 'Get Place Details',
                'description' => 'Get detailed information about a specific place.',
                'icon' => 'ph:buildings',
            ],
            'google_maps_get_directions' => [
                'class' => GoogleMapsGetDirections::class,
                'type' => 'read',
                'name' => 'Get Directions',
                'description' => 'Get directions between an origin and destination.',
                'icon' => 'ph:roads',
            ],
            'google_maps_get_distance_matrix' => [
                'class' => GoogleMapsGetDistanceMatrix::class,
                'type' => 'read',
                'name' => 'Get Distance Matrix',
                'description' => 'Calculate travel distance and time for multiple origins and destinations.',
                'icon' => 'ph:table',
            ],
            'google_maps_get_current_user' => [
                'class' => GoogleMapsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Estimate the current user\'s location based on their IP address.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-maps.md';
    }

    /**
     * Credential fields for quick reference.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://maps.googleapis.com/maps/api'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with an 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GoogleMapsService(
                apiKey: $creds->get('google-maps', 'api_key', '', $account),
                baseUrl: $creds->get('google-maps', 'url', 'https://maps.googleapis.com/maps/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleMapsService::class));
    }
}
