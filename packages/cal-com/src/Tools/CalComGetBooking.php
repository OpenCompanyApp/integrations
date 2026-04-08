<?php

namespace OpenCompany\Integrations\CalCom\Tools;

use OpenCompany\Integrations\CalCom\CalComService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single booking by ID from Cal.com v2.
 *
 * Returns full details for a specific booking including attendees,
 * timing, event type info, location, and status.
 *
 * @see https://developer.cal.com/api/endpoints/bookings
 */
class CalComGetBooking implements Tool
{
    public function __construct(
        private CalComService $service,
    ) {}

    public function name(): string
    {
        return 'cal_com_get_booking';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific booking from Cal.com by its ID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The booking ID.'],
        ];
    }

    /**
     * Execute the tool — get a single booking from Cal.com.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cal.com integration is not configured.');
            }

            $id = (int) $args['id'];
            $result = $this->service->getBooking($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
