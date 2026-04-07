<?php

namespace OpenCompany\Integrations\Radar\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolResult;
use OpenCompany\Integrations\Radar\RadarService;

class RadarListEvents implements Tool
{
    public function __construct(private RadarService $service) {}

    public function name(): string
    {
        return 'radar_list_events';
    }

    public function description(): string
    {
        return 'List events from Radar with optional filters for type, user, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of results to return (default: 100, max: 1000)'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response'],
            'type' => ['type' => 'string', 'description' => 'Filter by event type, e.g. "user.entered_geofence", "user.exited_geofence"'],
            'user_id' => ['type' => 'string', 'description' => 'Filter events by user ID'],
            'geofence_id' => ['type' => 'string', 'description' => 'Filter events by geofence ID'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Radar integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['limit', 'cursor', 'type', 'user_id', 'geofence_id'];
            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listEvents($filters);
            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
