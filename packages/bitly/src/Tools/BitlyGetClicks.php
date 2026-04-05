<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get click metrics for a Bitlink.
 *
 * Calls GET /bitlinks/{bitlink}/clicks to retrieve click data
 * with configurable time units and reference points.
 */
class BitlyGetClicks implements Tool
{
    /**
     * Create a new BitlyGetClicks tool instance.
     *
     * @param BitlyService $service The Bitly API service
     */
    public function __construct(
        private BitlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier
     */
    public function name(): string
    {
        return 'bitly_get_clicks';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'Get click metrics for a Bitlink. Returns click counts by time unit (minute, hour, day, week, month).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [
            'bitlink' => ['type' => 'string', 'required' => true, 'description' => 'The Bitlink identifier (e.g., "bit.ly/abc123").'],
            'unit' => ['type' => 'string', 'description' => 'Time unit for click aggregation: "minute", "hour", "day", "week", or "month". Defaults to "day".'],
            'units' => ['type' => 'integer', 'description' => 'Number of time units to return. Use -1 for all available data. Defaults to -1.'],
            'unit_reference' => ['type' => 'string', 'description' => 'ISO 8601 timestamp for the reference point (e.g., "2026-01-01T00:00:00+0000").'],
        ];
    }

    /**
     * Execute the tool: fetch click metrics for the specified Bitlink.
     *
     * @param array $args Tool arguments containing the bitlink and optional time parameters
     *
     * @return ToolResult The click metrics data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bitly integration is not configured.');
            }

            $bitlink = $args['bitlink'] ?? '';
            if (empty($bitlink)) {
                return ToolResult::error('bitlink is required.');
            }

            $result = $this->service->getClicks(
                $bitlink,
                $args['unit'] ?? null,
                $args['units'] ?? null,
                $args['unit_reference'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
