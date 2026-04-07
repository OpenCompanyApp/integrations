<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Discord\Tools\DiscordListChannels;
use OpenCompany\Integrations\Discord\Tools\DiscordGetChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordSendMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordListMessages;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuilds;
use OpenCompany\Integrations\Discord\Tools\DiscordGetGuild;
use OpenCompany\Integrations\Discord\Tools\DiscordGetCurrentUser;

/**
 * Registers all Discord tools and provides integration metadata, configuration schema, and connection testing.
 */
class DiscordToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'discord';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'messages, channels, guilds',
            'description' => 'Messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:discord',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Discord',
            'description' => 'Messaging platform – channels, messages, guilds, and users',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:discord',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://discord.com/developers/docs/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'dG9rZW4...',
                'hint' => 'Discord access token for API authentication.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://discord.com/api/v10',
                'hint' => 'Override only if using a custom Discord API endpoint. Defaults to <code>https://discord.com/api/v10</code>.',
                'default' => 'https://discord.com/api/v10',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://discord.com/api/v10', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/@me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $username = $data['username'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Discord as {$username}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Discord API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Channels
            'discord_list_channels' => [
                'class' => DiscordListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List all channels in a Discord guild.',
                'icon' => 'ph:hash',
            ],
            'discord_get_channel' => [
                'class' => DiscordGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get information about a Discord channel.',
                'icon' => 'ph:hash-straight',
            ],
            // Messages
            'discord_send_message' => [
                'class' => DiscordSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a Discord channel.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'discord_list_messages' => [
                'class' => DiscordListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'Get messages from a Discord channel.',
                'icon' => 'ph:list-bullets',
            ],
            // Guilds
            'discord_list_guilds' => [
                'class' => DiscordListGuilds::class,
                'type' => 'read',
                'name' => 'List Guilds',
                'description' => 'List guilds the current user is in.',
                'icon' => 'ph:buildings',
            ],
            'discord_get_guild' => [
                'class' => DiscordGetGuild::class,
                'type' => 'read',
                'name' => 'Get Guild',
                'description' => 'Get information about a Discord guild.',
                'icon' => 'ph:buildings',
            ],
            // Users
            'discord_get_current_user' => [
                'class' => DiscordGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Discord user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/discord.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://discord.com/api/v10'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the DiscordService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): DiscordService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new DiscordService(
                accessToken: $creds->get('discord', 'access_token', '', $account),
                baseUrl: $creds->get('discord', 'base_url', 'https://discord.com/api/v10', $account),
            );
        }

        return app(DiscordService::class);
    }
}
