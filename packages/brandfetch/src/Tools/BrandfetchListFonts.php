<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List fonts used by a specific brand.
 *
 * Returns the typography information for the given brand, including
 * font families, weights, and usage (heading, body, etc.).
 */
class BrandfetchListFonts implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_list_fonts';
    }

    public function description(): string
    {
        return 'List the fonts used by a brand. Returns font families, weights, and usage context (heading, body, etc.).';
    }

    public function parameters(): array
    {
        return [
            'brand_id' => ['type' => 'string', 'required' => true, 'description' => 'The brand identifier obtained from a brand search or lookup.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of fonts to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $result = $this->service->listFonts($args['brand_id'], $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
