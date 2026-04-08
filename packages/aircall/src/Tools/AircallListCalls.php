<?php

namespace OpenCompany\Integrations\Aircall\Tools;

use OpenCompany\Integrations\Aircall\AircallService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing calls from the Aircall API.
 *
 * Supports filtering by date range, direction, user, number, and tags.
 * Returns paginated results with call details including duration, direction,
 * status, and associated contact information.
 *
 * @see https://developer.aircall.io/api-references/#list-calls
 */
class AircallListCalls implements Tool
{
    /**
     * Create a new AircallListCalls tool instance.
     *
     * @param  AircallService  $service  The Aircall API service instance.
     */
    public function __construct(
        private AircallService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'aircall_list_calls';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List calls from Aircall with optional filters. Supports filtering by date range, direction (inbound/outbound), user ID, phone number, and tags. Returns paginated call records.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 50).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc" (default: "desc").'],
            'from' => ['type' => 'string', 'description' => 'Start date in ISO 8601 format (e.g., "2026-01-01T00:00:00Z").'],
            'to' => ['type' => 'string', 'description' => 'End date in ISO 8601 format (e.g., "2026-01-31T23:59:59Z").'],
            'direction' => ['type' => 'string', 'description' => 'Filter by call direction: "inbound" or "outbound".'],
            'user_id' => ['type' => 'integer', 'description' => 'Filter by user ID who handled the call.'],
            'number_id' => ['type' => 'integer', 'description' => 'Filter by phone number ID (the Aircall number that received/made the call).'],
            'tags' => ['type' => 'array', 'description' => 'Filter by tags assigned to the call.'],
        ];
    }

    /**
     * Execute the list calls tool.
     *
     * @param  array  $args  The tool arguments matching the defined parameters.
     * @return ToolResult The result containing call records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Aircall integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['per_page', 'page', 'order', 'from', 'to', 'direction', 'user_id', 'number_id', 'tags'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listCalls($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
