<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List inbox placement analytics for a test.
 */
class InstantlyListInboxPlacementAnalytics implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_inbox_placement_analytics';
    }

    public function description(): string
    {
        return 'List inbox placement analytics for a test.';
    }

    public function parameters(): array
    {
        return [
            'test_id' => ['type' => 'string', 'required' => true, 'description' => 'Test ID'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'date_from' => ['type' => 'string', 'required' => false, 'description' => 'Start date'],
            'date_to' => ['type' => 'string', 'required' => false, 'description' => 'End date'],
            'recipient_geo' => ['type' => 'string', 'required' => false, 'description' => 'Geo filter (comma-separated)'],
            'recipient_type' => ['type' => 'string', 'required' => false, 'description' => 'Type filter (comma-separated)'],
            'recipient_esp' => ['type' => 'string', 'required' => false, 'description' => 'ESP filter (comma-separated)'],
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

            $result = $params = []; foreach (['test_id','limit','starting_after','date_from','date_to','recipient_geo','recipient_type','recipient_esp'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $this->service->listInboxPlacementAnalytics($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
