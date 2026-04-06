<?php

namespace OpenCompany\Integrations\Wildix\Tools;

use OpenCompany\Integrations\Wildix\WildixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WildixListCalls implements Tool
{
    public function __construct(
        private WildixService $service,
    ) {}

    public function name(): string
    {
        return 'wildix_list_calls';
    }

    public function description(): string
    {
        return 'List call records from the Wildix PBX. Supports pagination and optional date range filtering to narrow results by period.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of call records to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'date_from' => ['type' => 'string', 'description' => 'Start date for filtering calls (ISO 8601, e.g. "2026-01-01").'],
            'date_to' => ['type' => 'string', 'description' => 'End date for filtering calls (ISO 8601, e.g. "2026-01-31").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wildix integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $dateFrom = $args['date_from'] ?? null;
            $dateTo = $args['date_to'] ?? null;

            $result = $this->service->listCalls($limit, $page, $dateFrom, $dateTo);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
