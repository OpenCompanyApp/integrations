<?php

namespace OpenCompany\Integrations\Telegram;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetMe;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetUpdates;
use OpenCompany\Integrations\Telegram\Tools\TelegramGetChat;
use OpenCompany\Integrations\Telegram\Tools\TelegramListChats;
use OpenCompany\Integrations\Telegram\Tools\TelegramSendMessage;
use OpenCompany\Integrations\Telegram\Tools\TelegramSendPhoto;

/**
 * Tool provider for the Telegram Bot API integration.
 *
 * Implements ConfigurableIntegration for multi-account support and
 * provides 6 tools for interacting with the Telegram Bot API.
 */
class TelegramToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the integration app name identifier.
     */
    public function appName(): string
    {
        return 'telegram';
    }

    /**
     * Get metadata for app-level display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'send message, send photo, get updates, get chat, list chats, get me',
            'description' => 'Messaging & communication',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:telegram',
        ];
    }

    /**
     * Get metadata for the integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Telegram Bot',
            'description' => 'Send messages and photos, manage chats via Telegram Bot API',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:telegram',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://core.telegram.org/bots/api',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'bot_token',
                'type' => 'secret',
                'label' => 'Bot Token',
                'placeholder' => 'Enter your Telegram Bot token',
                'hint' => 'Get a token from <a href="https://t.me/BotFather" target="_blank">@BotFather</a> by creating a new bot or selecting an existing one',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.telegram.org',
                'hint' => 'Use <code>https://api.telegram.org</code> for the public API, or your local Bot API server URL',
                'default' => 'https://api.telegram.org',
            ],
        ];
    }

    /**
     * Test the connection to the Telegram Bot API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $botToken = $config['bot_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.telegram.org', '/');

        if (empty($botToken)) {
            return ['success' => false, 'error' => 'No Bot token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/bot' . $botToken . '/getMe');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Telegram API at {$baseUrl}. Check the URL.",
                ];
            }

            if (isset($json['ok']) && $json['ok'] === true) {
                $botName = $json['result']['first_name'] ?? 'Bot';
                $username = $json['result']['username'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected as @{$username} ({$botName}).",
                ];
            }

            $error = $json['description'] ?? 'Unknown error';

            return ['success' => false, 'error' => "Telegram API error: {$error}"];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'bot_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
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
            'telegram_send_photo' => [
                'class' => TelegramSendPhoto::class,
                'type' => 'write',
                'name' => 'Send Photo',
                'description' => 'Send a photo to a Telegram chat.',
                'icon' => 'ph:image',
            ],
            'telegram_get_updates' => [
                'class' => TelegramGetUpdates::class,
                'type' => 'read',
                'name' => 'Get Updates',
                'description' => 'Get incoming updates (messages, callbacks, etc.) for the bot.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'telegram_list_chats' => [
                'class' => TelegramListChats::class,
                'type' => 'read',
                'name' => 'List Chats',
                'description' => 'List chats the bot has interacted with (derived from updates).',
                'icon' => 'ph:chats',
            ],
            'telegram_get_chat' => [
                'class' => TelegramGetChat::class,
                'type' => 'read',
                'name' => 'Get Chat',
                'description' => 'Get information about a specific chat.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'telegram_get_me' => [
                'class' => TelegramGetMe::class,
                'type' => 'read',
                'name' => 'Get Bot Info',
                'description' => 'Get information about the authenticated bot.',
                'icon' => 'ph:robot',
            ],
        ];
    }

    /**
     * Get the path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/telegram.md';
    }

    /**
     * Get the credential fields for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'bot_token', 'type' => 'secret', 'label' => 'Bot Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.telegram.org'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Context containing optional 'account' for multi-account support
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TelegramService(
                botToken: $creds->get('telegram', 'bot_token', '', $account),
                baseUrl: $creds->get('telegram', 'url', 'https://api.telegram.org', $account),
            );

            return new $class($service);
        }

        return new $class(app(TelegramService::class));
    }
}
