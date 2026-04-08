<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List audit log records for tracking workspace activities.
 */
class InstantlyListAuditLogs implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_audit_logs';
    }

    public function description(): string
    {
        return 'List audit log records for tracking workspace activities.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page (1-1000)'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'activity_type' => ['type' => 'integer', 'required' => false, 'description' => 'Activity type filter'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search term'],
            'start_date' => ['type' => 'string', 'required' => false, 'description' => 'Start date'],
            'end_date' => ['type' => 'string', 'required' => false, 'description' => 'End date'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $params = []; foreach (['limit','starting_after','activity_type','search','start_date','end_date'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $this->service->listAuditLogs($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
