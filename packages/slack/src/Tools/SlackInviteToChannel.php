<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Invite one or more users to a Slack channel.
 */
class SlackInviteToChannel implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_invite_to_channel';
    }

    public function description(): string
    {
        return 'Invite one or more users to a Slack channel.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'users' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated list of user IDs to invite.'],
        ];
    }

    /**
     * Invite users to a channel by their user IDs.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, users)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $users = $args['users'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($users)) {
                return ToolResult::error('users is required.');
            }

            $result = $this->service->inviteToChannel([
                'channel' => $channel,
                'users' => $users,
            ]);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result['channel'] ?? $channel,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
