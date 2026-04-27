<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List inbox placement blacklist and SpamAssassin reports.
 */
class InstantlyListInboxPlacementReports implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_inbox_placement_reports';
    }

    public function description(): string
    {
        return 'List inbox placement blacklist and SpamAssassin reports.';
    }

    public function parameters(): array
    {
        return [
            'test_id' => ['type' => 'string', 'required' => true, 'description' => 'Test ID'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'date_from' => ['type' => 'string', 'required' => false, 'description' => 'Start date'],
            'date_to' => ['type' => 'string', 'required' => false, 'description' => 'End date'],
            'skip_spam_assassin_report' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip SpamAssassin report'],
            'skip_blacklist_report' => ['type' => 'boolean', 'required' => false, 'description' => 'Skip blacklist report'],
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

            $params = []; foreach (['test_id','limit','starting_after','date_from','date_to','skip_spam_assassin_report','skip_blacklist_report'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->listInboxPlacementReports($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
