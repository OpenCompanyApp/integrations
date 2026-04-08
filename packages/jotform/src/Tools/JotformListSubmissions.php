<?php

namespace OpenCompany\Integrations\Jotform\Tools;

use OpenCompany\Integrations\Jotform\JotformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class JotformListSubmissions implements Tool
{
    public function __construct(
        private JotformService $service,
    ) {}

    public function name(): string
    {
        return 'jotform_list_submissions';
    }

    public function description(): string
    {
        return 'List submissions for a specific Jotform form. Returns submission IDs, timestamps, and answers. Supports pagination, filtering by date, and ordering.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID to list submissions for (e.g., "231234567890123").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of submissions to return (default: 20, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination — pass the number of submissions to skip.'],
            'orderby' => ['type' => 'string', 'description' => 'Field to order by: "created_at" (default) or "id".'],
            'created_at' => ['type' => 'string', 'description' => 'Filter by creation date (format: "YYYY-MM-DD HH:mm:ss" or date range).'],
            'status' => ['type' => 'string', 'description' => 'Filter by submission status: "ACTIVE" or "DELETED".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jotform integration is not configured.');
            }

            $filters = [];
            if (isset($args['created_at'])) {
                $filters['created_at'] = $args['created_at'];
            }
            if (isset($args['status'])) {
                $filters['status'] = $args['status'];
            }

            $result = $this->service->listSubmissions(
                formId: $args['form_id'],
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
