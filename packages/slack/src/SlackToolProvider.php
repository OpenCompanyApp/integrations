<?php

namespace OpenCompany\Integrations\Slack;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Slack\Tools\SlackAddReaction;
use OpenCompany\Integrations\Slack\Tools\SlackArchiveChannel;
use OpenCompany\Integrations\Slack\Tools\SlackCreateChannel;
use OpenCompany\Integrations\Slack\Tools\SlackDeleteMessage;
use OpenCompany\Integrations\Slack\Tools\SlackFindUserByEmail;
use OpenCompany\Integrations\Slack\Tools\SlackGetChannel;
use OpenCompany\Integrations\Slack\Tools\SlackGetChannelHistory;
use OpenCompany\Integrations\Slack\Tools\SlackGetFile;
use OpenCompany\Integrations\Slack\Tools\SlackGetMessage;
use OpenCompany\Integrations\Slack\Tools\SlackGetPermalink;
use OpenCompany\Integrations\Slack\Tools\SlackGetThreadReplies;
use OpenCompany\Integrations\Slack\Tools\SlackGetUser;
use OpenCompany\Integrations\Slack\Tools\SlackInviteToChannel;
use OpenCompany\Integrations\Slack\Tools\SlackListChannels;
use OpenCompany\Integrations\Slack\Tools\SlackListFiles;
use OpenCompany\Integrations\Slack\Tools\SlackListUsergroups;
use OpenCompany\Integrations\Slack\Tools\SlackListUsers;
use OpenCompany\Integrations\Slack\Tools\SlackRemoveReaction;
use OpenCompany\Integrations\Slack\Tools\SlackSearchMessages;
use OpenCompany\Integrations\Slack\Tools\SlackSendMessage;
use OpenCompany\Integrations\Slack\Tools\SlackSetPurpose;
use OpenCompany\Integrations\Slack\Tools\SlackSetTopic;
use OpenCompany\Integrations\Slack\Tools\SlackUpdateMessage;
use OpenCompany\Integrations\Slack\Tools\SlackUpdateUsergroupMembers;
use OpenCompany\Integrations\Slack\Tools\SlackUploadFile;

/**
 * Registers all Slack tools and provides integration metadata.
 *
 * Exposes 25 tools covering messages, channels, files, users,
 * reactions, and usergroups via the ToolProvider contract.
 */
class SlackToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'slack';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'messages, channels, files, users',
            'description' => 'Messaging',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:slack',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Slack',
            'description' => 'Messages, channels, files, users, and reactions',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:slack',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.slack.com/methods',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'bot_token',
                'type' => 'secret',
                'label' => 'Bot Token',
                'placeholder' => 'xoxb-...',
                'hint' => 'Bot User OAuth Token from your Slack app. Starts with <code>xoxb-</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Slack connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'bot_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $botToken = $config['bot_token'] ?? '';

        if (empty($botToken)) {
            return ['success' => false, 'error' => 'No bot token provided. Generate one in your Slack app settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $botToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://slack.com/api/auth.test');

            $body = $response->json() ?? [];

            if ($body['ok'] ?? false) {
                $bot = $body['user'] ?? 'Unknown';
                $team = $body['team'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Slack as @{$bot} on workspace {$team}.",
                ];
            }

            $error = $body['error'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Slack API error: ' . (is_string($error) ? $error : json_encode($error)),
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
            'slack_send_message' => [
                'class' => SlackSendMessage::class,
                'type' => 'write',
                'name' => 'Send Message',
                'description' => 'Send a message to a Slack channel or DM.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'slack_update_message' => [
                'class' => SlackUpdateMessage::class,
                'type' => 'write',
                'name' => 'Update Message',
                'description' => 'Update an existing Slack message.',
                'icon' => 'ph:pencil-simple',
            ],
            'slack_delete_message' => [
                'class' => SlackDeleteMessage::class,
                'type' => 'write',
                'name' => 'Delete Message',
                'description' => 'Delete a Slack message.',
                'icon' => 'ph:trash',
            ],
            'slack_get_message' => [
                'class' => SlackGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get a specific message by timestamp.',
                'icon' => 'ph:chat-circle-text',
            ],
            'slack_search_messages' => [
                'class' => SlackSearchMessages::class,
                'type' => 'read',
                'name' => 'Search Messages',
                'description' => 'Search for messages across Slack.',
                'icon' => 'ph:magnifying-glass',
            ],
            'slack_get_permalink' => [
                'class' => SlackGetPermalink::class,
                'type' => 'read',
                'name' => 'Get Permalink',
                'description' => 'Get a permalink for a message.',
                'icon' => 'ph:link',
            ],
            'slack_get_channel_history' => [
                'class' => SlackGetChannelHistory::class,
                'type' => 'read',
                'name' => 'Get Channel History',
                'description' => 'Get message history for a channel.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'slack_get_thread_replies' => [
                'class' => SlackGetThreadReplies::class,
                'type' => 'read',
                'name' => 'Get Thread Replies',
                'description' => 'Get replies in a message thread.',
                'icon' => 'ph:chat-circle-dots',
            ],
            // Channels
            'slack_list_channels' => [
                'class' => SlackListChannels::class,
                'type' => 'read',
                'name' => 'List Channels',
                'description' => 'List all Slack channels.',
                'icon' => 'ph:hash',
            ],
            'slack_get_channel' => [
                'class' => SlackGetChannel::class,
                'type' => 'read',
                'name' => 'Get Channel',
                'description' => 'Get channel info.',
                'icon' => 'ph:hash-straight',
            ],
            'slack_create_channel' => [
                'class' => SlackCreateChannel::class,
                'type' => 'write',
                'name' => 'Create Channel',
                'description' => 'Create a new Slack channel.',
                'icon' => 'ph:plus-circle',
            ],
            'slack_set_topic' => [
                'class' => SlackSetTopic::class,
                'type' => 'write',
                'name' => 'Set Topic',
                'description' => 'Set a channel topic.',
                'icon' => 'ph:text-aa',
            ],
            'slack_set_purpose' => [
                'class' => SlackSetPurpose::class,
                'type' => 'write',
                'name' => 'Set Purpose',
                'description' => 'Set a channel purpose.',
                'icon' => 'ph:target',
            ],
            'slack_archive_channel' => [
                'class' => SlackArchiveChannel::class,
                'type' => 'write',
                'name' => 'Archive Channel',
                'description' => 'Archive a Slack channel.',
                'icon' => 'ph:archive',
            ],
            'slack_invite_to_channel' => [
                'class' => SlackInviteToChannel::class,
                'type' => 'write',
                'name' => 'Invite to Channel',
                'description' => 'Invite users to a channel.',
                'icon' => 'ph:user-plus',
            ],
            // Files
            'slack_upload_file' => [
                'class' => SlackUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to Slack.',
                'icon' => 'ph:upload-simple',
            ],
            'slack_list_files' => [
                'class' => SlackListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files in Slack.',
                'icon' => 'ph:files',
            ],
            'slack_get_file' => [
                'class' => SlackGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get file info.',
                'icon' => 'ph:file',
            ],
            // Users
            'slack_list_users' => [
                'class' => SlackListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List all Slack users.',
                'icon' => 'ph:users',
            ],
            'slack_get_user' => [
                'class' => SlackGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get user info by ID.',
                'icon' => 'ph:user',
            ],
            'slack_find_user_by_email' => [
                'class' => SlackFindUserByEmail::class,
                'type' => 'read',
                'name' => 'Find User by Email',
                'description' => 'Look up a Slack user by email.',
                'icon' => 'ph:at',
            ],
            // Reactions & Usergroups
            'slack_add_reaction' => [
                'class' => SlackAddReaction::class,
                'type' => 'write',
                'name' => 'Add Reaction',
                'description' => 'Add an emoji reaction to a message.',
                'icon' => 'ph:smiley',
            ],
            'slack_remove_reaction' => [
                'class' => SlackRemoveReaction::class,
                'type' => 'write',
                'name' => 'Remove Reaction',
                'description' => 'Remove an emoji reaction from a message.',
                'icon' => 'ph:smiley-sad',
            ],
            'slack_list_usergroups' => [
                'class' => SlackListUsergroups::class,
                'type' => 'read',
                'name' => 'List Usergroups',
                'description' => 'List all Slack usergroups.',
                'icon' => 'ph:users-three',
            ],
            'slack_update_usergroup_members' => [
                'class' => SlackUpdateUsergroupMembers::class,
                'type' => 'write',
                'name' => 'Update Usergroup Members',
                'description' => 'Update the members of a usergroup.',
                'icon' => 'ph:user-switch',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/slack.md';
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
     * Resolve the SlackService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): SlackService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new SlackService(
                botToken: $creds->get('slack', 'bot_token', '', $account),
            );
        }

        return app(SlackService::class);
    }
}
