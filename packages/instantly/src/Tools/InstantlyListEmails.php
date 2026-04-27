<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List emails from the Unibox (unified inbox).
 */
class InstantlyListEmails implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_emails';
    }

    public function description(): string
    {
        return 'List emails from the Unibox (unified inbox).';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search by email'],
            'campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Filter by campaign'],
            'label' => ['type' => 'integer', 'required' => false, 'description' => 'Filter by label'],
            'assigned_to' => ['type' => 'string', 'required' => false, 'description' => 'Filter by assignee'],
            'type' => ['type' => 'string', 'required' => false, 'description' => 'Email type filter'],
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

            $params = []; foreach (['limit','starting_after','search','campaign_id','label','assigned_to','type'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->listEmails($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
