<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Webflow sites the authenticated user has access to.
 */
class WebflowListSites implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_sites';
    }

    public function description(): string
    {
        return <<<'MD'
        List all Webflow sites the authenticated user has access to.
        Returns site IDs, names, domains, and publication status.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all sites accessible to the authenticated user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $result = $this->service->listSites();
            $sites = $result['sites'] ?? $result['data'] ?? $result;

            if (empty($sites)) {
                return ToolResult::success('No sites found.');
            }

            $output = [];
            foreach ($sites as $site) {
                $output[] = [
                    'id' => $site['id'] ?? '',
                    'name' => $site['name'] ?? '',
                    'shortName' => $site['shortName'] ?? '',
                    'domain' => $site['defaultDomain'] ?? '',
                    'publishedOn' => $site['lastPublished'] ?? null,
                ];
            }

            return ToolResult::success([
                'count' => count($output),
                'sites' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
