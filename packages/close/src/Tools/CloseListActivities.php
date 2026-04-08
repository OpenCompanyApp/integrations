<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Activities.
 *
 * Lists activities in Close CRM such as emails, calls, and notes. Supports
 * filtering by lead ID and activity type with pagination.
 *
 * @see https://developer.close.com/resources/activities/#list-activities
 */
class CloseListActivities implements Tool
{
    /**
     * @param  CloseService  $service  The Close API service instance.
     */
    public function __construct(
        private CloseService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'close_list_activities';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List activities in Close CRM — emails, calls, notes, and other activity types. Filter by lead ID or activity type. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'description' => 'Filter activities by lead ID (e.g., "lead_abc123XYZ").'],
            'type'    => ['type' => 'string', 'description' => 'Activity type filter. Common values: "email", "call", "note", "sms", "meeting".'],
            'limit'   => ['type' => 'integer', 'description' => 'Maximum number of activities to return (default: 25, max: 100).'],
            'skip'    => ['type' => 'integer', 'description' => 'Number of records to skip for pagination.'],
        ];
    }

    /**
     * Execute the list activities tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (lead_id, type, limit, skip).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Close integration is not configured.');
            }

            $leadId = $args['lead_id'] ?? null;
            $type   = $args['type'] ?? null;
            $limit  = isset($args['limit']) ? (int) $args['limit'] : 25;
            $skip   = isset($args['skip']) ? (int) $args['skip'] : null;

            $result = $this->service->listActivities($leadId, $type, $limit, $skip);

            $activities = $result['data'] ?? [];
            $total      = $result['total_results'] ?? count($activities);
            $hasMore    = ($result['_skip'] ?? 0) + count($activities) < $total;

            return ToolResult::success([
                'activities' => $activities,
                'count'      => count($activities),
                'total'      => $total,
                'has_more'   => $hasMore,
                '_skip'      => $result['_skip'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
