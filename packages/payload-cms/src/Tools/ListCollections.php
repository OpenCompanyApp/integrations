<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all collections in the Payload CMS instance.
 */
class ListCollections implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_list_collections';
    }

    public function description(): string
    {
        return <<<'MD'
        List all collections defined in the Payload CMS instance.
        Returns each collection's slug, labels, and field configuration.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List collections.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Payload CMS integration is not configured.');
            }

            $result = $this->service->listCollections();
            $collections = $result['collections'] ?? $result['docs'] ?? $result;

            if (empty($collections)) {
                return ToolResult::success('No collections found.');
            }

            $output = [];
            foreach ($collections as $collection) {
                $output[] = [
                    'slug' => $collection['slug'] ?? '',
                    'labels' => $collection['labels'] ?? [],
                    'fields' => count($collection['fields'] ?? []),
                ];
            }

            return ToolResult::success([
                'total' => count($output),
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
