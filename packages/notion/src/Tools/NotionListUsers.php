<?php

namespace OpenCompany\Integrations\Notion\Tools;

use OpenCompany\Integrations\Notion\NotionService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all users in the Notion workspace.
 */
class NotionListUsers implements Tool
{
    /**
     * @param  NotionService  $service  The Notion API client
     */
    public function __construct(
        private NotionService $service,
    ) {}

    public function name(): string
    {
        return 'notion_list_users';
    }

    public function description(): string
    {
        return <<<'MD'
        List all users in the Notion workspace. Returns user IDs, names, types,
        and avatar URLs. Supports pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (max 100, default 100).'],
            'start_cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * List all workspace users with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_size, start_cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Notion integration is not configured.');
            }

            $params = [];

            if (isset($args['page_size'])) {
                $params['page_size'] = min((int) $args['page_size'], 100);
            }

            if (isset($args['start_cursor'])) {
                $params['start_cursor'] = $args['start_cursor'];
            }

            $result = $this->service->listUsers($params);
            $results = $result['results'] ?? [];

            $output = [];
            foreach ($results as $user) {
                $output[] = [
                    'id' => $user['id'] ?? '',
                    'name' => $user['name'] ?? '',
                    'type' => $user['type'] ?? '',
                    'avatar_url' => $user['avatar_url'] ?? null,
                ];
            }

            $response = ['count' => count($output), 'users' => $output];

            if (isset($result['has_more']) && $result['has_more']) {
                $response['has_more'] = true;
                $response['next_cursor'] = $result['next_cursor'] ?? null;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
