<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List custom tags used to organize accounts and campaigns.
 */
class InstantlyListCustomTags implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_list_custom_tags';
    }

    public function description(): string
    {
        return 'List custom tags used to organize accounts and campaigns.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Items per page'],
            'starting_after' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor'],
            'search' => ['type' => 'string', 'required' => false, 'description' => 'Search by label'],
            'resource_ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated resource IDs'],
            'tag_ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated tag IDs'],
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

            $params = []; foreach (['limit','starting_after','search','resource_ids','tag_ids'] as $k) if (isset($args[$k])) $params[$k] = $args[$k]; $result = $this->service->listCustomTags($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
