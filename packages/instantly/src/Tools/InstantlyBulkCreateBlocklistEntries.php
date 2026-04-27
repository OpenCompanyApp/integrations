<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Create block list entries in bulk.
 */
class InstantlyBulkCreateBlocklistEntries implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_bulk_create_blocklist_entries';
    }

    public function description(): string
    {
        return 'Create block list entries in bulk from domains or email addresses.';
    }

    public function parameters(): array
    {
        return [
            'bl_values' => ['type' => 'array', 'required' => true, 'description' => 'Domains or email addresses to block', 'items' => ['type' => 'string']],
        ];
    }

    /**
     * Bulk create block list entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $values = $args['bl_values'];
            if (is_string($values)) {
                $values = array_filter(array_map('trim', explode(',', $values)));
            }

            return ToolResult::success($this->service->bulkCreateBlocklistEntries(['bl_values' => $values]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
