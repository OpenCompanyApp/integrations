<?php

namespace OpenCompany\Integrations\GoogleSearchConsole\Tools;

use OpenCompany\Integrations\GoogleSearchConsole\GoogleSearchConsoleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List sites the authenticated user has access to in Google Search Console.
 *
 * Returns a paginated list of site entries including site URL and permission level.
 */
class GscListSites implements Tool
{
    public function __construct(
        private GoogleSearchConsoleService $service,
    ) {}

    public function name(): string
    {
        return 'gsc_list_sites';
    }

    public function description(): string
    {
        return 'List all sites the authenticated user has access to in Google Search Console. Returns site URLs and permission levels.';
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of results per page.'],
            'pageToken' => ['type' => 'string', 'description' => 'Token for the next page of results, from a previous response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Search Console integration is not configured.');
            }

            $result = $this->service->listSites(
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
                pageToken: $args['pageToken'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
