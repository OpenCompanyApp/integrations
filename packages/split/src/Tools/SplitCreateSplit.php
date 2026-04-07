<?php

namespace OpenCompany\Integrations\Split\Tools;

use OpenCompany\Integrations\Split\SplitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SplitCreateSplit implements Tool
{
    public function __construct(
        private SplitService $service,
    ) {}

    public function name(): string
    {
        return 'split_create_split';
    }

    public function description(): string
    {
        return 'Create a new feature split in a Split workspace. Specify a name, traffic type, and optional description.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The split name (e.g., "new-checkout-flow").'],
            'traffic_type_name' => ['type' => 'string', 'required' => true, 'description' => 'The traffic type name (e.g., "user", "account").'],
            'description' => ['type' => 'string', 'description' => 'Optional description for the split.'],
            'workspace_id' => ['type' => 'string', 'description' => 'The workspace ID (defaults to the configured workspace).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Split integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The name parameter is required.');
            }

            if (empty($args['traffic_type_name'])) {
                return ToolResult::error('The traffic_type_name parameter is required.');
            }

            $workspaceId = $args['workspace_id'] ?? null;
            $description = $args['description'] ?? null;
            $result = $this->service->createSplit(
                $args['name'],
                $args['traffic_type_name'],
                $description,
                $workspaceId,
            );

            return ToolResult::success([
                'name' => $result['name'] ?? $args['name'],
                'description' => $result['description'] ?? $description,
                'trafficTypeName' => $result['trafficTypeName'] ?? $args['traffic_type_name'],
                'createdAt' => $result['createdAt'] ?? null,
                'message' => "Split '{$args['name']}' has been created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
