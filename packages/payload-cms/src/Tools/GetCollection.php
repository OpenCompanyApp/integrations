<?php

namespace OpenCompany\Integrations\PayloadCms\Tools;

use OpenCompany\Integrations\PayloadCms\PayloadCmsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details about a specific collection by slug.
 */
class GetCollection implements Tool
{
    /**
     * @param  PayloadCmsService  $service  The Payload CMS API client
     */
    public function __construct(
        private PayloadCmsService $service,
    ) {}

    public function name(): string
    {
        return 'payload_cms_get_collection';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a specific collection by its slug.
        Returns field definitions, labels, default sort, and other configuration.
        MD;
    }

    public function parameters(): array
    {
        return [
            'slug' => ['type' => 'string', 'required' => true, 'description' => 'The slug of the collection to retrieve.'],
        ];
    }

    /**
     * Get a collection by slug.
     *
     * @param  array<string, mixed>  $args  Tool arguments (slug)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Payload CMS integration is not configured.');
            }

            $slug = $args['slug'] ?? '';

            if (empty($slug)) {
                return ToolResult::error('slug is required.');
            }

            $result = $this->service->getCollection($slug);

            $fields = [];
            foreach ($result['fields'] ?? [] as $field) {
                $fields[] = [
                    'name' => $field['name'] ?? '',
                    'type' => $field['type'] ?? '',
                    'required' => $field['required'] ?? false,
                    'localized' => $field['localized'] ?? false,
                ];
            }

            return ToolResult::success([
                'slug' => $result['slug'] ?? $slug,
                'labels' => $result['labels'] ?? [],
                'fields' => $fields,
                'defaultSort' => $result['defaultSort'] ?? null,
                'timestamps' => $result['timestamps'] ?? true,
                'versions' => $result['versions'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
