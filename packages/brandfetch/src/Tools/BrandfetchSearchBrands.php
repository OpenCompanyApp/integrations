<?php

namespace OpenCompany\Integrations\Brandfetch\Tools;

use OpenCompany\Integrations\Brandfetch\BrandfetchService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for brands by name or domain.
 *
 * Returns a list of matching brands with basic information such as name,
 * domain, and logo URL. Use the brand ID from results to fetch detailed
 * assets (logos, colors, fonts).
 */
class BrandfetchSearchBrands implements Tool
{
    public function __construct(
        private BrandfetchService $service,
    ) {}

    public function name(): string
    {
        return 'brandfetch_search_brands';
    }

    public function description(): string
    {
        return 'Search for brands by name or domain. Returns a list of matching brands with basic info. Use the brand ID from results to fetch detailed assets like logos, colors, and fonts.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search term — brand name or domain (e.g., "Nike", "spotify.com").'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Brandfetch integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $result = $this->service->searchBrands($args['query'], $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
