<?php

namespace OpenCompany\Integrations\Line;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Line\Tools\LineSendMessage;
use OpenCompany\Integrations\Line\Tools\LineBroadcastMessage;
use OpenCompany\Integrations\Line\Tools\LineGetProfile;
use OpenCompany\Integrations\Line\Tools\LineListFriends;
use OpenCompany\Integrations\Line\Tools\LineGetCurrentUser;

class LineToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'line';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'message, broadcast, profile, friends',
            'description' => 'LINE Messaging',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:line',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'LINE Messaging',
            'description' => 'Send messages, broadcast announcements, and manage contacts via the LINE Messaging API',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:line',
            'category' => 'messaging',
            'badge' => 'verified',
            'docs_url' => 'https://developers.line.biz/en/docs/messaging-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Channel Access Token',
                'placeholder' => 'Enter your LINE channel access token',
                'hint' => 'Issue a long-lived channel access token in the LINE Developers Console under your Messaging API channel settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.line.me/v2',
                'hint' => 'Use the default LINE API URL. Only change if targeting a different environment.',
                'default' => 'https://api.line.me/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.line.me/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No channel access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/bot/info');

            if ($response->successful()) {
                $botInfo = $response->json();
                $displayName = $botInfo['displayName'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to LINE as \"{$displayName}\".",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => "LINE API returned an error: " . (is_string($error) ? $error : json_encode($error)),
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
            'line_send_message' => [
                'class' => LineSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a push message to a specific LINE user or group.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'line_broadcast_message' => [
                'class' => LineBroadcastMessage::class,
                'type' => 'write',
                'name' => 'Broadcast Message',
                'description' => 'Broadcast a message to all friends of the LINE Official Account.',
                'icon' => 'ph:megaphone',
            ],
            'line_get_profile' => [
                'class' => LineGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get the profile of a LINE user.',
                'icon' => 'ph:user-circle',
            ],
            'line_list_friends' => [
                'class' => LineListFriends::class,
                'type' => 'read',
                'name' => 'List Friends',
                'description' => 'List friends (followers) of the LINE Official Account.',
                'icon' => 'ph:users',
            ],
            'line_get_current_user' => [
                'class' => LineGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Bot Info',
                'description' => 'Get the profile of the LINE Official Account (bot info).',
                'icon' => 'ph:bot',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/line.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Channel Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.line.me/v2'],
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

            $service = new LineService(
                accessToken: $creds->get('line', 'access_token', '', $account),
                baseUrl: $creds->get('line', 'url', 'https://api.line.me/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(LineService::class));
    }
}
