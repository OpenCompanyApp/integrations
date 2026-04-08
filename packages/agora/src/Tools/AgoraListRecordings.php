<?php

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AgoraListRecordings implements Tool
{
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_list_recordings';
    }

    public function description(): string
    {
        return 'List cloud recordings from Agora with optional filters. Supports filtering by channel name, resource ID, and time range.';
    }

    public function parameters(): array
    {
        return [
            'cname' => ['type' => 'string', 'description' => 'Filter recordings by channel name.'],
            'resource_id' => ['type' => 'string', 'description' => 'Filter by resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of recordings to return (default: 20).'],
            'start_ts' => ['type' => 'integer', 'description' => 'Unix timestamp to filter recordings starting after this time.'],
            'end_ts' => ['type' => 'integer', 'description' => 'Unix timestamp to filter recordings ending before this time.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            $filters = [];
            $filterKeys = ['cname', 'resource_id', 'limit', 'start_ts', 'end_ts'];

            foreach ($filterKeys as $key) {
                if (isset($args[$key])) {
                    $filters[$key] = $args[$key];
                }
            }

            $result = $this->service->listRecordings($filters);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
