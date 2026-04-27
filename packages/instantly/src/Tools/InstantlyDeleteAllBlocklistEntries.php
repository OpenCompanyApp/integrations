<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Delete all block list entries matching optional filters.
 *
 * Requires explicit confirmation because this is a destructive workspace-wide
 * operation when no filters are supplied.
 */
class InstantlyDeleteAllBlocklistEntries implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_delete_all_blocklist_entries';
    }

    public function description(): string
    {
        return 'Delete all block list entries matching optional filters. Requires confirm=true.';
    }

    public function parameters(): array
    {
        return [
            'confirm' => ['type' => 'boolean', 'required' => true, 'description' => 'Must be true to perform this destructive operation'],
            'domains_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Only delete domain blocklist entries'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Only delete entries matching this value'],
        ];
    }

    /**
     * Delete all matching block list entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }
            if (($args['confirm'] ?? false) !== true) {
                return ToolResult::error('Set confirm=true to delete block list entries.');
            }

            $params = [];
            foreach (['domains_only', 'search'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->deleteAllBlocklistEntries($params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
