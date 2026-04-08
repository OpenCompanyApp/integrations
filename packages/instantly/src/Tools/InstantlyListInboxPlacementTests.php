<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List inbox placement tests.
 */
class InstantlyListInboxPlacementTests implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_inbox_placement_tests';
    }

    public function description(): string
    {
        return 'List inbox placement tests.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search filter'],
            'status' => ['type' => 'integer', 'required' => false, 'description' => 'Status filter'],
            'sort_order' => ['type' => 'string', 'required' => false, 'description' => 'Sort order'],
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

            $result = $params = []; foreach (['limit','starting_after','search','status','sort_order'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $this->service->listInboxPlacementTests($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
