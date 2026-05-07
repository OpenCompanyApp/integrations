<?php

namespace OpenCompany\Integrations\Gotify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Gotify\Tools\GotifyCreateApplication;
use OpenCompany\Integrations\Gotify\Tools\GotifyCreateClient;
use OpenCompany\Integrations\Gotify\Tools\GotifyCreateMessage;
use OpenCompany\Integrations\Gotify\Tools\GotifyDeleteApplication;
use OpenCompany\Integrations\Gotify\Tools\GotifyDeleteApplicationMessages;
use OpenCompany\Integrations\Gotify\Tools\GotifyDeleteClient;
use OpenCompany\Integrations\Gotify\Tools\GotifyDeleteMessage;
use OpenCompany\Integrations\Gotify\Tools\GotifyDeleteMessages;
use OpenCompany\Integrations\Gotify\Tools\GotifyGetCurrentUser;
use OpenCompany\Integrations\Gotify\Tools\GotifyGetHealth;
use OpenCompany\Integrations\Gotify\Tools\GotifyGetVersion;
use OpenCompany\Integrations\Gotify\Tools\GotifyListApplicationMessages;
use OpenCompany\Integrations\Gotify\Tools\GotifyListApplications;
use OpenCompany\Integrations\Gotify\Tools\GotifyListClients;
use OpenCompany\Integrations\Gotify\Tools\GotifyListMessages;
use OpenCompany\Integrations\Gotify\Tools\GotifyUpdateApplication;
use OpenCompany\Integrations\Gotify\Tools\GotifyUpdateClient;

