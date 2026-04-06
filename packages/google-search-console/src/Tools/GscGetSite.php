<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a single site in Google Search Console.
 *
 * Returns the site URL and the user's permission level.
 */
class GscGetSite implements Tool
{
    public function __construct(
        private GoogleSearchConsoleService $service,
    ) {}

    public function name(): string
    {
        return 'gsc_get_site';
    }

    public function description(): string
    {
        return 'Get details for a specific site in Google Search Console, including permission level.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The site URL (e.g., "https://example.com/").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Search Console integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The "id" parameter (site URL) is required.');
            }

            $result = $this->service->getSite($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
