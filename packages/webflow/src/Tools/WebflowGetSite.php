<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve details for a specific Webflow site by its ID.
 */
class WebflowGetSite implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_get_site';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve details for a specific Webflow site by its ID.
        Returns the site name, domains, publication status, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow site.'],
        ];
    }

    /**
     * Get details for a specific site by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';

            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $result = $this->service->getSite($siteId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
