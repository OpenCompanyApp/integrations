<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List logos available for a specific brand.
 *
 * Returns all logo variants for the given brand, including different formats
 * (SVG, PNG), sizes, and themes (light, dark, icon).
 */
class BrandfetchListLogos implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_list_logos';
    }

    public function description(): string
    {
        return 'List all logo variants available for a brand. Returns logos in different formats (SVG, PNG), sizes, and themes (light, dark, icon).';
    }

    public function parameters(): array
    {
        return [
            'brand_id' => ['type' => 'string', 'required' => true, 'description' => 'The brand identifier obtained from a brand search or lookup.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of logos to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $result = $this->service->listLogos($args['brand_id'], $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
