<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GranolaListMeetings implements Tool
{
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_list_meetings';
    }

    public function description(): string
    {
        return 'List recent meetings from Granola. Returns meeting titles, dates, participants, and summaries. Supports search by query and date filtering.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of meetings to return (default: 20).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of meetings to skip for pagination.'],
            'query' => ['type' => 'string', 'description' => 'Search query to filter meetings by title or content.'],
            'start_date' => ['type' => 'string', 'description' => 'Start date for filtering meetings (ISO 8601, e.g., "2025-01-01").'],
            'end_date' => ['type' => 'string', 'description' => 'End date for filtering meetings (ISO 8601, e.g., "2025-01-31").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['query'])) {
                $params['query'] = $args['query'];
            }
            if (isset($args['start_date'])) {
                $params['start_date'] = $args['start_date'];
            }
            if (isset($args['end_date'])) {
                $params['end_date'] = $args['end_date'];
            }

            $result = $this->service->listMeetings($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
