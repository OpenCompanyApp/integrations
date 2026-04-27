<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Delete block list entries in bulk by ID.
 */
class InstantlyBulkDeleteBlocklistEntries implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_bulk_delete_blocklist_entries';
    }

    public function description(): string
    {
        return 'Delete block list entries in bulk by entry ID.';
    }

    public function parameters(): array
    {
        return [
            'ids' => ['type' => 'array', 'required' => true, 'description' => 'Block list entry IDs to delete', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * Bulk delete block list entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $ids = $args['ids'];
            if (is_string($ids)) {
                $ids = array_filter(array_map('trim', explode(',', $ids)));
            }

            return ToolResult::success($this->service->bulkDeleteBlocklistEntries(['ids' => $ids]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
