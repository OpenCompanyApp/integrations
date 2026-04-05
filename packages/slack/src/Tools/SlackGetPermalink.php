<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a permalink URL for a specific Slack message.
 */
class SlackGetPermalink implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_get_permalink';
    }

    public function description(): string
    {
        return 'Get a permalink URL for a specific Slack message.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID where the message is posted.'],
            'message_ts' => ['type' => 'string', 'required' => true, 'description' => 'Timestamp of the message.'],
        ];
    }

    /**
     * Get a permalink for a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, message_ts)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $messageTs = $args['message_ts'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($messageTs)) {
                return ToolResult::error('message_ts is required.');
            }

            $result = $this->service->getPermalink([
                'channel' => $channel,
                'message_ts' => $messageTs,
            ]);

            return ToolResult::success([
                'ok' => true,
                'permalink' => $result['permalink'] ?? '',
                'channel' => $result['channel'] ?? $channel,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
