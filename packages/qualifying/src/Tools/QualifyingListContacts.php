<?php

namespace OpenCompany\Integrations\Qualifying\Tools;

use OpenCompany\Integrations\Qualifying\QualifyingService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QualifyingListContacts implements Tool
{
    public function __construct(
        private QualifyingService $service,
    ) {}

    public function name(): string
    {
        return 'qualifying_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts from Qualifying. Returns a paginated list of contacts. Optionally filter by account to see contacts belonging to a specific account.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return per page (default: 25, max: 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'account_id' => ['type' => 'string', 'description' => 'Filter contacts by account ID to return only contacts associated with a specific account.'],
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
            $accountId = $args['account_id'] ?? null;

            $result = $this->service->listContacts($limit, $page, $accountId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
