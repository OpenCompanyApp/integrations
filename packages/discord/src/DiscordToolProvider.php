<?php

namespace OpenCompany\Integrations\Discord;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Discord\Tools\DiscordAddGuildMemberRole;
use OpenCompany\Integrations\Discord\Tools\DiscordApiDelete;
use OpenCompany\Integrations\Discord\Tools\DiscordApiGet;
use OpenCompany\Integrations\Discord\Tools\DiscordApiPatch;
use OpenCompany\Integrations\Discord\Tools\DiscordApiPost;
use OpenCompany\Integrations\Discord\Tools\DiscordApiPut;
use OpenCompany\Integrations\Discord\Tools\DiscordBulkDeleteMessages;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateChannelInvite;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateGuildBan;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateGuildChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateGuildRole;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateReaction;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateWebhook;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteGuildRole;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteInvite;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteOwnReaction;
use OpenCompany\Integrations\Discord\Tools\DiscordDeleteWebhook;
use OpenCompany\Integrations\Discord\Tools\DiscordEditChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordEditChannelPositions;
use OpenCompany\Integrations\Discord\Tools\DiscordEditGuildMember;
use OpenCompany\Integrations\Discord\Tools\DiscordEditGuildRole;
use OpenCompany\Integrations\Discord\Tools\DiscordEditMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordEditWebhook;
use OpenCompany\Integrations\Discord\Tools\DiscordGetChannel;
use OpenCompany\Integrations\Discord\Tools\DiscordGetCurrentUser;
use OpenCompany\Integrations\Discord\Tools\DiscordGetGuild;
use OpenCompany\Integrations\Discord\Tools\DiscordGetGuildMember;
use OpenCompany\Integrations\Discord\Tools\DiscordGetInvite;
use OpenCompany\Integrations\Discord\Tools\DiscordGetMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordGetWebhook;
use OpenCompany\Integrations\Discord\Tools\DiscordKickGuildMember;
use OpenCompany\Integrations\Discord\Tools\DiscordListChannelWebhooks;
use OpenCompany\Integrations\Discord\Tools\DiscordListChannels;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildBans;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildInvites;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildMembers;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildRoles;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildWebhooks;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuilds;
use OpenCompany\Integrations\Discord\Tools\DiscordListMessages;
use OpenCompany\Integrations\Discord\Tools\DiscordListPinnedMessages;
use OpenCompany\Integrations\Discord\Tools\DiscordListReactionUsers;
use OpenCompany\Integrations\Discord\Tools\DiscordPinMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordRemoveGuildBan;
use OpenCompany\Integrations\Discord\Tools\DiscordRemoveGuildMemberRole;
use OpenCompany\Integrations\Discord\Tools\DiscordSendMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordUnpinMessage;

/**
 * Tool catalog and setup metadata for the Discord integration.
 *
 * Exposes first-class Discord REST v10 tools for common channel, message, guild,
 * moderation, invite, webhook, and role workflows, with raw helpers for long-tail endpoints.
 */
class DiscordToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'bearer_or_bot_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token', 'token_type'],
                'notes' => ['Use token_type=Bot for Discord bot tokens and Bearer for OAuth access tokens.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'discord';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Discord',
            'description' => 'Messaging, community, moderation, invites, roles, and webhooks',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:discord',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Discord',
            'description' => 'Discord REST v10 tools for channels, messages, guilds, members, roles, bans, invites, webhooks, and raw API calls.',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Discord OAuth or bot token', 'hint' => 'Use the token value without the Bearer or Bot prefix.', 'required' => true],
            ['key' => 'token_type', 'type' => 'select', 'label' => 'Token Type', 'options' => ['Bearer', 'Bot'], 'default' => 'Bearer', 'hint' => 'Use Bot for Discord bot tokens.'],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://discord.com/api/v10', 'hint' => 'Override only if using a compatible proxy.', 'default' => 'https://discord.com/api/v10'],
        ];
    }

    /**
     * Verify Discord credentials with the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['base_url'] ?? 'https://discord.com/api/v10'), '/');
        $tokenType = $this->normalizeTokenType((string) ($config['token_type'] ?? 'Bearer'));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $tokenType.' '.$accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/users/@me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $username = $data['username'] ?? $data['global_name'] ?? 'Unknown';

                return ['success' => true, 'message' => "Connected to Discord as {$username}."];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return ['success' => false, 'error' => 'Discord API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error))];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'token_type' => 'nullable|in:Bearer,Bot',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'discord_api_get' => ['class' => DiscordApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Execute a raw Discord API GET request.', 'icon' => 'ph:brackets-curly'],
            'discord_api_post' => ['class' => DiscordApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Execute a raw Discord API POST request.', 'icon' => 'ph:brackets-curly'],
            'discord_api_patch' => ['class' => DiscordApiPatch::class, 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Execute a raw Discord API PATCH request.', 'icon' => 'ph:brackets-curly'],
            'discord_api_put' => ['class' => DiscordApiPut::class, 'type' => 'write', 'name' => 'API PUT', 'description' => 'Execute a raw Discord API PUT request.', 'icon' => 'ph:brackets-curly'],
            'discord_api_delete' => ['class' => DiscordApiDelete::class, 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Execute a raw Discord API DELETE request.', 'icon' => 'ph:brackets-curly'],

            'discord_list_guilds' => ['class' => DiscordListGuilds::class, 'type' => 'read', 'name' => 'List Guilds', 'description' => 'List guilds the current user is in.', 'icon' => 'ph:buildings'],
            'discord_get_guild' => ['class' => DiscordGetGuild::class, 'type' => 'read', 'name' => 'Get Guild', 'description' => 'Get information about a Discord guild.', 'icon' => 'ph:buildings'],
            'discord_list_channels' => ['class' => DiscordListChannels::class, 'type' => 'read', 'name' => 'List Channels', 'description' => 'List all channels in a Discord guild.', 'icon' => 'ph:hash'],
            'discord_create_guild_channel' => ['class' => DiscordCreateGuildChannel::class, 'type' => 'write', 'name' => 'Create Guild Channel', 'description' => 'Create a channel in a Discord guild.', 'icon' => 'ph:plus-circle'],
            'discord_get_channel' => ['class' => DiscordGetChannel::class, 'type' => 'read', 'name' => 'Get Channel', 'description' => 'Get information about a Discord channel.', 'icon' => 'ph:hash-straight'],
            'discord_edit_channel' => ['class' => DiscordEditChannel::class, 'type' => 'write', 'name' => 'Edit Channel', 'description' => 'Edit a Discord channel.', 'icon' => 'ph:pencil-simple'],
            'discord_delete_channel' => ['class' => DiscordDeleteChannel::class, 'type' => 'write', 'name' => 'Delete Channel', 'description' => 'Delete a Discord guild channel or close a DM.', 'icon' => 'ph:trash'],
            'discord_edit_channel_positions' => ['class' => DiscordEditChannelPositions::class, 'type' => 'write', 'name' => 'Edit Channel Positions', 'description' => 'Modify Discord guild channel positions.', 'icon' => 'ph:arrows-down-up'],

            'discord_list_messages' => ['class' => DiscordListMessages::class, 'type' => 'read', 'name' => 'List Messages', 'description' => 'Get messages from a Discord channel.', 'icon' => 'ph:list-bullets'],
            'discord_send_message' => ['class' => DiscordSendMessage::class, 'type' => 'write', 'name' => 'Send Message', 'description' => 'Send a message to a Discord channel.', 'icon' => 'ph:paper-plane-tilt'],
            'discord_get_message' => ['class' => DiscordGetMessage::class, 'type' => 'read', 'name' => 'Get Message', 'description' => 'Get one Discord message.', 'icon' => 'ph:chat-text'],
            'discord_edit_message' => ['class' => DiscordEditMessage::class, 'type' => 'write', 'name' => 'Edit Message', 'description' => 'Edit a Discord message.', 'icon' => 'ph:pencil-simple'],
            'discord_delete_message' => ['class' => DiscordDeleteMessage::class, 'type' => 'write', 'name' => 'Delete Message', 'description' => 'Delete a Discord message.', 'icon' => 'ph:trash'],
            'discord_bulk_delete_messages' => ['class' => DiscordBulkDeleteMessages::class, 'type' => 'write', 'name' => 'Bulk Delete Messages', 'description' => 'Bulk delete Discord messages.', 'icon' => 'ph:trash-simple'],
            'discord_list_pinned_messages' => ['class' => DiscordListPinnedMessages::class, 'type' => 'read', 'name' => 'List Pinned Messages', 'description' => 'List pinned messages in a Discord channel.', 'icon' => 'ph:push-pin'],
            'discord_pin_message' => ['class' => DiscordPinMessage::class, 'type' => 'write', 'name' => 'Pin Message', 'description' => 'Pin a Discord message.', 'icon' => 'ph:push-pin'],
            'discord_unpin_message' => ['class' => DiscordUnpinMessage::class, 'type' => 'write', 'name' => 'Unpin Message', 'description' => 'Unpin a Discord message.', 'icon' => 'ph:push-pin-simple-slash'],
            'discord_create_reaction' => ['class' => DiscordCreateReaction::class, 'type' => 'write', 'name' => 'Create Reaction', 'description' => 'Add a reaction to a Discord message.', 'icon' => 'ph:smiley'],
            'discord_delete_own_reaction' => ['class' => DiscordDeleteOwnReaction::class, 'type' => 'write', 'name' => 'Delete Own Reaction', 'description' => 'Delete the current user reaction from a Discord message.', 'icon' => 'ph:smiley-x-eyes'],
            'discord_list_reaction_users' => ['class' => DiscordListReactionUsers::class, 'type' => 'read', 'name' => 'List Reaction Users', 'description' => 'List users who reacted with an emoji.', 'icon' => 'ph:users'],

            'discord_list_guild_members' => ['class' => DiscordListGuildMembers::class, 'type' => 'read', 'name' => 'List Guild Members', 'description' => 'List members in a Discord guild.', 'icon' => 'ph:users'],
            'discord_get_guild_member' => ['class' => DiscordGetGuildMember::class, 'type' => 'read', 'name' => 'Get Guild Member', 'description' => 'Get a Discord guild member.', 'icon' => 'ph:user'],
            'discord_edit_guild_member' => ['class' => DiscordEditGuildMember::class, 'type' => 'write', 'name' => 'Edit Guild Member', 'description' => 'Edit a Discord guild member.', 'icon' => 'ph:user-gear'],
            'discord_kick_guild_member' => ['class' => DiscordKickGuildMember::class, 'type' => 'write', 'name' => 'Kick Guild Member', 'description' => 'Kick a member from a Discord guild.', 'icon' => 'ph:user-minus'],
            'discord_add_guild_member_role' => ['class' => DiscordAddGuildMemberRole::class, 'type' => 'write', 'name' => 'Add Member Role', 'description' => 'Add a role to a Discord guild member.', 'icon' => 'ph:identification-badge'],
            'discord_remove_guild_member_role' => ['class' => DiscordRemoveGuildMemberRole::class, 'type' => 'write', 'name' => 'Remove Member Role', 'description' => 'Remove a role from a Discord guild member.', 'icon' => 'ph:identification-card'],
            'discord_list_guild_roles' => ['class' => DiscordListGuildRoles::class, 'type' => 'read', 'name' => 'List Guild Roles', 'description' => 'List roles in a Discord guild.', 'icon' => 'ph:identification-badge'],
            'discord_create_guild_role' => ['class' => DiscordCreateGuildRole::class, 'type' => 'write', 'name' => 'Create Guild Role', 'description' => 'Create a Discord guild role.', 'icon' => 'ph:plus-circle'],
            'discord_edit_guild_role' => ['class' => DiscordEditGuildRole::class, 'type' => 'write', 'name' => 'Edit Guild Role', 'description' => 'Edit a Discord guild role.', 'icon' => 'ph:pencil-simple'],
            'discord_delete_guild_role' => ['class' => DiscordDeleteGuildRole::class, 'type' => 'write', 'name' => 'Delete Guild Role', 'description' => 'Delete a Discord guild role.', 'icon' => 'ph:trash'],

            'discord_list_guild_bans' => ['class' => DiscordListGuildBans::class, 'type' => 'read', 'name' => 'List Guild Bans', 'description' => 'List bans in a Discord guild.', 'icon' => 'ph:shield-warning'],
            'discord_create_guild_ban' => ['class' => DiscordCreateGuildBan::class, 'type' => 'write', 'name' => 'Create Guild Ban', 'description' => 'Ban a user from a Discord guild.', 'icon' => 'ph:shield-x'],
            'discord_remove_guild_ban' => ['class' => DiscordRemoveGuildBan::class, 'type' => 'write', 'name' => 'Remove Guild Ban', 'description' => 'Remove a ban from a Discord guild.', 'icon' => 'ph:shield-check'],
            'discord_list_guild_invites' => ['class' => DiscordListGuildInvites::class, 'type' => 'read', 'name' => 'List Guild Invites', 'description' => 'List invites for a Discord guild.', 'icon' => 'ph:link'],
            'discord_create_channel_invite' => ['class' => DiscordCreateChannelInvite::class, 'type' => 'write', 'name' => 'Create Channel Invite', 'description' => 'Create a Discord channel invite.', 'icon' => 'ph:link-simple-horizontal'],
            'discord_get_invite' => ['class' => DiscordGetInvite::class, 'type' => 'read', 'name' => 'Get Invite', 'description' => 'Get a Discord invite.', 'icon' => 'ph:link'],
            'discord_delete_invite' => ['class' => DiscordDeleteInvite::class, 'type' => 'write', 'name' => 'Delete Invite', 'description' => 'Delete a Discord invite.', 'icon' => 'ph:link-break'],

            'discord_list_channel_webhooks' => ['class' => DiscordListChannelWebhooks::class, 'type' => 'read', 'name' => 'List Channel Webhooks', 'description' => 'List webhooks for a Discord channel.', 'icon' => 'ph:webhooks-logo'],
            'discord_list_guild_webhooks' => ['class' => DiscordListGuildWebhooks::class, 'type' => 'read', 'name' => 'List Guild Webhooks', 'description' => 'List webhooks for a Discord guild.', 'icon' => 'ph:webhooks-logo'],
            'discord_create_webhook' => ['class' => DiscordCreateWebhook::class, 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a Discord webhook.', 'icon' => 'ph:plus-circle'],
            'discord_get_webhook' => ['class' => DiscordGetWebhook::class, 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Get a Discord webhook.', 'icon' => 'ph:webhooks-logo'],
            'discord_edit_webhook' => ['class' => DiscordEditWebhook::class, 'type' => 'write', 'name' => 'Edit Webhook', 'description' => 'Edit a Discord webhook.', 'icon' => 'ph:pencil-simple'],
            'discord_delete_webhook' => ['class' => DiscordDeleteWebhook::class, 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a Discord webhook.', 'icon' => 'ph:trash'],

            'discord_get_current_user' => ['class' => DiscordGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the currently authenticated Discord user.', 'icon' => 'ph:user-circle'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__).'/script-docs/discord.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Discord tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): DiscordService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DiscordService(
                accessToken: $creds->get('discord', 'access_token', '', $account),
                baseUrl: $creds->get('discord', 'base_url', 'https://discord.com/api/v10', $account),
                authScheme: $this->normalizeTokenType((string) $creds->get('discord', 'token_type', 'Bearer', $account)),
            );
        }

        return app(DiscordService::class);
    }

    /**
     * Normalize Discord token type configuration.
     */
    private function normalizeTokenType(string $tokenType): string
    {
        return strtolower(trim($tokenType)) === 'bot' ? 'Bot' : 'Bearer';
    }
}
