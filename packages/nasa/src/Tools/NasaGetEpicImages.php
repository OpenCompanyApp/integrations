<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * Fetch EPIC Earth image metadata and available dates.
 */
class NasaGetEpicImages implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_epic_images';
    }

    public function description(): string
    {
        return 'Get NASA EPIC image metadata for latest images, a specific date, or all available dates from the natural or enhanced collection.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'description' => 'EPIC collection: natural or enhanced. Defaults to natural.'],
            'date' => ['type' => 'string', 'description' => 'Optional date in YYYY-MM-DD format.'],
            'all_dates' => ['type' => 'boolean', 'description' => 'When true, return all available dates instead of image metadata.'],
        ];
    }

    /**
     * Fetch EPIC metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection, date, all_dates).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            return ToolResult::success($this->service->getEpicImages(
                collection: (string) ($args['collection'] ?? 'natural'),
                date: $args['date'] ?? null,
                allDates: (bool) ($args['all_dates'] ?? false),
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
