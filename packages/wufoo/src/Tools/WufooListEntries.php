<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list entries for a specific Wufoo form with pagination and filters.
 *
 * Calls GET /forms/{id}/entries.json on the Wufoo API. Supports pagination
 * via page/pageSize parameters and optional field-based filters.
 */
class WufooListEntries implements Tool
{
    /**
     * Create a new WufooListEntries tool instance.
     *
     * @param  WufooService  $service  The Wufoo API service instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wufoo_list_entries';
    }

    /**
     * Get the human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List entries submitted to a Wufoo form. Supports pagination and optional filters to narrow results. Use the page and pageSize parameters to paginate through large result sets.';
    }

    /**
     * Get the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or identifier to list entries for.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-based). Default: 0.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of entries per page. Default: 25, maximum: 100.'],
            'filters' => ['type' => 'object', 'description' => 'Optional field filters. Keys are filter parameters (e.g., "Filter1", "Match", "SortBy") and values are the filter values.'],
        ];
    }

    /**
     * Execute the list entries operation.
     *
     * @param  array<string, mixed>  $args  The tool arguments. Must contain 'form_id'.
     * @return ToolResult The result containing the paginated list of entries or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 25;
            $filters = $args['filters'] ?? [];

            if (!is_array($filters)) {
                $filters = [];
            }

            $result = $this->service->listEntries($formId, $page, $pageSize, $filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
