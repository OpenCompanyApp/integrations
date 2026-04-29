<?php

namespace OpenCompany\Integrations\Svix;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Svix\Tools\SvixListApplications;
use OpenCompany\Integrations\Svix\Tools\SvixGetApplication;
use OpenCompany\Integrations\Svix\Tools\SvixCreateApplication;
use OpenCompany\Integrations\Svix\Tools\SvixListMessages;
use OpenCompany\Integrations\Svix\Tools\SvixListEndpoints;
use OpenCompany\Integrations\Svix\Tools\SvixCreateEndpoint;
use OpenCompany\Integrations\Svix\Tools\SvixGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SvixToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
        return 'svix';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Svix',
            'description' => 'Webhook service',
            'icon' => 'ph:webhooks-logo',
            'logo' => 'simple-icons:svix',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Svix',
            'description' => 'Webhook as a service — manage applications, endpoints, and message delivery',
            'icon' => 'ph:webhooks-logo',
            'logo' => 'simple-icons:svix',
            'category' => 'developer',
            'badge' => 'verified',
            'docs_url' => 'https://docs.svix.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'auth_token',
                'type' => 'secret',
                'label' => 'Auth Token',
                'placeholder' => 'Enter your Svix authentication token',
                'hint' => 'Find your auth token in the Svix dashboard under "Authentication"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.svix.com',
                'hint' => 'Use <code>https://api.svix.com</code> for cloud, or your self-hosted Svix server URL',
                'default' => 'https://api.svix.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $authToken = $config['auth_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.svix.com', '/');

        if (empty($authToken)) {
            return ['success' => false, 'error' => 'No auth token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $authToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/app', ['limit' => 1]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Svix API at {$baseUrl}.",
                ];
            }

            $error = $response->json('detail') ?? $response->body();

            return [
                'success' => false,
                'error' => "Svix API returned HTTP {$response->status()}: " . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'auth_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'svix_list_applications' => [
                'class' => SvixListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List all Svix applications.',
                'icon' => 'ph:apps',
            ],
            'svix_get_application' => [
                'class' => SvixGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get details of a specific Svix application.',
                'icon' => 'ph:app-window',
            ],
            'svix_create_application' => [
                'class' => SvixCreateApplication::class,
                'type' => 'write',
                'name' => 'Create Application',
                'description' => 'Create a new Svix application.',
                'icon' => 'ph:plus-circle',
            ],
            'svix_list_messages' => [
                'class' => SvixListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages for a Svix application.',
                'icon' => 'ph:envelope',
            ],
            'svix_list_endpoints' => [
                'class' => SvixListEndpoints::class,
                'type' => 'read',
                'name' => 'List Endpoints',
                'description' => 'List endpoints for a Svix application.',
                'icon' => 'ph:link',
            ],
            'svix_create_endpoint' => [
                'class' => SvixCreateEndpoint::class,
                'type' => 'write',
                'name' => 'Create Endpoint',
                'description' => 'Create a new endpoint for a Svix application.',
                'icon' => 'ph:plus-circle',
            ],
            'svix_get_current_user' => [
                'class' => SvixGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Svix user and dashboard usage.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/svix.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.svix.com'],
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

            $service = new SvixService(
                authToken: $creds->get('svix', 'auth_token', '', $account),
                baseUrl: $creds->get('svix', 'url', 'https://api.svix.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(SvixService::class));
    }
}
