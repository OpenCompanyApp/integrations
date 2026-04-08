<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List background jobs. Track long-running tasks like bulk imports and exports.
 */
class InstantlyListBackgroundJobs implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_background_jobs';
    }

    public function description(): string
    {
        return 'List background jobs. Track long-running tasks like bulk imports and exports.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated job IDs'],
            'type' => ['type' => 'string', 'required' => false, 'description' => 'Job type'],
            'entity_type' => ['type' => 'string', 'required' => false, 'description' => 'Entity type'],
            'entity_id' => ['type' => 'string', 'required' => false, 'description' => 'Entity ID'],
            'status' => ['type' => 'string', 'required' => false, 'description' => 'Status filter'],
            'sort_column' => ['type' => 'string', 'required' => false, 'description' => 'Sort column'],
            'sort_order' => ['type' => 'string', 'required' => false, 'description' => 'Sort order (asc/desc)'],
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

            $result = $params = []; foreach (['limit','starting_after','ids','type','entity_type','entity_id','status','sort_column','sort_order'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $this->service->listBackgroundJobs($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
