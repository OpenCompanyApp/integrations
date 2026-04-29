<?php

namespace OpenCompany\Integrations\Ipstack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupIp;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupBulk;
use OpenCompany\Integrations\Ipstack\Tools\IpstackCheckLocation;
use OpenCompany\Integrations\Ipstack\Tools\IpstackGetTimezone;
use OpenCompany\Integrations\Ipstack\Tools\IpstackGetCurrency;
use OpenCompany\Integrations\Ipstack\Tools\IpstackGetConnection;
use OpenCompany\Integrations\Ipstack\Tools\IpstackGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class IpstackToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'ipstack';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Ipstack',
            'description' => 'IPstack geolocation integration for Laravel — lookup IP addresses, check location…',
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
            'name' => 'Ipstack',
            'description' => 'IPstack geolocation integration for Laravel — lookup IP addresses, check location, timezone, currency, and connection data.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Configuration schema for the IPstack integration.
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
                'placeholder' => 'Enter your IPstack API access key',
                'hint' => 'Find your access key in the IPstack dashboard at <strong>Dashboard → Access Key</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ipstack.com',
                'hint' => 'Use <code>https://api.ipstack.com</code> (default). HTTPS may require a paid plan.',
                'default' => 'https://api.ipstack.com',
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
        $baseUrl = rtrim($config['url'] ?? 'https://api.ipstack.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::timeout(10)->get($baseUrl . '/check', [
                'access_key' => $apiKey,
            ]);

            $json = $response->json();

            if (isset($json['error'])) {
                $error = $json['error']['info'] ?? $json['error']['type'] ?? 'Unknown error';
                return ['success' => false, 'error' => "IPstack API error: {$error}"];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach IPstack API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to IPstack API at {$baseUrl}.",
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
            'ipstack_lookup_ip' => [
                'class' => IpstackLookupIp::class,
                'type' => 'read',
                'name' => 'Lookup IP',
                'description' => 'Look up geolocation data for a single IP address.',
                'icon' => 'ph:map-pin',
            ],
            'ipstack_lookup_bulk' => [
                'class' => IpstackLookupBulk::class,
                'type' => 'read',
                'name' => 'Bulk IP Lookup',
                'description' => 'Look up geolocation data for multiple IP addresses at once.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'ipstack_check_location' => [
                'class' => IpstackCheckLocation::class,
                'type' => 'read',
                'name' => 'Check Location',
                'description' => 'Check if an IP address is in a specific country or region.',
                'icon' => 'ph:map-trifold',
            ],
            'ipstack_get_timezone' => [
                'class' => IpstackGetTimezone::class,
                'type' => 'read',
                'name' => 'Get Timezone',
                'description' => 'Get timezone information for an IP address.',
                'icon' => 'ph:clock',
            ],
            'ipstack_get_currency' => [
                'class' => IpstackGetCurrency::class,
                'type' => 'read',
                'name' => 'Get Currency',
                'description' => 'Get local currency information for an IP address.',
                'icon' => 'ph:currency-dollar',
            ],
            'ipstack_get_connection' => [
                'class' => IpstackGetConnection::class,
                'type' => 'read',
                'name' => 'Get Connection',
                'description' => 'Get connection and ISP information for an IP address.',
                'icon' => 'ph:wifi-high',
            ],
            'ipstack_get_current_user' => [
                'class' => IpstackGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Detect and geolocate the current requesting IP address.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ipstack.md';
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
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.ipstack.com'],
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

            $service = new IpstackService(
                apiKey: $creds->get('ipstack', 'api_key', '', $account),
                baseUrl: $creds->get('ipstack', 'url', 'https://api.ipstack.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(IpstackService::class));
    }
}
