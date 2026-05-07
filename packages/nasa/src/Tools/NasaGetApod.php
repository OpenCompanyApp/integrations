<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch NASA Astronomy Picture of the Day entries.
 */
class NasaGetApod implements Tool
{
    /**
     * Create a new NasaGetApod tool instance.
     *
     * @param  NasaService  $service  The NASA service for making API calls.
     */
    public function __construct(
        private NasaService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'nasa_get_apod';
    }

    /**
     * Get the tool description for AI agent context.
     */
    public function description(): string
    {
        return 'Get the NASA Astronomy Picture of the Day (APOD). Returns the daily astronomical image or photo along with an explanation written by a professional astronomer. You can request a specific date or a range of dates.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'date' => ['type' => 'string', 'description' => 'A specific date in YYYY-MM-DD format (defaults to today).'],
            'start_date' => ['type' => 'string', 'description' => 'Start date for a date range in YYYY-MM-DD format. Use with end_date to get multiple APOD entries.'],
            'end_date' => ['type' => 'string', 'description' => 'End date for a date range in YYYY-MM-DD format. Must be used together with start_date.'],
            'count' => ['type' => 'integer', 'description' => 'Return this many random APOD entries. Do not combine with date or date ranges.'],
            'thumbs' => ['type' => 'boolean', 'description' => 'When true, include thumbnail URLs for video entries when NASA provides them.'],
        ];
    }

    /**
     * Execute the get APOD tool.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     * @return ToolResult The APOD data.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            $result = $this->service->getApod(
                date: $args['date'] ?? null,
                startDate: $args['start_date'] ?? null,
                endDate: $args['end_date'] ?? null,
                count: isset($args['count']) ? (int) $args['count'] : null,
                thumbs: isset($args['thumbs']) ? (bool) $args['thumbs'] : null,
            );

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the APOD response into a clean structure.
     *
     * @param  array<string, mixed>|array<int, array<string, mixed>>  $result  The raw API response (single entry or list).
     * @return array<string, mixed> The formatted APOD data.
     */
    private function formatResponse(array $result): array
    {
        // When a date range is requested, the API returns a list of entries
        if (isset($result[0]) && is_array($result[0])) {
            $entries = array_map(function (array $entry): array {
                return $this->formatEntry($entry);
            }, $result);

            return [
                'entries' => $entries,
                'count' => count($entries),
            ];
        }

        return $this->formatEntry($result);
    }

    /**
     * Format a single APOD entry.
     *
     * @param  array<string, mixed>  $entry  A single APOD entry from the API.
     * @return array<string, mixed> The formatted entry.
     */
    private function formatEntry(array $entry): array
    {
        return [
            'date' => $entry['date'] ?? null,
            'title' => $entry['title'] ?? null,
            'explanation' => $entry['explanation'] ?? null,
            'url' => $entry['url'] ?? null,
            'hdurl' => $entry['hdurl'] ?? null,
            'thumbnail_url' => $entry['thumbnail_url'] ?? null,
            'media_type' => $entry['media_type'] ?? null,
            'service_version' => $entry['service_version'] ?? null,
            'copyright' => $entry['copyright'] ?? null,
        ];
    }
}
