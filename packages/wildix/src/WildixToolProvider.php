<?php

namespace OpenCompany\Integrations\Wildix;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wildix\Tools\WildixListCalls;
use OpenCompany\Integrations\Wildix\Tools\WildixGetCall;
use OpenCompany\Integrations\Wildix\Tools\WildixListExtensions;
use OpenCompany\Integrations\Wildix\Tools\WildixGetExtension;
use OpenCompany\Integrations\Wildix\Tools\WildixListUsers;
use OpenCompany\Integrations\Wildix\Tools\WildixGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class WildixToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'wildix';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'calls, extensions, users',
            'description' => 'Business telephony',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:wildix',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Wildix',
            'description' => 'Unified communications & VoIP PBX platform',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:wildix',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.wildix.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Wildix API access token',
                'hint' => 'Generate an access token in your Wildix system under Administration > API Access',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.wildix.com',
                'hint' => 'Use <code>https://api.wildix.com</code> for the default Wildix API, or your custom endpoint',
                'default' => 'https://api.wildix.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.wildix.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Wildix API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Wildix API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'wildix_list_calls' => [
                'class' => WildixListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List call records with optional date filtering and pagination.',
                'icon' => 'ph:phone',
            ],
            'wildix_get_call' => [
                'class' => WildixGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Get details of a specific call by ID.',
                'icon' => 'ph:phone',
            ],
            'wildix_list_extensions' => [
                'class' => WildixListExtensions::class,
                'type' => 'read',
                'name' => 'List Extensions',
                'description' => 'List PBX extensions.',
                'icon' => 'ph:device-mobile',
            ],
            'wildix_get_extension' => [
                'class' => WildixGetExtension::class,
                'type' => 'read',
                'name' => 'Get Extension',
                'description' => 'Get details of a specific extension by ID.',
                'icon' => 'ph:device-mobile',
            ],
            'wildix_list_users' => [
                'class' => WildixListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Wildix PBX users.',
                'icon' => 'ph:users',
            ],
            'wildix_get_current_user' => [
                'class' => WildixGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wildix.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.wildix.com'],
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

            $service = new WildixService(
                accessToken: $creds->get('wildix', 'access_token', '', $account),
                baseUrl: $creds->get('wildix', 'url', 'https://api.wildix.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(WildixService::class));
    }
}
