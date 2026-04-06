<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sitemaps submitted for a site in Google Search Console.
 *
 * Returns a paginated list of sitemap entries including URL, type, last submitted, and status.
 */
class GscListSitemaps implements Tool
{
    public function __construct(
        private GoogleSearchConsoleService $service,
    ) {}

    public function name(): string
    {
        return 'gsc_list_sitemaps';
    }

    public function description(): string
    {
        return 'List sitemaps submitted for a site in Google Search Console. Returns sitemap URLs, types, and indexing status.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'site_url' => ['type' => 'string', 'required' => true, 'description' => 'The site URL (e.g., "https://example.com/").'],
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of results per page.'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results, from a previous response.'],
            'shortUrls' => ['type' => 'boolean', 'description' => 'Whether to return short URLs for sitemaps.'],
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

            $result = $this->service->listSitemaps(
                siteUrl: $args['site_url'],
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
                pageToken: $args['pageToken'] ?? null,
                shortUrls: isset($args['shortUrls']) ? (bool) $args['shortUrls'] : null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
