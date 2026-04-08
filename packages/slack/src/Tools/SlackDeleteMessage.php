<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a message from a Slack channel.
 */
class SlackDeleteMessage implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_delete_message';
    }

    public function description(): string
    {
        return 'Delete a message from a Slack channel.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID where the message was posted.'],
            'ts' => ['type' => 'string', 'required' => true, 'description' => 'Timestamp of the message to delete.'],
        ];
    }

    /**
     * Delete a message by channel and timestamp.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, ts)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $ts = $args['ts'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($ts)) {
                return ToolResult::error('ts (message timestamp) is required.');
            }

            $this->service->deleteMessage([
                'channel' => $channel,
                'ts' => $ts,
            ]);

            return ToolResult::success([
                'ok' => true,
                'channel' => $channel,
                'ts' => $ts,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
