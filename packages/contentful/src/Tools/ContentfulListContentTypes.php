<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all content types in the Contentful space.
 */
class ContentfulListContentTypes implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_list_content_types';
    }

    public function description(): string
    {
        return <<<'MD'
        List all content types defined in the connected Contentful space.
        Returns each content type's ID, name, description, and field count.
        Optionally limit the number of results.
        MD;
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of content types to return (default 100).'],
        ];
    }

    /**
     * List content types in the connected space.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $result = $this->service->listContentTypes($params);
            $items = $result['items'] ?? [];

            if (empty($items)) {
                return ToolResult::success('No content types found.');
            }

            $output = [];
            foreach ($items as $item) {
                $output[] = [
                    'id' => $item['sys']['id'] ?? '',
                    'name' => $item['name'] ?? '',
                    'description' => $item['description'] ?? '',
                    'display_field' => $item['displayField'] ?? '',
                    'field_count' => count($item['fields'] ?? []),
                ];
            }

            return ToolResult::success([
                'total' => $result['total'] ?? count($output),
                'count' => count($output),
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
