<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List files in Slack, with optional filtering by channel, user, or file type.
 */
class SlackListFiles implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_list_files';
    }

    public function description(): string
    {
        return 'List files in Slack, optionally filtered by channel, user, or file type.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'description' => 'Channel ID to filter files by.'],
            'user' => ['type' => 'string', 'description' => 'User ID to filter files by.'],
            'types' => ['type' => 'string', 'description' => 'Comma-separated file types: "spaces", "snippets", "images", "gdocs", "zips", "pdfs".'],
            'count' => ['type' => 'integer', 'description' => 'Number of files per page (default 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number (default 1).'],
        ];
    }

    /**
     * List files with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, user, types, count, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $params = [];

            if (isset($args['channel'])) {
                $params['channel'] = $args['channel'];
            }
            if (isset($args['user'])) {
                $params['user'] = $args['user'];
            }
            if (isset($args['types'])) {
                $params['types'] = $args['types'];
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listFiles($params);

            return ToolResult::success([
                'ok' => true,
                'files' => $result['files'] ?? [],
                'paging' => $result['paging'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
