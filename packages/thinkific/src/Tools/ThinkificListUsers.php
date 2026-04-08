<?php

namespace OpenCompany\Integrations\Thinkific\Tools;

use OpenCompany\Integrations\Thinkific\ThinkificService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List users in Thinkific.
 *
 * Supports pagination and optional search filtering.
 */
class ThinkificListUsers implements Tool
{
    public function __construct(
        private ThinkificService $service,
    ) {}

    public function name(): string
    {
        return 'thinkific_list_users';
    }

    public function description(): string
    {
        return 'List users in your Thinkific site. Returns user IDs, names, emails, and status. Supports pagination and search.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of users to return per page (default: 25, max: 250).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'query' => ['type' => 'string', 'description' => 'Search term to filter users by name or email.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Thinkific integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $query = $args['query'] ?? null;

            $result = $this->service->listUsers($limit, $page, $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
