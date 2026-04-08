<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query search analytics data for a site in Google Search Console.
 *
 * Returns clicks, impressions, CTR, and position data grouped by the specified dimensions
 * (e.g., query, page, country, device) for a given date range.
 */
class GscListSearchAnalytics implements Tool
{
    public function __construct(
        private GoogleSearchConsoleService $service,
    ) {}

    public function name(): string
    {
        return 'gsc_list_search_analytics';
    }

    public function description(): string
    {
        return 'Query search performance data from Google Search Console — clicks, impressions, CTR, and average position. Group by dimensions like query, page, country, or device.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'site_url' => ['type' => 'string', 'required' => true, 'description' => 'The site URL (e.g., "https://example.com/").'],
            'startDate' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format (e.g., "2025-01-01").'],
            'endDate' => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format (e.g., "2025-01-31").'],
            'dimensions' => ['type' => 'array', 'description' => 'Dimensions to group results by: "query", "page", "country", "device", "searchAppearance".'],
            'type' => ['type' => 'string', 'description' => 'Search type filter: "web", "image", "video", or "news". Defaults to "web".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Search Console integration is not configured.');
            }

            if (empty($args['site_url'])) {
                return ToolResult::error('The "site_url" parameter is required.');
            }

            if (empty($args['startDate'])) {
                return ToolResult::error('The "startDate" parameter is required.');
            }

            if (empty($args['endDate'])) {
                return ToolResult::error('The "endDate" parameter is required.');
            }

            $result = $this->service->listSearchAnalytics(
                siteUrl: $args['site_url'],
                startDate: $args['startDate'],
                endDate: $args['endDate'],
                dimensions: $args['dimensions'] ?? null,
                type: $args['type'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
