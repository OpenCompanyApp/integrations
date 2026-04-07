<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Accounts.
 *
 * Searches and lists accounts in ChurnZero. Supports filtering by search
 * term and pagination.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroListAccounts implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero API service instance.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'churnzero_list_accounts';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Search and list accounts in ChurnZero. Use the search parameter to filter accounts by name or other attributes. Returns a paginated list of accounts with their details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'search'  => ['type' => 'string', 'description' => 'Search term to filter accounts by name or other attributes.'],
            'page'    => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'perPage' => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the list accounts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (search, page, perPage).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $search  = $args['search'] ?? null;
            $page    = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['perPage']) ? (int) $args['perPage'] : 25;

            $result = $this->service->listAccounts($search, $page, $perPage);

            $accounts = $result['data'] ?? $result['accounts'] ?? [];
            $total    = $result['total'] ?? count($accounts);

            return ToolResult::success([
                'accounts' => $accounts,
                'count'    => count($accounts),
                'total'    => $total,
                'page'     => $page,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
