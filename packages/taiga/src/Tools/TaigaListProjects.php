<?php

namespace OpenCompany\Integrations\Taiga\Tools;

use OpenCompany\Integrations\Taiga\TaigaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Taiga projects the authenticated user has access to.
 *
 * Returns project names, slugs, descriptions, and membership info.
 * Supports filtering by membership status, slug, and ordering.
 */
class TaigaListProjects implements Tool
{
    public function __construct(
        private TaigaService $service,
    ) {}

    public function name(): string
    {
        return 'taiga_list_projects';
    }

    public function description(): string
    {
        return 'List all Taiga projects you have access to. Returns project names, slugs, and descriptions that you can use to query user stories and issues.';
    }

    public function parameters(): array
    {
        return [
            'membership' => ['type' => 'string', 'description' => 'Filter by membership: "admin", "project_owner", "member".'],
            'slug' => ['type' => 'string', 'description' => 'Filter by project slug.'],
            'order_by' => ['type' => 'string', 'description' => 'Order results by a field (e.g. "name", "-created_date").'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 40).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Taiga integration is not configured.');
            }

            $params = [];
            foreach (['membership', 'slug', 'order_by', 'page', 'page_size'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listProjects($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
