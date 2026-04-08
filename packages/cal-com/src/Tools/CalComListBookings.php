<?php

namespace OpenCompany\Integrations\CalCom\Tools;

use OpenCompany\Integrations\CalCom\CalComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List bookings from Cal.com v2.
 *
 * Returns bookings with optional filtering by status, event type,
 * and pagination support.
 *
 * @see https://developer.cal.com/api/endpoints/bookings
 */
class CalComListBookings implements Tool
{
    public function __construct(
        private CalComService $service,
    ) {}

    public function name(): string
    {
        return 'cal_com_list_bookings';
    }

    public function description(): string
    {
        return 'List bookings from Cal.com with optional filtering by status, event type, and pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of bookings to return per page.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
            'status' => ['type' => 'string', 'description' => 'Filter by booking status: "confirmed", "pending", "cancelled", or "rejected".'],
            'eventTypeId' => ['type' => 'integer', 'description' => 'Filter bookings for a specific event type by its ID.'],
        ];
    }

    /**
     * Execute the tool — list bookings from Cal.com.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $page = isset($args['page']) ? (int) $args['page'] : null;
            $status = $args['status'] ?? null;
            $eventTypeId = isset($args['eventTypeId']) ? (int) $args['eventTypeId'] : null;

            $result = $this->service->listBookings($limit, $page, $status, $eventTypeId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
