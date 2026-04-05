<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WufooListEntries implements Tool
{
    /**
     * Create a new WufooListEntries tool instance.
     */
    public function __construct(
        private WufooService $service,
    ) {}

    /**
     * Get the tool's machine name.
     */
    public function name(): string
    {
        return 'wufoo_list_entries';
    }

    /**
     * Get a description of what this tool does.
     */
    public function description(): string
    {
        return 'List entries submitted to a Wufoo form. Supports pagination with pageSize and pageStart parameters. Returns entry data with all field values.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or unique identifier.'],
            'page_size' => ['type' => 'integer', 'description' => 'Number of entries per page (default: 100, max: 100).'],
            'page_start' => ['type' => 'integer', 'description' => 'Entry index to start from (0-based, for pagination).'],
            'sort' => ['type' => 'string', 'description' => 'Sort direction by entry ID: "ASC" (oldest first) or "DESC" (newest first).'],
        ];
    }

    /**
     * Execute the tool and return a result.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wufoo integration is not configured.');
            }

            $formId = $args['form_id'];
            $pageSize = isset($args['page_size']) ? (int) $args['page_size'] : 100;
            $pageStart = isset($args['page_start']) ? (int) $args['page_start'] : 0;
            $sort = $args['sort'] ?? null;

            $result = $this->service->listEntries($formId, $pageSize, $pageStart, $sort);
            $entries = $result['Entries'] ?? [];

            return ToolResult::success([
                'entries' => $entries,
                'total' => count($entries),
                'page_size' => $pageSize,
                'page_start' => $pageStart,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
