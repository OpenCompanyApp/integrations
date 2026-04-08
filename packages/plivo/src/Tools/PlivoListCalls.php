<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing calls from the Plivo API.
 *
 * Supports filtering by direction, state, date range, and phone numbers.
 * Returns paginated results with call details including UUID, duration,
 * direction, status, and timestamps.
 *
 * @see https://www.plivo.com/docs/voice/api/call#list-calls
 */
class PlivoListCalls implements Tool
{
    /**
     * Create a new PlivoListCalls tool instance.
     *
     * @param  PlivoService  $service  The Plivo API service instance.
     */
    public function __construct(
        private PlivoService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'plivo_list_calls';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List calls from Plivo with optional filters. Supports filtering by direction (inbound/outbound), call state, date range, and phone numbers. Returns paginated call records.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'call_direction' => ['type' => 'string', 'description' => 'Filter by direction: "inbound" or "outbound".'],
            'call_state' => ['type' => 'string', 'description' => 'Filter by state: "ringing", "in-progress", "ended", etc.'],
            'from_number' => ['type' => 'string', 'description' => 'Filter by caller phone number.'],
            'to_number' => ['type' => 'string', 'description' => 'Filter by callee phone number.'],
            'start_time' => ['type' => 'string', 'description' => 'Filter calls after this datetime (ISO 8601).'],
            'end_time' => ['type' => 'string', 'description' => 'Filter calls before this datetime (ISO 8601).'],
        ];
    }

    /**
     * Execute the list calls tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments matching the defined parameters.
     * @return ToolResult The result containing call records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['limit', 'offset', 'call_direction', 'call_state', 'from_number', 'to_number', 'start_time', 'end_time'];

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
