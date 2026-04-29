<?php

namespace OpenCompany\Integrations\GoogleChat;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatListSpaces;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatGetSpace;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatListMessages;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatGetMessage;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatCreateMessage;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatListMemberships;
use OpenCompany\Integrations\GoogleChat\Tools\GoogleChatGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleChatToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'google-chat';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Google Chat',
            'description' => 'Team messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'logos:google-chat',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Chat',
            'description' => 'Send and read messages, list spaces and memberships in Google Chat',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'logos:google-chat',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/chat/api/reference/rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google Chat OAuth access token',
                'hint' => 'Provide an OAuth 2.0 access token with the <code>chat.bot</code> or <code>chat.memberships</code> / <code>chat.messages</code> / <code>chat.spaces</code> scopes',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://chat.googleapis.com',
                'hint' => 'Override only if using a custom endpoint or proxy',
                'default' => 'https://chat.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://chat.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/spaces', ['pageSize' => 1]);

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid or expired access token.',
                ];
            }

            if ($response->status() === 403) {
                return [
                    'success' => false,
                    'error' => 'Access token does not have the required scopes (chat.spaces.readonly).',
                ];
            }

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? "HTTP {$response->status()}";
                return ['success' => false, 'error' => $error];
            }

            return [
                'success' => true,
                'message' => 'Connected to Google Chat API.',
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
            'google_chat_list_spaces' => [
                'class' => GoogleChatListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'List Google Chat spaces the authenticated user belongs to.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'google_chat_get_space' => [
                'class' => GoogleChatGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get details about a specific Google Chat space.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'google_chat_list_messages' => [
                'class' => GoogleChatListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a Google Chat space.',
                'icon' => 'ph:chat-text',
            ],
            'google_chat_get_message' => [
                'class' => GoogleChatGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get a specific message from a Google Chat space.',
                'icon' => 'ph:chat-text',
            ],
            'google_chat_create_message' => [
                'class' => GoogleChatCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Send a message to a Google Chat space.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'google_chat_list_memberships' => [
                'class' => GoogleChatListMemberships::class,
                'type' => 'read',
                'name' => 'List Memberships',
                'description' => 'List members of a Google Chat space.',
                'icon' => 'ph:users',
            ],
            'google_chat_get_current_user' => [
                'class' => GoogleChatGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s membership in a Google Chat space.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-chat.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://chat.googleapis.com'],
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

            $service = new GoogleChatService(
                accessToken: $creds->get('google-chat', 'access_token', '', $account),
                baseUrl: $creds->get('google-chat', 'url', 'https://chat.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleChatService::class));
    }
}
