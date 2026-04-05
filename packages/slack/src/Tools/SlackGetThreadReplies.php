<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get all replies in a Slack message thread.
 *
 * Supports pagination via cursors.
 */
class SlackGetThreadReplies implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_get_thread_replies';
    }

    public function description(): string
    {
        return 'Get all replies in a Slack message thread.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'ts' => ['type' => 'string', 'required' => true, 'description' => 'Timestamp of the parent message (thread root).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of replies to return per page (default 1000).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Retrieve all replies in a message thread.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, ts, limit, cursor)
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
                return ToolResult::error('ts (thread parent timestamp) is required.');
            }

            $params = [
                'channel' => $channel,
                'ts' => $ts,
            ];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->getThreadReplies($params);

            return ToolResult::success([
                'ok' => true,
                'messages' => $result['messages'] ?? [],
                'has_more' => $result['has_more'] ?? false,
                'response_metadata' => $result['response_metadata'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
