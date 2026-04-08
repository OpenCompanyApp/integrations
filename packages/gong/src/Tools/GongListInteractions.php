<?php

namespace OpenCompany\Integrations\Gong\Tools;

use OpenCompany\Integrations\Gong\GongService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing interactions from Gong.
 *
 * Retrieves customer interaction data via the POST /v2/interactions endpoint,
 * supporting date range filtering, activity type filtering, and pagination.
 */
class GongListInteractions implements Tool
{
    /**
     * Create a new GongListInteractions tool instance.
     */
    public function __construct(
        private GongService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gong_list_interactions';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'List customer interactions tracked in Gong. Filter by date range, activity type, or participants. Returns interaction metadata including type, duration, and parties involved.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'fromDateTime' => ['type' => 'string', 'description' => 'Start of date range in ISO 8601 format (e.g., "2025-01-01T00:00:00Z").'],
            'toDateTime' => ['type' => 'string', 'description' => 'End of date range in ISO 8601 format (e.g., "2025-01-31T23:59:59Z").'],
            'activityTypes' => ['type' => 'array', 'description' => 'Array of activity types to filter by (e.g., ["call", "email", "meeting"]).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor for pagination — pass the value from a previous response to get the next page.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of interactions to return (default: 100).'],
        ];
    }

    /**
     * Execute the list interactions tool.
     *
     * @param  array  $args  Tool arguments matching the parameter schema.
     * @return ToolResult The result containing interaction data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gong integration is not configured.');
            }

            $body = [];

            if (isset($args['fromDateTime'])) {
                $body['fromDateTime'] = $args['fromDateTime'];
            }
            if (isset($args['toDateTime'])) {
                $body['toDateTime'] = $args['toDateTime'];
            }
            if (isset($args['activityTypes'])) {
                $body['activityTypes'] = $args['activityTypes'];
            }
            if (isset($args['cursor'])) {
                $body['cursor'] = $args['cursor'];
            }

            $result = $this->service->listInteractions($body);

            $interactions = $result['interactions'] ?? [];
            $totalCount = count($interactions);
            $response = [
                'interactions' => $interactions,
                'count' => $totalCount,
            ];

            if (isset($result['records'])) {
                $response['totalRecords'] = $result['records']['totalRecords'] ?? $totalCount;
            }
            if (isset($result['cursor'])) {
                $response['cursor'] = $result['cursor'];
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
