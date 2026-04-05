<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Slack channels the bot has access to.
 *
 * Supports filtering by channel type and pagination via cursors.
 */
class SlackListChannels implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_list_channels';
    }

    public function description(): string
    {
        return 'List all Slack channels the bot has access to.';
    }

    public function parameters(): array
    {
        return [
            'types' => ['type' => 'string', 'description' => 'Comma-separated channel types: "public_channel", "private_channel", "mpim", "im". Default: "public_channel".'],
            'exclude_archived' => ['type' => 'boolean', 'description' => 'Exclude archived channels (default: true).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of channels to return per page (default 100, max 1000).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List channels with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (types, exclude_archived, limit, cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $params = [];

            if (isset($args['types'])) {
                $params['types'] = $args['types'];
            }
            if (isset($args['exclude_archived'])) {
                $params['exclude_archived'] = (bool) $args['exclude_archived'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->listChannels($params);

            return ToolResult::success([
                'ok' => true,
                'channels' => $result['channels'] ?? [],
                'response_metadata' => $result['response_metadata'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
