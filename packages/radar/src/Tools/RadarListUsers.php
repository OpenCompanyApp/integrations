<?php

namespace OpenCompany\Integrations\Radar\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolResult;
use OpenCompany\Integrations\Radar\RadarService;

class RadarListUsers implements Tool
{
    public function __construct(private RadarService $service) {}

    public function name(): string
    {
        return 'radar_list_users';
    }

    public function description(): string
    {
        return 'List users from Radar with optional filters for tags and pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of results to return (default: 100, max: 1000)'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response'],
            'tags' => ['type' => 'string', 'description' => 'Filter users by tags (comma-separated)'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Radar integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['limit', 'cursor', 'tags'];
            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listUsers($filters);
            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
