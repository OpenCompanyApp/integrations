<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for messages across all Slack channels and DMs.
 *
 * Supports Slack search modifiers and result sorting.
 */
class SlackSearchMessages implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_search_messages';
    }

    public function description(): string
    {
        return 'Search for messages across all Slack channels and DMs.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query. Supports Slack search modifiers like "from:", "in:", "has:", etc.'],
            'count' => ['type' => 'integer', 'description' => 'Number of results per page (default 20, max 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number of results (default 1).'],
            'sort' => ['type' => 'string', 'description' => 'Sort order: "score" (default) or "timestamp".'],
            'sort_dir' => ['type' => 'string', 'description' => 'Sort direction: "desc" (default) or "asc".'],
        ];
    }

    /**
     * Search messages with optional pagination and sorting.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, count, page, sort, sort_dir)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $query = $args['query'] ?? '';

            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $params = ['query' => $query];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['sort'])) {
                $params['sort'] = $args['sort'];
            }
            if (isset($args['sort_dir'])) {
                $params['sort_dir'] = $args['sort_dir'];
            }

            $result = $this->service->searchMessages($params);

            return ToolResult::success([
                'ok' => true,
                'messages' => $result['messages'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
