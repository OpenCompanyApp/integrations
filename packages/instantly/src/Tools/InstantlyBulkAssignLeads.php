<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Bulk assign leads to organization users.
 */
class InstantlyBulkAssignLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_bulk_assign_leads';
    }

    public function description(): string
    {
        return 'Bulk assign leads to organization users.';
    }

    public function parameters(): array
    {
        return [
            'organization_user_ids' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated user IDs'],
            'campaign' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID filter'],
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'List ID filter'],
            'ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated lead IDs'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Max leads to assign'],
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

            $body = ['organization_user_ids' => array_map('trim', explode(',', $args['organization_user_ids']))]; foreach (['campaign','list_id','limit'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; if (isset($args['ids'])) $body['ids'] = array_map('trim', explode(',', $args['ids'])); $result = $this->service->bulkAssignLeads($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
