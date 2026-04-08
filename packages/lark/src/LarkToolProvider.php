<?php

namespace OpenCompany\Integrations\Lark;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Lark\Tools\LarkListChats;
use OpenCompany\Integrations\Lark\Tools\LarkGetChat;
use OpenCompany\Integrations\Lark\Tools\LarkCreateChat;
use OpenCompany\Integrations\Lark\Tools\LarkListMessages;
use OpenCompany\Integrations\Lark\Tools\LarkSendMessage;
use OpenCompany\Integrations\Lark\Tools\LarkListMembers;
use OpenCompany\Integrations\Lark\Tools\LarkGetCurrentUser;

class LarkToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'lark';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'chats, messages, members',
            'description' => 'Team messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:lark',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lark Suite',
            'description' => 'Team messaging and collaboration platform',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:lark',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://open.larksuite.com/document',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Lark access token',
                'hint' => 'Generate a tenant or user access token from the Lark Developer Console',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://open.larksuite.com',
                'hint' => 'Use <code>https://open.larksuite.com</code> for Lark Suite, or <code>https://open.feishu.cn</code> for Feishu',
                'default' => 'https://open.larksuite.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://open.larksuite.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/open-apis/auth/v3/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Lark API at {$baseUrl}. Check the URL.",
                ];
            }

            $code = $json['code'] ?? -1;
            if ($code === 0) {
                return [
                    'success' => true,
                    'message' => "Connected to Lark API at {$baseUrl}.",
                ];
            }

            $msg = $json['msg'] ?? 'Unknown error';
            return [
                'success' => false,
                'error' => "Lark API returned error: {$msg}",
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
            'lark_list_chats' => [
                'class' => LarkListChats::class,
                'type' => 'read',
                'name' => 'List Chats',
                'description' => 'List chats the current user belongs to.',
                'icon' => 'ph:chats',
            ],
            'lark_get_chat' => [
                'class' => LarkGetChat::class,
                'type' => 'read',
                'name' => 'Get Chat',
                'description' => 'Get detailed information about a specific chat.',
                'icon' => 'ph:chat-circle',
            ],
            'lark_create_chat' => [
                'class' => LarkCreateChat::class,
                'type' => 'write',
                'name' => 'Create Chat',
                'description' => 'Create a new group chat.',
                'icon' => 'ph:chat-circle-plus',
            ],
            'lark_list_messages' => [
                'class' => LarkListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List messages in a specific chat.',
                'icon' => 'ph:list-bullets',
            ],
            'lark_send_message' => [
                'class' => LarkSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a specific chat.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'lark_list_members' => [
                'class' => LarkListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a specific chat.',
                'icon' => 'ph:users',
            ],
            'lark_get_current_user' => [
                'class' => LarkGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get information about the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lark.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://open.larksuite.com'],
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

            $service = new LarkService(
                accessToken: $creds->get('lark', 'access_token', '', $account),
                baseUrl: $creds->get('lark', 'url', 'https://open.larksuite.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(LarkService::class));
    }
}
