<?php

namespace OpenCompany\Integrations\Pipedream\Tools;

use OpenCompany\Integrations\Pipedream\PipedreamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PipedreamListConnectedAccounts implements Tool
{
    public function __construct(
        private PipedreamService $service,
    ) {}

    public function name(): string
    {
        return 'pipedream_list_connected_accounts';
    }

    public function description(): string
    {
        return 'List connected third-party accounts in Pipedream. These are the OAuth-connected accounts used by workflows to interact with external services.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of accounts to return per page (default: 25, max: 100).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pipedream integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;

            $result = $this->service->listConnectedAccounts($page, $limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
