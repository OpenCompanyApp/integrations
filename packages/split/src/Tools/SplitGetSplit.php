<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitGetSplit implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_get_split';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Split feature split, including its definition and traffic allocation.';
    }

    public function parameters(): array
    {
        return [
            'split_name' => ['type' => 'string', 'required' => true, 'description' => 'The split name (e.g., "new-checkout-flow").'],
            'workspace_id' => ['type' => 'string', 'description' => 'The workspace ID (defaults to the configured workspace).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            if (empty($args['split_name'])) {
                return ToolResult::error('The split_name parameter is required.');
            }

            $workspaceId = $args['workspace_id'] ?? null;
            $result = $this->service->getSplit($args['split_name'], $workspaceId);

            return ToolResult::success([
                'name' => $result['name'] ?? '',
                'description' => $result['description'] ?? '',
                'trafficTypeName' => $result['trafficTypeName'] ?? '',
                'createdAt' => $result['createdAt'] ?? null,
                'rolloutStatus' => $result['rolloutStatus'] ?? null,
                'killed' => $result['killed'] ?? false,
                'treatments' => $result['treatments'] ?? [],
                'defaultTreatment' => $result['defaultTreatment'] ?? '',
                'baselineTreatment' => $result['baselineTreatment'] ?? '',
                'tags' => $result['tags'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
