<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Publish a Webflow site, making the latest changes live.
 */
class WebflowPublishSite implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_publish_site';
    }

    public function description(): string
    {
        return <<<'MD'
        Publish a Webflow site, making the latest staged changes live.
        Provide the site ID to publish.
        MD;
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow site to publish.'],
        ];
    }

    /**
     * Publish a site by its ID.
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

            $result = $this->service->publishSite($siteId);

            return ToolResult::success([
                'published' => true,
                'site_id' => $siteId,
                'queued' => $result['queued'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
