<?php

namespace OpenCompany\Integrations\Pingdom;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pingdom\Tools\PingdomListChecks;
use OpenCompany\Integrations\Pingdom\Tools\PingdomGetCheck;
use OpenCompany\Integrations\Pingdom\Tools\PingdomCreateCheck;
use OpenCompany\Integrations\Pingdom\Tools\PingdomListResults;
use OpenCompany\Integrations\Pingdom\Tools\PingdomGetResults;
use OpenCompany\Integrations\Pingdom\Tools\PingdomListAlerts;
use OpenCompany\Integrations\Pingdom\Tools\PingdomGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PingdomToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'pingdom';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Pingdom',
            'description' => 'Uptime monitoring',
            'icon' => 'ph:heartbeat',
            'logo' => 'simple-icons:pingdom',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pingdom',
            'description' => 'Website uptime and performance monitoring',
            'icon' => 'ph:heartbeat',
            'logo' => 'simple-icons:pingdom',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://docs.pingdom.com/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Pingdom API key',
                'hint' => 'Generate an API key in your Pingdom account under Integrations > API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pingdom.com/api/3.1',
                'hint' => 'The Pingdom API base URL. Defaults to <code>https://api.pingdom.com/api/3.1</code>',
                'default' => 'https://api.pingdom.com/api/3.1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pingdom.com/api/3.1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/checks', [
                'limit' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pingdom API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Pingdom API at {$baseUrl}.",
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
            'pingdom_list_checks' => [
                'class' => PingdomListChecks::class,
                'type' => 'read',
                'name' => 'List Checks',
                'description' => 'List all uptime checks in Pingdom.',
                'icon' => 'ph:list-checks',
            ],
            'pingdom_get_check' => [
                'class' => PingdomGetCheck::class,
                'type' => 'read',
                'name' => 'Get Check',
                'description' => 'Get detailed information about a specific uptime check.',
                'icon' => 'ph:magnifying-glass',
            ],
            'pingdom_create_check' => [
                'class' => PingdomCreateCheck::class,
                'type' => 'write',
                'name' => 'Create Check',
                'description' => 'Create a new uptime check in Pingdom.',
                'icon' => 'ph:plus-circle',
            ],
            'pingdom_list_results' => [
                'class' => PingdomListResults::class,
                'type' => 'read',
                'name' => 'List Results',
                'description' => 'List summary results for an uptime check.',
                'icon' => 'ph:chart-bar',
            ],
            'pingdom_get_results' => [
                'class' => PingdomGetResults::class,
                'type' => 'read',
                'name' => 'Get Results',
                'description' => 'Get detailed test results for an uptime check.',
                'icon' => 'ph:chart-line-up',
            ],
            'pingdom_list_alerts' => [
                'class' => PingdomListAlerts::class,
                'type' => 'read',
                'name' => 'List Alerts',
                'description' => 'List alerts for the Pingdom account.',
                'icon' => 'ph:bell',
            ],
            'pingdom_get_current_user' => [
                'class' => PingdomGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get details of the currently authenticated Pingdom user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/pingdom.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pingdom.com/api/3.1'],
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

            $service = new PingdomService(
                apiKey: $creds->get('pingdom', 'api_key', '', $account),
                baseUrl: $creds->get('pingdom', 'url', 'https://api.pingdom.com/api/3.1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PingdomService::class));
    }
}
