<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get message history for a Slack channel.
 *
 * Supports pagination via cursors and time-range filtering.
 */
class SlackGetChannelHistory implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_get_channel_history';
    }

    public function description(): string
    {
        return 'Get message history for a Slack channel. Supports pagination with cursors.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of messages to return (default 100, max 1000).'],
            'oldest' => ['type' => 'string', 'description' => 'Start of time range, as a Unix timestamp.'],
            'latest' => ['type' => 'string', 'description' => 'End of time range, as a Unix timestamp.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Retrieve message history for a channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, limit, oldest, latest, cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }

            $params = ['channel' => $channel];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['oldest'])) {
                $params['oldest'] = $args['oldest'];
            }
            if (isset($args['latest'])) {
                $params['latest'] = $args['latest'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->getChannelHistory($params);

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
