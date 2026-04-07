<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Duplicate a subsequence to the same or different campaign.
 */
class InstantlyDuplicateSubsequence implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_duplicate_subsequence';
    }

    public function description(): string
    {
        return 'Duplicate a subsequence to the same or different campaign.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Subsequence ID'],
            'parent_campaign' => ['type' => 'string', 'required' => true, 'description' => 'Target campaign ID'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name for copy'],
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

            $result = $this->service->duplicateSubsequence($args['id'], ['parent_campaign' => $args['parent_campaign'], 'name' => $args['name']]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
