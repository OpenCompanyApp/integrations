<?php

namespace OpenCompany\Integrations\Linear\Tools;

use OpenCompany\Integrations\Linear\LinearService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Linear initiatives with optional limit.
 */
class LinearListInitiatives implements Tool
{
    /**
     * @param  LinearService  $service  The Linear API client
     */
    public function __construct(
        private LinearService $service,
    ) {}

    public function name(): string
    {
        return 'linear_list_initiatives';
    }

    public function description(): string
    {
        return <<<'MD'
        List Linear initiatives with optional limit. Returns initiative details
        including state, dates, and associated projects.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Max results to return. Default: 25.'],
        ];
    }

    /**
     * List Linear initiatives.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Linear integration is not configured.');
            }

            $limit = (int) ($args['limit'] ?? 25);

            $result = $this->service->listInitiatives($limit);
            $initiatives = $result['data']['initiatives'] ?? [];

            $nodes = array_map(function (array $initiative) {
                return [
                    'id' => $initiative['id'] ?? '',
                    'name' => $initiative['name'] ?? '',
                    'description' => $initiative['description'] ?? '',
                    'state' => $initiative['state'] ?? '',
                    'start_date' => $initiative['startDate'] ?? null,
                    'target_date' => $initiative['targetDate'] ?? null,
                    'projects' => array_map(fn (array $p) => [
                        'id' => $p['id'] ?? '',
                        'name' => $p['name'] ?? '',
                    ], $initiative['projects']['nodes'] ?? []),
                    'created_at' => $initiative['createdAt'] ?? '',
                    'updated_at' => $initiative['updatedAt'] ?? '',
                ];
            }, $initiatives['nodes'] ?? []);

            $pageInfo = $initiatives['pageInfo'] ?? [];

            return ToolResult::success([
                'initiatives' => $nodes,
                'total' => count($nodes),
                'has_next_page' => $pageInfo['hasNextPage'] ?? false,
                'end_cursor' => $pageInfo['endCursor'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
