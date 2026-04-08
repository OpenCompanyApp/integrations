<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific Slack message by its timestamp.
 *
 * Optionally retrieves a message within a thread.
 */
class SlackGetMessage implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_get_message';
    }

    public function description(): string
    {
        return 'Get a specific message by its timestamp. Optionally fetch a message within a thread.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'ts' => ['type' => 'string', 'required' => true, 'description' => 'Timestamp of the message to retrieve.'],
            'thread_ts' => ['type' => 'string', 'description' => 'If provided, fetches a reply within this thread instead.'],
        ];
    }

    /**
     * Retrieve a specific message by timestamp, optionally within a thread.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, ts, thread_ts)
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

            // If thread_ts is provided, use conversations.replies to get a threaded reply
            if (! empty($args['thread_ts'])) {
                $result = $this->service->getThreadReplies([
                    'channel' => $channel,
                    'ts' => $args['thread_ts'],
                    'latest' => $ts,
                    'limit' => 1,
                ]);

                $messages = $result['messages'] ?? [];

                return ToolResult::success([
                    'ok' => true,
                    'message' => $messages[0] ?? null,
                ]);
            }

            // Otherwise use conversations.history with latest=ts to get a specific message
            $result = $this->service->getChannelHistory([
                'channel' => $channel,
                'latest' => $ts,
                'limit' => 1,
                'inclusive' => true,
            ]);

            $messages = $result['messages'] ?? [];

            return ToolResult::success([
                'ok' => true,
                'message' => $messages[0] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
