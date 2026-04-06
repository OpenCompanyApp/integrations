<?php

namespace OpenCompany\Integrations\Qualifying\Tools;

use OpenCompany\Integrations\Qualifying\QualifyingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QualifyingListAccounts implements Tool
{
    public function __construct(
        private QualifyingService $service,
    ) {}

    public function name(): string
    {
        return 'qualifying_list_accounts';
    }

    public function description(): string
    {
        return 'List sales accounts from Qualifying. Returns a paginated list of accounts with their details. Use limit and page parameters to navigate through results.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of accounts to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qualifying integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listAccounts($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
