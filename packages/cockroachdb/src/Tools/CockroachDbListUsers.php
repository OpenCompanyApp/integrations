<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

use OpenCompany\Integrations\CockroachDb\CockroachDbService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CockroachDbListUsers implements Tool
{
    public function __construct(
        private CockroachDbService $service,
    ) {}

    public function name(): string
    {
        return 'cockroachdb_list_users';
    }

    public function description(): string
    {
        return 'List all SQL users in a CockroachDB cluster. Returns usernames and privileges.';
    }

    public function parameters(): array
    {
        return [
            'cluster_id' => ['type' => 'string', 'required' => true, 'description' => 'The cluster ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CockroachDB integration is not configured.');
            }

            $result = $this->service->listUsers($args['cluster_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
