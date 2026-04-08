<?php

namespace OpenCompany\Integrations\Samsara;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Samsara\Tools\SamsaraListVehicles;
use OpenCompany\Integrations\Samsara\Tools\SamsaraGetVehicle;
use OpenCompany\Integrations\Samsara\Tools\SamsaraListDrivers;
use OpenCompany\Integrations\Samsara\Tools\SamsaraGetDriver;
use OpenCompany\Integrations\Samsara\Tools\SamsaraListSensors;
use OpenCompany\Integrations\Samsara\Tools\SamsaraGetCurrentUser;

class SamsaraToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the unique app name identifier.
     */
    public function appName(): string
    {
        return 'samsara';
    }

    /**
     * Get metadata for UI display.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'vehicles, drivers, sensors, fleet',
            'description' => 'Fleet and IoT management',
            'icon' => 'ph:truck',
            'logo' => 'simple-icons:samsara',
        ];
    }

    /**
     * Get integration metadata for the settings UI.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Samsara',
            'description' => 'Fleet management, vehicle tracking, driver management, and IoT sensors',
            'icon' => 'ph:truck',
            'logo' => 'simple-icons:samsara',
            'category' => 'fleet',
            'badge' => 'New',
            'docs_url' => 'https://developers.samsara.com/docs',
        ];
    }

    /**
     * Get the configuration schema for the settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Samsara API access token',
                'hint' => 'Generate an API token in Samsara under <strong>Settings → API Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.samsara.com/v2',
                'hint' => 'Use <code>https://api.samsara.com/v2</code> for the default Samsara cloud API',
                'default' => 'https://api.samsara.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the Samsara API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.samsara.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json();
                $email = $data['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Samsara API as {$email}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Samsara API returned HTTP {$response->status()}. Check your access token.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the tool definitions for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'samsara_list_vehicles' => [
                'class' => SamsaraListVehicles::class,
                'type' => 'read',
                'name' => 'List Vehicles',
                'description' => 'List fleet vehicles with pagination.',
                'icon' => 'ph:truck',
            ],
            'samsara_get_vehicle' => [
                'class' => SamsaraGetVehicle::class,
                'type' => 'read',
                'name' => 'Get Vehicle',
                'description' => 'Get details for a specific vehicle.',
                'icon' => 'ph:truck',
            ],
            'samsara_list_drivers' => [
                'class' => SamsaraListDrivers::class,
                'type' => 'read',
                'name' => 'List Drivers',
                'description' => 'List fleet drivers with pagination.',
                'icon' => 'ph:identification-card',
            ],
            'samsara_get_driver' => [
                'class' => SamsaraGetDriver::class,
                'type' => 'read',
                'name' => 'Get Driver',
                'description' => 'Get details for a specific driver.',
                'icon' => 'ph:identification-card',
            ],
            'samsara_list_sensors' => [
                'class' => SamsaraListSensors::class,
                'type' => 'read',
                'name' => 'List Sensors',
                'description' => 'List IoT sensors with pagination.',
                'icon' => 'ph:gauge',
            ],
            'samsara_get_current_user' => [
                'class' => SamsaraGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Samsara user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to supplementary Lua documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/samsara.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.samsara.com/v2'],
        ];
    }

    /**
     * Whether this provider is an integration (toggleable per agent).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context  Runtime context (e.g. account, agent, timezone).
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SamsaraService(
                accessToken: $creds->get('samsara', 'access_token', '', $account),
                baseUrl: $creds->get('samsara', 'url', 'https://api.samsara.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(SamsaraService::class));
    }
}
