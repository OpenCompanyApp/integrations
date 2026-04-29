<?php

namespace OpenCompany\Integrations\Freshchat;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatListConversations;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatGetConversation;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatCreateConversation;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatListAgents;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatGetAgent;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatListGroups;
use OpenCompany\Integrations\Freshchat\Tools\FreshchatGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FreshchatToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'freshchat';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Freshchat',
            'description' => 'Customer support',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:freshchat',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Freshchat',
            'description' => 'Customer messaging and support platform by Freshworks',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:freshchat',
            'category' => 'support',
            'badge' => 'verified',
            'docs_url' => 'https://developers.freshchat.com/api-docs/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Freshchat API access token',
                'hint' => 'Generate an access token in your Freshchat admin settings under "API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.freshchat.com',
                'hint' => 'Use <code>https://api.freshchat.com</code> for cloud, or your custom domain URL',
                'default' => 'https://api.freshchat.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.freshchat.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v2/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Freshchat API at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful()) {
                $userName = $json['first_name'] ?? ($json['email'] ?? 'Unknown');

                return [
                    'success' => true,
                    'message' => "Connected to Freshchat API as {$userName}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Freshchat API returned HTTP {$response->status()}. Check your access token.",
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
            'freshchat_list_conversations' => [
                'class' => FreshchatListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List support conversations with optional filters.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'freshchat_get_conversation' => [
                'class' => FreshchatGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Get details of a specific conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'freshchat_create_conversation' => [
                'class' => FreshchatCreateConversation::class,
                'type' => 'write',
                'name' => 'Create Conversation',
                'description' => 'Start a new support conversation.',
                'icon' => 'ph:chat-circle-plus',
            ],
            'freshchat_list_agents' => [
                'class' => FreshchatListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List support agents.',
                'icon' => 'ph:headset',
            ],
            'freshchat_get_agent' => [
                'class' => FreshchatGetAgent::class,
                'type' => 'read',
                'name' => 'Get Agent',
                'description' => 'Get details of a specific agent.',
                'icon' => 'ph:headset',
            ],
            'freshchat_list_groups' => [
                'class' => FreshchatListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List support groups (teams).',
                'icon' => 'ph:users-three',
            ],
            'freshchat_get_current_user' => [
                'class' => FreshchatGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freshchat.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.freshchat.com'],
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

            $service = new FreshchatService(
                accessToken: $creds->get('freshchat', 'access_token', '', $account),
                baseUrl: $creds->get('freshchat', 'url', 'https://api.freshchat.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshchatService::class));
    }
}
