<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all collections (CMS databases) for a given Webflow site.
 */
class WebflowListCollections implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_collections';
    }

    public function description(): string
    {
        return <<<'MD'
        List all collections (CMS databases) for a given Webflow site.
        Returns collection IDs, names, slugs, and field schemas.
        MD;
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow site.'],
        ];
    }

    /**
     * List all collections for a specific site.
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

            $result = $this->service->listCollections($siteId);
            $collections = $result['collections'] ?? $result['data'] ?? $result;

            if (empty($collections)) {
                return ToolResult::success('No collections found for this site.');
            }

            $output = [];
            foreach ($collections as $collection) {
                $output[] = [
                    'id' => $collection['id'] ?? '',
                    'name' => $collection['displayName'] ?? $collection['name'] ?? '',
                    'slug' => $collection['slug'] ?? '',
                ];
            }

            return ToolResult::success([
                'count' => count($output),
                'collections' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
