<?php

namespace OpenCompany\Integrations\MakeCom\Tools;

use OpenCompany\Integrations\MakeCom\MakeComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Make.com scenario executions (runs) with optional filters.
 */
class MakeComListExecutions implements Tool
{
    /**
     * @param  MakeComService  $service  The Make.com API client
     */
    public function __construct(
        private MakeComService $service,
    ) {}

    public function name(): string
    {
        return 'make_com_list_executions';
    }

    public function description(): string
    {
        return <<<'MD'
        List Make.com scenario executions (runs) with optional filters.
        Filter by scenario ID or execution status. Useful for monitoring
        scenario health and debugging failed runs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'scenario_id' => ['type' => 'string', 'description' => 'Filter by scenario ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status (e.g. "success", "error", "warning").'],
            'limit' => ['type' => 'integer', 'description' => 'Number of results per page. Default: 20.'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    /**
     * List Make.com scenario executions with optional filters.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Make.com integration is not configured.');
            }

            $params = [];

            if (! empty($args['scenario_id'])) {
                $params['scenarioId'] = $args['scenario_id'];
            }
            if (! empty($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }

            $result = $this->service->listExecutions($params);
            $executions = $result['runs'] ?? $result['executions'] ?? [];

            return ToolResult::success([
                'executions' => $executions,
                'total' => count($executions),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
