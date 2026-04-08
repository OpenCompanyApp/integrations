<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all workers (drivers) in Onfleet.
 *
 * Returns worker details including name, phone, vehicle info, current status,
 * and assigned tasks. Can filter by team or worker state.
 */
class OnfleetListWorkers implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_list_workers';
    }

    public function description(): string
    {
        return 'List all workers (drivers) in Onfleet. Optionally filter by team or worker state. Returns worker name, phone, vehicle details, and current status.';
    }

    public function parameters(): array
    {
        return [
            'teams' => ['type' => 'array', 'description' => 'Array of team IDs to filter workers by.'],
            'states' => ['type' => 'array', 'description' => 'Array of worker states to filter by: 0=off-duty, 1=on-duty.'],
            'name' => ['type' => 'string', 'description' => 'Filter workers by name.'],
            'phone' => ['type' => 'string', 'description' => 'Filter workers by phone number.'],
            'query' => ['type' => 'string', 'description' => 'General search query for workers.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            $query = [];
            if (isset($args['teams'])) {
                $query['teams'] = implode(',', (array) $args['teams']);
            }
            if (isset($args['states'])) {
                $query['states'] = implode(',', (array) $args['states']);
            }
            if (isset($args['name'])) {
                $query['name'] = $args['name'];
            }
            if (isset($args['phone'])) {
                $query['phone'] = $args['phone'];
            }
            if (isset($args['query'])) {
                $query['query'] = $args['query'];
            }

            $result = $this->service->listWorkers($query);

            $workers = $result['workers'] ?? $result;

            return ToolResult::success([
                'workers' => $workers,
                'count' => is_array($workers) ? count($workers) : 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
