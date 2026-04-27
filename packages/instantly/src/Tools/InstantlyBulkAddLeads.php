<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add leads in bulk to a campaign or list.
 */
class InstantlyBulkAddLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_bulk_add_leads';
    }

    public function description(): string
    {
        return 'Add leads in bulk to a campaign or list.';
    }

    public function parameters(): array
    {
        return [
            'leads' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of lead objects'],
            'campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID'],
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'List ID'],
            'skip_if_in_workspace' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip existing leads'],
            'skip_if_in_campaign' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip leads in campaign'],
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

            $leads = $args['leads']; if (is_string($leads)) $leads = json_decode($leads, true); $body = ['leads' => $leads]; foreach (['campaign_id','list_id','skip_if_in_workspace','skip_if_in_campaign'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->bulkAddLeads($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
