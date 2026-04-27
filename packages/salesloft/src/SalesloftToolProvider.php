<?php

namespace OpenCompany\Integrations\Salesloft;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListSequences;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetSequence;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreateSequence;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftListRules;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetRule;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SalesloftToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'salesloft';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'sequences, rules, users',
            'description' => 'Sales engagement platform',
            'icon' => 'ph:phone-outgoing',
            'logo' => 'simple-icons:salesloft',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Salesloft',
            'description' => 'Sales engagement platform for call sequences, automation rules, and team management',
            'icon' => 'ph:phone-outgoing',
            'logo' => 'simple-icons:salesloft',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developers.salesloft.com/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Salesloft API access token',
                'hint' => 'Generate an API token in Salesloft under Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.salesloft.com',
                'hint' => 'Defaults to <code>https://api.salesloft.com</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.salesloft.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.salesloft.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v3/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Salesloft API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $userName = $json['data']['first_name'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to Salesloft API as {$userName}.",
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
            'salesloft_list_sequences' => [
                'class' => SalesloftListSequences::class,
                'type' => 'read',
                'name' => 'List Sequences',
                'description' => 'List call sequences with optional status filtering.',
                'icon' => 'ph:list',
            ],
            'salesloft_get_sequence' => [
                'class' => SalesloftGetSequence::class,
                'type' => 'read',
                'name' => 'Get Sequence',
                'description' => 'Get details of a specific call sequence.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'salesloft_create_sequence' => [
                'class' => SalesloftCreateSequence::class,
                'type' => 'write',
                'name' => 'Create Sequence',
                'description' => 'Create a new call sequence with steps and targets.',
                'icon' => 'ph:plus',
            ],
            'salesloft_list_rules' => [
                'class' => SalesloftListRules::class,
                'type' => 'read',
                'name' => 'List Rules',
                'description' => 'List automation rules.',
                'icon' => 'ph:funnel',
            ],
            'salesloft_get_rule' => [
                'class' => SalesloftGetRule::class,
                'type' => 'read',
                'name' => 'Get Rule',
                'description' => 'Get details of a specific automation rule.',
                'icon' => 'ph:funnel',
            ],
            'salesloft_get_current_user' => [
                'class' => SalesloftGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/salesloft.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.salesloft.com'],
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

            $service = new SalesloftService(
                accessToken: $creds->get('salesloft', 'access_token', '', $account),
                baseUrl: $creds->get('salesloft', 'url', 'https://api.salesloft.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(SalesloftService::class));
    }
}
