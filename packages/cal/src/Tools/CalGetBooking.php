<?php

namespace OpenCompany\Integrations\Cal\Tools;

use OpenCompany\Integrations\Cal\CalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single booking by ID or UID from Cal.com.
 *
 * Returns full details for a specific booking including attendees,
 * timing, event type info, location, and status.
 *
 * @see https://cal.com/docs/api-reference/v2/bookings/get-a-booking
 */
class CalGetBooking implements Tool
{
    /**
     * @param  CalService  $service  Cal.com API client.
     */
    public function __construct(
        private CalService $service,
    ) {}

    public function name(): string
    {
        return 'cal_get_booking';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific booking from Cal.com by its ID or UID.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The booking ID or UID.'],
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

            $id = (string) $args['id'];
            $result = $this->service->getBooking($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
