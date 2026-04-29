<?php

namespace OpenCompany\Integrations\Radar;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Radar\Tools\RadarListGeofences;
use OpenCompany\Integrations\Radar\Tools\RadarGetGeofence;
use OpenCompany\Integrations\Radar\Tools\RadarCreateGeofence;
use OpenCompany\Integrations\Radar\Tools\RadarListUsers;
use OpenCompany\Integrations\Radar\Tools\RadarGetUser;
use OpenCompany\Integrations\Radar\Tools\RadarListEvents;
use OpenCompany\Integrations\Radar\Tools\RadarGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class RadarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'radar';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Radar',
            'description' => 'Radar integration for Laravel — geofencing, location tracking, and event management.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
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
            'name' => 'Radar',
            'description' => 'Radar integration for Laravel — geofencing, location tracking, and event management.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Configuration schema for the Radar integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Radar API key',
                'hint' => 'Find your API key in the Radar dashboard under <strong>Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.radar.io/v1',
                'hint' => 'Use <code>https://api.radar.io/v1</code> (default) unless using a custom endpoint.',
                'default' => 'https://api.radar.io/v1',
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
        $apiKey = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.radar.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Radar API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Radar API at {$baseUrl}.",
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
            'access_token' => 'nullable|string',
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
            'radar_list_geofences' => [
                'class' => RadarListGeofences::class,
                'type' => 'read',
                'name' => 'List Geofences',
                'description' => 'List geofences with optional filters and pagination.',
                'icon' => 'ph:map-trifold',
            ],
            'radar_get_geofence' => [
                'class' => RadarGetGeofence::class,
                'type' => 'read',
                'name' => 'Get Geofence',
                'description' => 'Retrieve detailed information about a specific geofence.',
                'icon' => 'ph:map-pin',
            ],
            'radar_create_geofence' => [
                'class' => RadarCreateGeofence::class,
                'type' => 'write',
                'name' => 'Create Geofence',
                'description' => 'Create a new geofence in Radar.',
                'icon' => 'ph:plus-circle',
            ],
            'radar_list_users' => [
                'class' => RadarListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users with optional filters and pagination.',
                'icon' => 'ph:users',
            ],
            'radar_get_user' => [
                'class' => RadarGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve detailed information about a specific user.',
                'icon' => 'ph:user',
            ],
            'radar_list_events' => [
                'class' => RadarListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events with optional filters and pagination.',
                'icon' => 'ph:calendar',
            ],
            'radar_get_current_user' => [
                'class' => RadarGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Current User',
                'description' => 'Get the authenticated Radar user\'s account information.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Path to the Lua API docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/radar.md';
    }

    /**
     * Credential fields for quick reference.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.radar.io/v1'],
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

            $service = new RadarService(
                accessToken: $creds->get('radar', 'access_token', '', $account),
                baseUrl: $creds->get('radar', 'url', 'https://api.radar.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(RadarService::class));
    }
}
