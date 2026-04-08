<?php

namespace OpenCompany\Integrations\ZohoBooks\Tools;

use OpenCompany\Integrations\ZohoBooks\ZohoBooksService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: zohobooks_list_items
 *
 * Lists items (products and services) from Zoho Books with
 * optional filtering and pagination.
 */
class ZohoBooksListItems implements Tool
{
    /**
     * @param  ZohoBooksService  $service  The Zoho Books API service instance.
     */
    public function __construct(
        private ZohoBooksService $service,
    ) {}

    /**
     * The tool identifier used by the AI agent runtime.
     */
    public function name(): string
    {
        return 'zohobooks_list_items';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List items (products and services) from Zoho Books. Returns a paginated list with optional filters.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'filter_type' => ['type' => 'string', 'description' => 'Filter by item type: active, inactive, sales, purchases, or all.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of items per page (default: 25, max: 200).'],
            'search_text' => ['type' => 'string', 'description' => 'Search items by name or description.'],
        ];
    }

    /**
     * Execute the tool call — list items from Zoho Books.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zoho Books integration is not configured. Provide an access token and organization ID.');
            }

            $params = [];

            if (isset($args['filter_type'])) {
                $params['filter_type'] = $args['filter_type'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = min((int) $args['per_page'], 200);
            }
            if (isset($args['search_text'])) {
                $params['search_text'] = $args['search_text'];
            }

            $result = $this->service->listItems($params);

            $items = $result['items'] ?? [];
            $pageContext = $result['page_context'] ?? [];

            return ToolResult::success([
                'items' => $items,
                'total' => $pageContext['total'] ?? count($items),
                'page' => $pageContext['page'] ?? 1,
                'per_page' => $pageContext['per_page'] ?? 25,
                'has_more' => $pageContext['has_more_page'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
