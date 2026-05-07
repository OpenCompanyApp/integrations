<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * Browse NASA's Near Earth Object dataset with pagination.
 */
class NasaBrowseAsteroids implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_browse_asteroids';
    }

    public function description(): string
    {
        return 'Browse the overall NASA Near Earth Object dataset. Use this when you need asteroid IDs before looking up a specific object.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Optional page number.'],
            'size' => ['type' => 'integer', 'description' => 'Optional page size.'],
        ];
    }

    /**
     * Browse Near Earth Objects.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, size).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NASA integration is not configured.');
            }

            return ToolResult::success($this->service->browseAsteroids(
                page: isset($args['page']) ? (int) $args['page'] : null,
                size: isset($args['size']) ? (int) $args['size'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
