<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single sitemap in Google Search Console.
 *
 * Returns the sitemap URL, type, last submitted date, last downloaded date, and any errors or warnings.
 */
class GscGetSitemap implements Tool
{
    public function __construct(
        private GoogleSearchConsoleService $service,
    ) {}

    public function name(): string
    {
        return 'gsc_get_sitemap';
    }

    public function description(): string
    {
        return 'Get details for a specific sitemap in Google Search Console, including indexing status and any errors.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'site_url' => ['type' => 'string', 'required' => true, 'description' => 'The site URL (e.g., "https://example.com/").'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The sitemap URL or ID (e.g., "https://example.com/sitemap.xml").'],
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

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter (sitemap URL) is required.');
            }

            $result = $this->service->getSitemap($args['site_url'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
