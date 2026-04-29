<?php

namespace OpenCompany\Integrations\Gotify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gotify\Tools\GotifyListMessages;
use OpenCompany\Integrations\Gotify\Tools\GotifyCreateMessage;
use OpenCompany\Integrations\Gotify\Tools\GotifyDeleteMessage;
use OpenCompany\Integrations\Gotify\Tools\GotifyGetHealth;
use OpenCompany\Integrations\Gotify\Tools\GotifyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GotifyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'gotify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Gotify',
            'description' => 'Self-hosted notifications',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:gotify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Gotify',
            'description' => 'Self-hosted notification server for sending and receiving messages',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:gotify',
            'category' => 'messaging',
            'badge' => 'verified',
            'docs_url' => 'https://gotify.net/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'app_token',
                'type' => 'secret',
                'label' => 'App Token',
                'placeholder' => 'Enter your Gotify application token',
                'hint' => 'Create an application in your Gotify dashboard and copy the generated token',
                'required' => true,
            ],
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Gotify Server URL',
                'placeholder' => 'https://gotify.example.com',
                'hint' => 'The base URL of your self-hosted Gotify server',
                'default' => 'https://gotify.example.com',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $appToken = $config['app_token'] ?? '';
        $baseUrl = rtrim($config['hostname'] ?? 'https://gotify.example.com', '/');

        if (empty($appToken)) {
            return ['success' => false, 'error' => 'No app token provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Gotify-Key' => $appToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/health');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gotify server at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Gotify server at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'app_token' => 'required|string',
            'hostname' => 'required|url',
        ];
    }

    public function tools(): array
    {
        return [
            'gotify_list_messages' => [
                'class' => GotifyListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages from the Gotify application.',
                'icon' => 'ph:list-bullets',
            ],
            'gotify_create_message' => [
                'class' => GotifyCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Send a notification message via Gotify.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'gotify_delete_message' => [
                'class' => GotifyDeleteMessage::class,
                'type' => 'write',
                'name' => 'Delete Message',
                'description' => 'Delete a message by its ID.',
                'icon' => 'ph:trash',
            ],
            'gotify_get_health' => [
                'class' => GotifyGetHealth::class,
                'type' => 'read',
                'name' => 'Get Health',
                'description' => 'Check the health status of the Gotify server.',
                'icon' => 'ph:heartbeat',
            ],
            'gotify_get_current_user' => [
                'class' => GotifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get information about the currently authenticated user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gotify.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'app_token', 'type' => 'secret', 'label' => 'App Token', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Gotify Server URL', 'required' => true],
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

            $service = new GotifyService(
                appToken: $creds->get('gotify', 'app_token', '', $account),
                baseUrl: $creds->get('gotify', 'hostname', 'https://gotify.example.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GotifyService::class));
    }
}