/**
 * Exposes the Gotify REST API as agent-callable tools.
 *
 * Handles application-token sending, client-token management, catalog metadata, and multi-account resolution.
 */
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [
                    'Gotify application tokens can only create messages; client tokens are required for reads and management tools.',
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
            'description' => 'Self-hosted notification server for messages, applications, clients, health, and version metadata',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:gotify',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://gotify.net/api-docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Gotify Server URL',
                'placeholder' => 'https://gotify.example.com',
                'hint' => 'The base URL of your self-hosted Gotify server.',
                'default' => 'https://gotify.example.com',
                'required' => true,
            ],
            [
                'key' => 'app_token',
                'type' => 'secret',
                'label' => 'Application Token',
                'placeholder' => 'Enter your Gotify application token',
                'hint' => 'Application tokens can only send messages to /message.',
                'required' => false,
            ],
            [
                'key' => 'client_token',
                'type' => 'secret',
                'label' => 'Client Token',
                'placeholder' => 'Enter your Gotify client token',
                'hint' => 'Client tokens are required for listing/deleting messages and managing applications or clients.',
                'required' => false,
            ],
        ];
    }

    /**
     * Validate Gotify connection and configured token types.
     *
     * @param  array<string, mixed>  $config  Credential form values (hostname, app_token, client_token).
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $baseUrl = rtrim($config['hostname'] ?? 'https://gotify.example.com', '/');
        $appToken = $config['app_token'] ?? '';
        $clientToken = $config['client_token'] ?? '';

        try {
            $health = Http::timeout(10)->get($baseUrl . '/health');

            if ($health->json() === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Gotify server at {$baseUrl}. Check the URL.",
                ];
            }

            $tokenNotes = [];
            if ($appToken !== '') {
                $tokenNotes[] = 'application token configured for sending';
            }
            if ($clientToken !== '') {
                $response = Http::withHeaders([
                    'X-Gotify-Key' => $clientToken,
                    'Content-Type' => 'application/json',
                ])->timeout(10)->get($baseUrl . '/current/user');

                if (! $response->successful()) {
                    return [
                        'success' => false,
                        'error' => 'Gotify server is reachable, but the client token failed current-user validation.',
                    ];
                }

                $tokenNotes[] = 'client token validated for management calls';
            }

            if ($tokenNotes === []) {
                $tokenNotes[] = 'no token configured; only health/version tools will work';
            }

            return [
                'success' => true,
                'message' => "Connected to Gotify server at {$baseUrl}; " . implode(', ', $tokenNotes) . '.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'app_token' => 'nullable|string',
            'client_token' => 'nullable|string',
            'hostname' => 'required|url',
        ];
    }

    public function tools(): array
    {
        return [
            'gotify_create_message' => $this->tool(GotifyCreateMessage::class, 'write', 'Create Message', 'Send a notification message via Gotify application token.', 'ph:paper-plane-tilt'),
            'gotify_list_messages' => $this->tool(GotifyListMessages::class, 'read', 'List Messages', 'List messages visible to the configured client token.', 'ph:list-bullets'),
            'gotify_delete_message' => $this->tool(GotifyDeleteMessage::class, 'write', 'Delete Message', 'Delete one message by ID with a client token.', 'ph:trash'),
            'gotify_delete_messages' => $this->tool(GotifyDeleteMessages::class, 'write', 'Delete Messages', 'Delete all visible messages with a client token.', 'ph:trash-simple'),
            'gotify_list_application_messages' => $this->tool(GotifyListApplicationMessages::class, 'read', 'List Application Messages', 'List messages sent by one application.', 'ph:chat-centered-text'),
            'gotify_delete_application_messages' => $this->tool(GotifyDeleteApplicationMessages::class, 'write', 'Delete Application Messages', 'Delete all messages sent by one application.', 'ph:chat-centered-dots'),
            'gotify_list_applications' => $this->tool(GotifyListApplications::class, 'read', 'List Applications', 'List Gotify applications.', 'ph:app-window'),
            'gotify_create_application' => $this->tool(GotifyCreateApplication::class, 'write', 'Create Application', 'Create a Gotify application and receive an app token.', 'ph:plus-circle'),
            'gotify_update_application' => $this->tool(GotifyUpdateApplication::class, 'write', 'Update Application', 'Update a Gotify application name and description.', 'ph:pencil-simple'),
            'gotify_delete_application' => $this->tool(GotifyDeleteApplication::class, 'write', 'Delete Application', 'Delete a Gotify application; elevated auth may be required.', 'ph:minus-circle'),
            'gotify_list_clients' => $this->tool(GotifyListClients::class, 'read', 'List Clients', 'List Gotify clients.', 'ph:devices'),
            'gotify_create_client' => $this->tool(GotifyCreateClient::class, 'write', 'Create Client', 'Create a Gotify client and receive a client token.', 'ph:device-mobile-plus'),
            'gotify_update_client' => $this->tool(GotifyUpdateClient::class, 'write', 'Update Client', 'Update a Gotify client name.', 'ph:device-mobile-camera'),
            'gotify_delete_client' => $this->tool(GotifyDeleteClient::class, 'write', 'Delete Client', 'Delete a Gotify client; elevated auth may be required.', 'ph:device-mobile-x'),
            'gotify_get_current_user' => $this->tool(GotifyGetCurrentUser::class, 'read', 'Get Current User', 'Get current user information with a client token.', 'ph:user-circle'),
            'gotify_get_health' => $this->tool(GotifyGetHealth::class, 'read', 'Get Health', 'Check Gotify server health.', 'ph:heartbeat'),
            'gotify_get_version' => $this->tool(GotifyGetVersion::class, 'read', 'Get Version', 'Get Gotify server version information.', 'ph:info'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/gotify.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Gotify Server URL', 'required' => true],
            ['key' => 'app_token', 'type' => 'secret', 'label' => 'Application Token', 'required' => false],
            ['key' => 'client_token', 'type' => 'secret', 'label' => 'Client Token', 'required' => false],
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
     * Resolve the Gotify service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Optional tool context containing an account key.
     */
    private function resolveService(array $context = []): GotifyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GotifyService(
                appToken: $creds->get('gotify', 'app_token', '', $account),
                baseUrl: $creds->get('gotify', 'hostname', 'https://gotify.example.com', $account),
                clientToken: $creds->get('gotify', 'client_token', '', $account),
            );
        }

        return app(GotifyService::class);
    }

    /**
     * Build a catalog metadata entry for a Gotify tool.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}
     */
    private function tool(string $class, string $type, string $name, string $description, string $icon): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => $icon,
        ];
    }
}
