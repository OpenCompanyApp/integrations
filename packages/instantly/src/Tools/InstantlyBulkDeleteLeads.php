<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete multiple leads in bulk.
 */
class InstantlyBulkDeleteLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_bulk_delete_leads';
    }

    public function description(): string
    {
        return 'Delete multiple leads in bulk.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID'],
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'List ID'],
            'ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated lead IDs'],
            'status' => ['type' => 'integer', 'required' => false, 'description' => 'Only delete leads with this status'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Max leads to delete'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $body = []; foreach (['campaign_id','list_id','status','limit'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; if (isset($args['ids'])) $body['ids'] = array_map('trim', explode(',', $args['ids'])); $this->service->bulkDeleteLeads($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
