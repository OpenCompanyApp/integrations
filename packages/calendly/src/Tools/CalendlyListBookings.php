<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List scheduled bookings (events) in Calendly.
 *
 * Retrieves scheduled events with optional filtering by user,
 * organization, status, and time range.
 */
class CalendlyListBookings implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_list_bookings';
    }

    public function description(): string
    {
        return 'List scheduled Calendly bookings (events) with optional filters.';
    }

    public function parameters(): array
    {
        return [
            'user' => ['type' => 'string', 'description' => 'The user URI to filter by.'],
            'organization' => ['type' => 'string', 'description' => 'The organization URI to filter by.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "active" or "canceled".'],
            'min_start_time' => ['type' => 'string', 'description' => 'ISO 8601 lower bound for start time.'],
            'max_start_time' => ['type' => 'string', 'description' => 'ISO 8601 upper bound for start time.'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
            'count' => ['type' => 'integer', 'description' => 'Number of results per page (default 20, max 100).'],
        ];
    }

    /**
     * List bookings with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $params = [];

            if (isset($args['user'])) {
                $params['user'] = $args['user'];
            }
            if (isset($args['organization'])) {
                $params['organization'] = $args['organization'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['min_start_time'])) {
                $params['min_start_time'] = $args['min_start_time'];
            }
            if (isset($args['max_start_time'])) {
                $params['max_start_time'] = $args['max_start_time'];
            }
            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }

            $result = $this->service->listBookings($params);

            return ToolResult::success([
                'collection' => $result['collection'] ?? [],
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
