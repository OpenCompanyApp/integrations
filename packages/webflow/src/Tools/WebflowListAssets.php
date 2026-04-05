<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all assets uploaded to a Webflow site.
 */
class WebflowListAssets implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_assets';
    }

    public function description(): string
    {
        return <<<'MD'
        List all assets uploaded to a Webflow site.
        Returns asset IDs, filenames, URLs, and file metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow site.'],
        ];
    }

    /**
     * List all assets for a specific site.
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

            $result = $this->service->listAssets($siteId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
