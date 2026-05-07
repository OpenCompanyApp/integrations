<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Unbounce sub-accounts globally or under an account.
 */
class UnbounceListSubAccounts implements Tool
{
    /**
     * @param  UnbounceService  $service  Unbounce API client.
     */
    public function __construct(
        private UnbounceService $service,
    ) {}

    public function name(): string
    {
        return 'unbounce_list_sub_accounts';
    }

    public function description(): string
    {
        return 'List sub-accounts in Unbounce. Sub-accounts group pages and are useful for organizing landing pages by client, brand, or campaign.';
    }

    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'description' => 'Optional account ID for the official /accounts/{account_id}/sub_accounts endpoint.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of sub-accounts to return (default: 50, max: 1000).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    /**
     * List sub-accounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 50;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listSubAccounts($limit, $offset, $args['account_id'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
