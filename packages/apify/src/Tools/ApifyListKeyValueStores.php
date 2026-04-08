<?php

namespace OpenCompany\Integrations\Apify\Tools;

use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List key-value stores accessible to the authenticated Apify user.
 *
 * Key-value stores are used by actors to store outputs like screenshots,
 * PDF files, or arbitrary JSON data keyed by string names.
 */
class ApifyListKeyValueStores implements Tool
{
    public function __construct(
        private ApifyService $service,
    ) {}

    public function name(): string
    {
        return 'apify_list_key_value_stores';
    }

    public function description(): string
    {
        return 'List Apify key-value stores accessible to the authenticated user. Key-value stores hold actor outputs like screenshots, PDFs, or JSON results. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'offset' => ['type' => 'integer', 'description' => 'Number of stores to skip (default: 0).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of stores to return (default: 20, max: 1000).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Apify integration is not configured.');
            }

            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listKeyValueStores($offset, $limit);

            $data = $result['data'] ?? $result;
            $items = $data['items'] ?? $data;

            $stores = array_map(function (array $store): array {
                return [
                    'id' => $store['id'] ?? null,
                    'name' => $store['name'] ?? null,
                    'actId' => $store['actId'] ?? null,
                    'actRunId' => $store['actRunId'] ?? null,
                    'createdAt' => $store['createdAt'] ?? null,
                    'accessedAt' => $store['accessedAt'] ?? null,
                    'modifiedAt' => $store['modifiedAt'] ?? null,
                ];
            }, is_array($items) ? $items : []);

            return ToolResult::success([
                'stores' => $stores,
                'total' => $data['total'] ?? count($stores),
                'offset' => $offset,
                'count' => count($stores),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
