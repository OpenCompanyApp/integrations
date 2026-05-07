<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * List EONET v3 natural events.
 */
class NasaGetEonetEvents implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_eonet_events';
    }

    public function description(): string
    {
        return 'List NASA EONET v3 natural events with optional filters for status, category, source, limit, and date range.';
    }

    public function parameters(): array
    {
        return [
            'status' => ['type' => 'string', 'description' => 'Event status such as open, closed, or all.'],
            'category' => ['type' => 'string', 'description' => 'Category ID or comma-separated category IDs.'],
            'source' => ['type' => 'string', 'description' => 'Source ID or comma-separated source IDs.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of events to return.'],
            'days' => ['type' => 'integer', 'description' => 'Only return events from the last number of days.'],
            'start' => ['type' => 'string', 'description' => 'Start date in YYYY-MM-DD format.'],
            'end' => ['type' => 'string', 'description' => 'End date in YYYY-MM-DD format.'],
        ];
    }

    /**
     * List EONET events.
     *
     * @param  array<string, mixed>  $args  Tool arguments used as EONET filters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->getEonetEvents(array_filter($args, static fn (mixed $value): bool => $value !== null && $value !== '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
