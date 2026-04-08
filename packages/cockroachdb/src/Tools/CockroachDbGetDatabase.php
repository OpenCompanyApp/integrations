<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

use OpenCompany\Integrations\CockroachDb\CockroachDbService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CockroachDbGetDatabase implements Tool
{
    public function __construct(
        private CockroachDbService $service,
    ) {}

    public function name(): string
    {
        return 'cockroachdb_get_database';
    }

    public function description(): string
    {
        return 'Get details for a specific database in a CockroachDB cluster. Returns table list, sizes, and configuration.';
    }

    public function parameters(): array
    {
        return [
            'cluster_id' => ['type' => 'string', 'required' => true, 'description' => 'The cluster ID.'],
            'database_name' => ['type' => 'string', 'required' => true, 'description' => 'The database name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CockroachDB integration is not configured.');
            }

            $result = $this->service->getDatabase($args['cluster_id'], $args['database_name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
