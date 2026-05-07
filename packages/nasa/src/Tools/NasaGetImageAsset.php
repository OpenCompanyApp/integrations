<?php

namespace OpenCompany\Integrations\Nasa\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Nasa\NasaService;

/**
 * Retrieve NASA Image Library asset manifests.
 */
class NasaGetImageAsset implements Tool
{
    /**
     * @param  NasaService  $service  The NASA API client.
     */
    public function __construct(private NasaService $service) {}

    public function name(): string
    {
        return 'nasa_get_image_asset';
    }

    public function description(): string
    {
        return 'Get a NASA Image and Video Library asset manifest by NASA media ID, including downloadable asset URLs.';
    }

    public function parameters(): array
    {
        return [
            'nasa_id' => ['type' => 'string', 'required' => true, 'description' => 'NASA media ID returned by nasa_search_images.'],
        ];
    }

    /**
     * Fetch an Image Library asset manifest.
     *
     * @param  array<string, mixed>  $args  Tool arguments (nasa_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            return ToolResult::success($this->service->getImageAsset((string) $args['nasa_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
