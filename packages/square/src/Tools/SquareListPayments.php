<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SquareListPayments implements Tool
{
    /**
     * Create a new SquareListPayments tool instance.
     */
    public function __construct(
        private SquareService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'square_list_payments';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List payments from Square. Supports filtering by date range, location, and status with cursor-based pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of payments to return per page (default: 100, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
            'begin_time' => ['type' => 'string', 'description' => 'Start of the date range filter (RFC 3339 timestamp, e.g., "2024-01-01T00:00:00Z").'],
            'end_time' => ['type' => 'string', 'description' => 'End of the date range filter (RFC 3339 timestamp, e.g., "2024-12-31T23:59:59Z").'],
            'location_id' => ['type' => 'string', 'description' => 'Filter results to payments at a specific Square location.'],
            'status' => ['type' => 'string', 'description' => 'Filter by payment status: COMPLETED, FAILED, PENDING, or CANCELED.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }
            if (isset($args['begin_time'])) {
                $params['begin_time'] = $args['begin_time'];
            }
            if (isset($args['end_time'])) {
                $params['end_time'] = $args['end_time'];
            }
            if (isset($args['location_id'])) {
                $params['location_id'] = $args['location_id'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listPayments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
