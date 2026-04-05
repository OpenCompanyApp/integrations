<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Discord\Tools\DiscordAddMemberRole;
use OpenCompany\Integrations\Discord\Tools\DiscordAddReaction;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordGetChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordGetCurrentUser;
use OpenCompany\Integrations\Discord\Tools\DiscordGetGuild;
use OpenCompany\Integrations\Discord\Tools\DiscordGetMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordGetMessages;
use OpenCompany\Integrations\Discord\Tools\DiscordGetUser;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildChannels;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildMembers;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildRoles;
use OpenCompany\Integrations\Discord\Tools\DiscordModifyGuildMember;
use OpenCompany\Integrations\Discord\Tools\DiscordRemoveMemberRole;
use OpenCompany\Integrations\Discord\Tools\DiscordSendMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordSendWebhook;
use OpenCompany\Integrations\Discord\Tools\DiscordUpdateChannel;

/**
 * Registers all Discord tools and provides integration metadata.
 *
 * Exposes 18 tools covering messages, channels, guilds, members,
 * roles, reactions, users, and webhooks via the ToolProvider contract.
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
            'label' => 'messages, channels, guilds, members',
            'description' => 'Messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:discord',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Discord',
            'description' => 'Messages, channels, guilds, members, and roles',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:discord',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://discord.com/developers/docs/reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'bot_token',
                'type' => 'secret',
                'label' => 'Bot Token',
                'placeholder' => 'Bot token...',
                'hint' => 'Discord Bot Token from the Bot page of your application in the Developer Portal.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Discord connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'bot_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $botToken = $config['bot_token'] ?? '';

        if (empty($botToken)) {
            return ['success' => false, 'error' => 'No bot token provided. Generate one in the Discord Developer Portal.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bot ' . $botToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://discord.com/api/v10/users/@me');

            $body = $response->json() ?? [];

            if ($response->successful()) {
                $username = $body['username'] ?? 'Unknown';
                $discriminator = $body['discriminator'] ?? '0';

                return [
                    'success' => true,
                    'message' => "Connected to Discord as {$username}#{$discriminator}.",
                ];
            }

            $message = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Discord API error: ' . (is_string($message) ? $message : json_encode($message)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'bot_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Messages
            'discord_send_message' => [
                'class' => DiscordSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a Discord channel.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'discord_get_messages' => [
                'class' => DiscordGetMessages::class,
                'type' => 'read',
                'name' => 'Get Messages',
                'description' => 'Get messages from a Discord channel.',
                'icon' => 'ph:list-bullets',
            ],
            'discord_get_message' => [
                'class' => DiscordGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get a single Discord message by ID.',
                'icon' => 'ph:chat-circle-text',
            ],
            'discord_delete_message' => [
                'class' => DiscordDeleteMessage::class,
                'type' => 'write',
                'name' => 'Delete Message',
                'description' => 'Delete a Discord message.',
                'icon' => 'ph:trash',
            ],
            // Channels
            'discord_get_channel' => [
                'class' => DiscordGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get information about a Discord channel.',
                'icon' => 'ph:hash-straight',
            ],
            'discord_create_channel' => [
                'class' => DiscordCreateChannel::class,
                'type' => 'write',
                'name' => 'Create Channel',
                'description' => 'Create a channel in a Discord guild.',
                'icon' => 'ph:plus-circle',
            ],
            'discord_update_channel' => [
                'class' => DiscordUpdateChannel::class,
                'type' => 'write',
                'name' => 'Update Channel',
                'description' => 'Update a Discord channel\'s properties.',
                'icon' => 'ph:pencil-simple',
            ],
            'discord_list_guild_channels' => [
                'class' => DiscordListGuildChannels::class,
                'type' => 'read',
                'name' => 'List Guild Channels',
                'description' => 'List all channels in a Discord guild.',
                'icon' => 'ph:hash',
            ],
            // Guilds
            'discord_get_guild' => [
                'class' => DiscordGetGuild::class,
                'type' => 'read',
                'name' => 'Get Guild',
                'description' => 'Get information about a Discord guild.',
                'icon' => 'ph:buildings',
            ],
            'discord_list_guild_members' => [
                'class' => DiscordListGuildMembers::class,
                'type' => 'read',
                'name' => 'List Guild Members',
                'description' => 'List members of a Discord guild.',
                'icon' => 'ph:users',
            ],
            'discord_add_member_role' => [
                'class' => DiscordAddMemberRole::class,
                'type' => 'write',
                'name' => 'Add Member Role',
                'description' => 'Add a role to a guild member.',
                'icon' => 'ph:user-plus',
            ],
            'discord_remove_member_role' => [
                'class' => DiscordRemoveMemberRole::class,
                'type' => 'write',
                'name' => 'Remove Member Role',
                'description' => 'Remove a role from a guild member.',
                'icon' => 'ph:user-minus',
            ],
            'discord_list_guild_roles' => [
                'class' => DiscordListGuildRoles::class,
                'type' => 'read',
                'name' => 'List Guild Roles',
                'description' => 'List all roles in a Discord guild.',
                'icon' => 'ph:shield-check',
            ],
            // Reactions & Users
            'discord_add_reaction' => [
                'class' => DiscordAddReaction::class,
                'type' => 'write',
                'name' => 'Add Reaction',
                'description' => 'Add an emoji reaction to a message.',
                'icon' => 'ph:smiley',
            ],
            'discord_get_user' => [
                'class' => DiscordGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a Discord user by ID.',
                'icon' => 'ph:user',
            ],
            'discord_get_current_user' => [
                'class' => DiscordGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current bot user.',
                'icon' => 'ph:robot',
            ],
            'discord_modify_guild_member' => [
                'class' => DiscordModifyGuildMember::class,
                'type' => 'write',
                'name' => 'Modify Guild Member',
                'description' => 'Modify a guild member\'s properties.',
                'icon' => 'ph:user-gear',
            ],
            // Webhooks
            'discord_send_webhook' => [
                'class' => DiscordSendWebhook::class,
                'type' => 'write',
                'name' => 'Send Webhook',
                'description' => 'Execute a Discord webhook to send a message.',
                'icon' => 'ph:webhook',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/discord.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'bot_token', 'type' => 'secret', 'label' => 'Bot Token', 'required' => true],
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
                botToken: $creds->get('discord', 'bot_token', '', $account),
            );
        }

        return app(DiscordService::class);
    }
}
