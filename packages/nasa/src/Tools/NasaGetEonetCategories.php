<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * List EONET v3 natural event categories.
 */
class NasaGetEonetCategories implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_eonet_categories';
    }

    public function description(): string
    {
        return 'List NASA EONET v3 natural event categories for filtering event searches.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List EONET categories.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->getEonetCategories());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
