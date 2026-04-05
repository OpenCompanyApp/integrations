<?php

namespace OpenCompany\Integrations\Jotform\Tools;

use OpenCompany\Integrations\Jotform\JotformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class JotformListForms implements Tool
{
    public function __construct(
        private JotformService $service,
    ) {}

    public function name(): string
    {
        return 'jotform_list_forms';
    }

    public function description(): string
    {
        return 'List all forms owned by the authenticated Jotform user. Returns form IDs, titles, creation dates, and status. Supports pagination and filtering.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of forms to return (default: 20, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination — pass the number of forms to skip.'],
            'orderby' => ['type' => 'string', 'description' => 'Field to order by: "created_at" (default), "title", "id", "updated_at".'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "ENABLED" or "DISABLED".'],
            'title' => ['type' => 'string', 'description' => 'Filter by form title (partial match).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jotform integration is not configured.');
            }

            $filters = [];
            if (isset($args['status'])) {
                $filters['status'] = $args['status'];
            }
            if (isset($args['title'])) {
                $filters['title'] = $args['title'];
            }

            $result = $this->service->listForms(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
                filters: $filters,
                orderBy: $args['orderby'] ?? null,
            );

            $content = $result['content'] ?? $result;

            return ToolResult::success($content);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
