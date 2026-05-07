<?php

namespace OpenCompany\Integrations\Ipstack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupBulk;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupIp;
use OpenCompany\Integrations\Ipstack\Tools\IpstackLookupRequester;

/**
 * Publishes IPstack geolocation lookup tools to host discovery surfaces.
 *
 * The provider exposes the three official endpoint shapes: standard lookup,
 * bulk lookup, and requester lookup.
 */
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'HTTPS, bulk lookup, hostname lookup, and security fields can depend on the selected IPstack plan.',
                ],
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
        return 'ipstack';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'IPstack',
            'description' => 'IP geolocation lookup',
            'icon' => 'ph:map-pin',
            'logo' => 'ph:map-pin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'IPstack',
            'description' => 'Look up IP geolocation data through the official IPstack standard, bulk, and requester endpoints.',
            'icon' => 'ph:map-pin',
            'logo' => 'ph:map-pin',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://ipstack.com/documentation',
            'source_url' => 'https://ipstack.com/documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your IPstack API access key',
                'hint' => 'Find your access key in the IPstack dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ipstack.com',
                'hint' => 'Use https://api.ipstack.com. HTTPS access can depend on your IPstack plan.',
                'default' => 'https://api.ipstack.com',
            ],
        ];
    }

    /**
     * Test the connection using the requester lookup endpoint.
     *
     * @param  array<string, mixed>  $config  Candidate credential values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.ipstack.com'), '/');

        if ($apiKey === '') {
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
            'ipstack_lookup_ip' => [
                'class' => IpstackLookupIp::class,
                'type' => 'read',
                'name' => 'Standard Lookup',
                'description' => 'Look up geolocation data for one IP address or domain.',
                'icon' => 'ph:map-pin',
            ],
            'ipstack_lookup_bulk' => [
                'class' => IpstackLookupBulk::class,
                'type' => 'read',
                'name' => 'Bulk Lookup',
                'description' => 'Look up geolocation data for up to 50 IP addresses or domains.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'ipstack_lookup_requester' => [
                'class' => IpstackLookupRequester::class,
                'type' => 'read',
                'name' => 'Requester Lookup',
                'description' => 'Detect and geolocate the requesting IP address.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ipstack.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.ipstack.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context with optional account.
     */
    private function resolveService(array $context = []): IpstackService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new IpstackService(
                apiKey: $creds->get('ipstack', 'api_key', '', $account),
                baseUrl: $creds->get('ipstack', 'url', 'https://api.ipstack.com', $account),
            );
        }

        return app(IpstackService::class);
    }
}
