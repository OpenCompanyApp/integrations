<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Look up a brand by domain to retrieve logos, colors, fonts, and other brand assets.
 *
 * Returns the full brand record including all available assets (logos, colors, fonts,
 * images) associated with the given domain.
 */
class BrandfetchGetBrand implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_get_brand';
    }

    public function description(): string
    {
        return 'Look up a brand by its domain (e.g., "spotify.com") to retrieve logos, colors, fonts, and other brand assets. Returns the complete brand profile with all available assets.';
    }

    public function parameters(): array
    {
        return [
            'domain' => ['type' => 'string', 'required' => true, 'description' => 'The brand domain to look up (e.g., "spotify.com", "nike.com").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $result = $this->service->getBrand($args['domain']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
