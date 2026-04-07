<?php

namespace OpenCompany\Integrations\Telegram;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Telegram\Tools\TelegramSendMessage;
use OpenCompany\Integrations\Telegram\Tools\TelegramListUpdates;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetMe;
use OpenCompany\Integrations\Telegram\Tools\TelegramListChats;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetChat;
use OpenCompany\Integrations\Telegram\Tools\TelegramSendPhoto;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetCurrentUser;

class TelegramToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'telegram';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'messages, photos, chats, updates',
            'description' => 'Bot messaging and communication',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:telegram',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Telegram',
            'description' => 'Cloud-based messaging and communication platform with Bot API support',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:telegram',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://core.telegram.org/bots/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Bot Token',
                'placeholder' => 'Enter your Telegram bot token',
                'hint' => 'Get a bot token by messaging @BotFather on Telegram and creating a new bot',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.telegram.org',
                'hint' => 'The base URL for the Telegram Bot API (leave default unless using a custom API server)',
                'default' => 'https://api.telegram.org',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.telegram.org', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No bot token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/bot' . $accessToken . '/getMe');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Telegram API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!isset($json['ok']) || $json['ok'] !== true) {
                $error = $json['description'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Telegram API error: {$error}",
                ];
            }

            $botUsername = $json['result']['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Telegram as @{$botUsername}.",
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
            'telegram_send_message' => [
                'class' => TelegramSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a text message to a Telegram chat.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'telegram_list_updates' => [
                'class' => TelegramListUpdates::class,
                'type' => 'read',
                'name' => 'List Updates',
                'description' => 'Get incoming updates (messages, callbacks, etc.) for the bot.',
                'icon' => 'ph:arrows-down-up',
            ],
            'telegram_get_me' => [
                'class' => TelegramGetMe::class,
                'type' => 'read',
                'name' => 'Get Bot Info',
                'description' => 'Get information about the authenticated bot.',
                'icon' => 'ph:robot',
            ],
            'telegram_list_chats' => [
                'class' => TelegramListChats::class,
                'type' => 'read',
                'name' => 'List Chats',
                'description' => 'List recent chats the bot has interacted with from recent updates.',
                'icon' => 'ph:chats',
            ],
            'telegram_get_chat' => [
                'class' => TelegramGetChat::class,
                'type' => 'read',
                'name' => 'Get Chat',
                'description' => 'Get information about a specific Telegram chat.',
                'icon' => 'ph:chat-circle-text',
            ],
            'telegram_send_photo' => [
                'class' => TelegramSendPhoto::class,
                'type' => 'write',
                'name' => 'Send Photo',
                'description' => 'Send a photo to a Telegram chat.',
                'icon' => 'ph:image',
            ],
            'telegram_get_current_user' => [
                'class' => TelegramGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated bot user profile.',
                'icon' => 'ph:robot',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/telegram.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Bot Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.telegram.org'],
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

            $service = new TelegramService(
                accessToken: $creds->get('telegram', 'access_token', '', $account),
                baseUrl: $creds->get('telegram', 'url', 'https://api.telegram.org', $account),
            );

            return new $class($service);
        }

        return new $class(app(TelegramService::class));
    }
}
