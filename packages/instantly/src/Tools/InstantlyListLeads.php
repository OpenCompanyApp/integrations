<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List leads in a campaign or list.
 */
class InstantlyListLeads implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_leads';
    }

    public function description(): string
    {
        return 'List leads in a campaign or list.';
    }

    public function parameters(): array
    {
        return [
            'campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID'],
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'List ID'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page (1-100)'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search by email'],
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

            $body = []; foreach (['campaign_id','list_id','starting_after','search'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $body['limit'] = $args['limit'] ?? 10; $result = $this->service->listLeads($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
