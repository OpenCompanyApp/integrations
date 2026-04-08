<?php

namespace OpenCompany\Integrations\Keap\Tools;

use OpenCompany\Integrations\Keap\KeapService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sales opportunities from Keap CRM.
 *
 * Returns a paginated list of opportunities. Optionally filter by
 * pipeline stage to narrow results (e.g., "New", "Appointment Scheduled",
 * "Closed Won").
 */
class KeapListOpportunities implements Tool
{
    public function __construct(
        private KeapService $service,
    ) {}

    public function name(): string
    {
        return 'keap_list_opportunities';
    }

    public function description(): string
    {
        return 'List sales opportunities from Keap CRM. Optionally filter by pipeline stage. Returns paginated results with opportunity details.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of opportunities per page (default: 20, max: 200).'],
            'stage' => ['type' => 'string', 'description' => 'Filter by opportunity stage (e.g., "New", "Appointment Scheduled", "Closed Won", "Closed Lost").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keap integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;
            $stage = $args['stage'] ?? null;

            $result = $this->service->listOpportunities($page, $limit, $stage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
