<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List brand colors for a specific brand.
 *
 * Returns the official color palette for the given brand, including
 * hex values, color types (primary, secondary, accent, background),
 * and usage context.
 */
class BrandfetchListColors implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_list_colors';
    }

    public function description(): string
    {
        return 'List the official brand colors (hex values) for a brand. Returns color types such as primary, secondary, accent, dark, and light.';
    }

    public function parameters(): array
    {
        return [
            'brand_id' => ['type' => 'string', 'required' => true, 'description' => 'The brand identifier obtained from a brand search or lookup.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of colors to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $result = $this->service->listColors($args['brand_id'], $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
