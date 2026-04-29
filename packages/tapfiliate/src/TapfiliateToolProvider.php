<?php

namespace OpenCompany\Integrations\Tapfiliate;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListAffiliates;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetAffiliate;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateListConversions;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateCreateConversion;
use OpenCompany\Integrations\Tapfiliate\Tools\TapfiliateGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TapfiliateToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'tapfiliate';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Tapfiliate',
            'description' => 'Affiliate marketing',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:tapfiliate',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Tapfiliate',
            'description' => 'Affiliate marketing and referral tracking platform',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:tapfiliate',
            'category' => 'marketing',
            'badge' => 'New',
            'docs_url' => 'https://support.tapfiliate.com/en/articles/1907272-rest-api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Tapfiliate API key',
                'hint' => 'Find your API key in Tapfiliate under Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.tapfiliate.com/1.5',
                'hint' => 'Defaults to <code>https://api.tapfiliate.com/1.5</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.tapfiliate.com/1.5',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.tapfiliate.com/1.5', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = $user['first_name'] ?? $user['email'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Tapfiliate as {$name}.",
                ];
            }

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Invalid API key.'];
            }

            return [
                'success' => false,
                'error' => "Tapfiliate API returned HTTP {$response->status()}.",
            ];
        } catch (\Exception $e) {
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
            'tapfiliate_list_affiliates' => [
                'class' => TapfiliateListAffiliates::class,
                'type' => 'read',
                'name' => 'List Affiliates',
                'description' => 'List all affiliates with pagination.',
                'icon' => 'ph:users-three',
            ],
            'tapfiliate_get_affiliate' => [
                'class' => TapfiliateGetAffiliate::class,
                'type' => 'read',
                'name' => 'Get Affiliate',
                'description' => 'Get details for a specific affiliate.',
                'icon' => 'ph:user',
            ],
            'tapfiliate_list_conversions' => [
                'class' => TapfiliateListConversions::class,
                'type' => 'read',
                'name' => 'List Conversions',
                'description' => 'List conversions with optional filters.',
                'icon' => 'ph:currency-dollar',
            ],
            'tapfiliate_create_conversion' => [
                'class' => TapfiliateCreateConversion::class,
                'type' => 'write',
                'name' => 'Create Conversion',
                'description' => 'Create a new conversion for an affiliate.',
                'icon' => 'ph:plus-circle',
            ],
            'tapfiliate_get_current_user' => [
                'class' => TapfiliateGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Tapfiliate user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/tapfiliate.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.tapfiliate.com/1.5'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TapfiliateService(
                apiKey: $creds->get('tapfiliate', 'api_key', '', $account),
                baseUrl: $creds->get('tapfiliate', 'url', 'https://api.tapfiliate.com/1.5', $account),
            );

            return new $class($service);
        }

        return new $class(app(TapfiliateService::class));
    }
}
