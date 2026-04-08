<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List and filter items in a Podio app.
 *
 * Supports filtering by field values, sorting, and pagination.
 * Returns item IDs, titles, field values, and metadata.
 */
class PodioListItems implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_list_items';
    }

    public function description(): string
    {
        return 'List and filter items in a Podio app. Supports filtering by field values, sorting, and pagination. Use podio_get_app first to understand the available fields for filtering.';
    }

    public function parameters(): array
    {
        return [
            'app_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Podio app ID to list items from.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 20, max: 500).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
            'sort_by' => ['type' => 'string', 'description' => 'The field to sort by. Use "created_on" or "last_event_on" for built-in sorting, or a field external ID.'],
            'sort_desc' => ['type' => 'boolean', 'description' => 'Sort in descending order (default: true).'],
            'filters' => ['type' => 'string', 'description' => 'JSON-encoded filter object. Keys are field external IDs, values are the filter criteria. Example: \'{"title":"My Item"}\''],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $appId = (int) $args['app_id'];

            $params = [];
            $params['limit'] = isset($args['limit']) ? min((int) $args['limit'], 500) : 20;
            $params['offset'] = isset($args['offset']) ? (int) $args['offset'] : 0;

            if (isset($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }

            if (isset($args['sort_desc'])) {
                $params['sort_desc'] = (bool) $args['sort_desc'];
            }

            if (isset($args['filters'])) {
                $filters = $args['filters'];
                $params['filters'] = is_string($filters) ? json_decode($filters, true) : $filters;
            }

            $result = $this->service->listItems($appId, $params);

            $items = $result['items'] ?? [];
            $total = $result['total'] ?? count($items);
            $filtered = $result['filtered'] ?? $total;

            $formatted = array_map(function (array $item): array {
                $fields = [];
                foreach ($item['fields'] ?? [] as $field) {
                    $fields[$field['external_id'] ?? $field['field_id'] ?? 'unknown'] = [
                        'type' => $field['type'] ?? null,
                        'values' => $field['values'] ?? [],
                    ];
                }

                return [
                    'item_id' => $item['item_id'] ?? null,
                    'title' => $item['title'] ?? null,
                    'app_item_id' => $item['app_item_id'] ?? null,
                    'app_item_id_formatted' => $item['app_item_id_formatted'] ?? null,
                    'created_on' => $item['created_on'] ?? null,
                    'last_event_on' => $item['last_event_on'] ?? null,
                    'fields' => $fields,
                ];
            }, $items);

            return ToolResult::success([
                'items' => $formatted,
                'total' => $total,
                'filtered' => $filtered,
                'count' => count($formatted),
                'offset' => $params['offset'],
                'limit' => $params['limit'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
