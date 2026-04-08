<?php

namespace OpenCompany\Integrations\Contentful\Tools;

use OpenCompany\Integrations\Contentful\ContentfulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List entries in the Contentful space, optionally filtered by content type.
 */
class ContentfulListEntries implements Tool
{
    /**
     * @param  ContentfulService  $service  The Contentful API client
     */
    public function __construct(
        private ContentfulService $service,
    ) {}

    public function name(): string
    {
        return 'contentful_list_entries';
    }

    public function description(): string
    {
        return <<<'MD'
        List entries in the Contentful space. Optionally filter by content type, control pagination
        with limit and skip, order results, or search with a text query.
        Returns entry IDs, content types, and localized field values.
        MD;
    }

    public function parameters(): array
    {
        return [
            'content_type' => ['type' => 'string', 'description' => 'Filter entries by content type ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of entries to return (default 100, max 1000).'],
            'skip' => ['type' => 'integer', 'description' => 'Number of entries to skip for pagination.'],
            'order' => ['type' => 'string', 'description' => 'Order entries by field. Prefix with "-" for descending. E.g. "sys.createdAt" or "-sys.updatedAt".'],
            'query' => ['type' => 'string', 'description' => 'Full-text search query to filter entries.'],
        ];
    }

    /**
     * List entries with optional filtering, pagination, and ordering.
     *
     * @param  array<string, mixed>  $args  Tool arguments (content_type, limit, skip, order, query)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Contentful integration is not configured.');
            }

            $params = [];

            if (isset($args['content_type']) && ! empty($args['content_type'])) {
                $params['content_type'] = $args['content_type'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 1000);
            }

            if (isset($args['skip'])) {
                $params['skip'] = (int) $args['skip'];
            }

            if (isset($args['order']) && ! empty($args['order'])) {
                $params['order'] = $args['order'];
            }

            if (isset($args['query']) && ! empty($args['query'])) {
                $params['query'] = $args['query'];
            }

            $result = $this->service->listEntries($params);
            $items = $result['items'] ?? [];

            if (empty($items)) {
                return ToolResult::success('No entries found.');
            }

            $output = [];
            foreach ($items as $item) {
                $output[] = [
                    'id' => $item['sys']['id'] ?? '',
                    'content_type' => $item['sys']['contentType']['sys']['id'] ?? '',
                    'created_at' => $item['sys']['createdAt'] ?? null,
                    'updated_at' => $item['sys']['updatedAt'] ?? null,
                    'version' => $item['sys']['version'] ?? null,
                    'fields' => $item['fields'] ?? [],
                ];
            }

            return ToolResult::success([
                'total' => $result['total'] ?? count($output),
                'count' => count($output),
                'skip' => $result['skip'] ?? 0,
                'limit' => $result['limit'] ?? 100,
                'items' => $output,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
