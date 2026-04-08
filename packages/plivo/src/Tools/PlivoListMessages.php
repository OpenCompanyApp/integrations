<?php

namespace OpenCompany\Integrations\Plivo\Tools;

use OpenCompany\Integrations\Plivo\PlivoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing SMS messages from the Plivo API.
 *
 * Supports filtering by direction, state, date range, and phone numbers.
 * Returns paginated results with message details including UUID, direction,
 * status, and timestamps.
 *
 * @see https://www.plivo.com/docs/sms/api/message#list-messages
 */
class PlivoListMessages implements Tool
{
    /**
     * Create a new PlivoListMessages tool instance.
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
        return 'plivo_list_messages';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List SMS messages from Plivo with optional filters. Supports filtering by direction (inbound/outbound), message state, date range, sender, and recipient. Returns paginated message records.';
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
            'message_direction' => ['type' => 'string', 'description' => 'Filter by direction: "inbound" or "outbound".'],
            'message_state' => ['type' => 'string', 'description' => 'Filter by state: "queued", "sent", "delivered", "undelivered", or "failed".'],
            'src' => ['type' => 'string', 'description' => 'Filter by source phone number (sender).'],
            'dst' => ['type' => 'string', 'description' => 'Filter by destination phone number (recipient).'],
            'start_time' => ['type' => 'string', 'description' => 'Filter messages after this datetime (ISO 8601, e.g., "2026-01-01T00:00:00Z").'],
            'end_time' => ['type' => 'string', 'description' => 'Filter messages before this datetime (ISO 8601, e.g., "2026-01-31T23:59:59Z").'],
        ];
    }

    /**
     * Execute the list messages tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments matching the defined parameters.
     * @return ToolResult The result containing message records or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Plivo integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['limit', 'offset', 'message_direction', 'message_state', 'src', 'dst', 'start_time', 'end_time'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listMessages($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
