<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Inspect URLs for a site in Google Search Console.
 *
 * Returns indexing status, crawl errors, and other inspection results for URLs
 * associated with the specified site.
 */
class GscListUrlInspection implements Tool
{
    public function __construct(
        private GoogleSearchConsoleService $service,
    ) {}

    public function name(): string
    {
        return 'gsc_list_url_inspection';
    }

    public function description(): string
    {
        return 'Inspect URLs for a site in Google Search Console. Returns indexing status, crawl information, and any detected issues.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'site_url' => ['type' => 'string', 'required' => true, 'description' => 'The site URL (e.g., "https://example.com/").'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results, from a previous response.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of URL inspection results to return.'],
            'inspectionResult' => ['type' => 'string', 'description' => 'Filter by inspection result status (e.g., "PASS", "FAIL", "WARNING").'],
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

            $result = $this->service->listUrlInspection(
                siteUrl: $args['site_url'],
                pageToken: $args['pageToken'] ?? null,
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                inspectionResult: $args['inspectionResult'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
