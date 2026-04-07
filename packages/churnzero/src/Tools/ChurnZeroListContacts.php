<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Contacts.
 *
 * Lists contacts in ChurnZero with optional filtering by account ID,
 * search term, and pagination support.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroListContacts implements Tool
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
        return 'churnzero_list_contacts';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List contacts in ChurnZero. Optionally filter by account ID to get contacts for a specific account, or use search to find contacts by name or email. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'description' => 'Filter contacts by account ID.'],
            'search'     => ['type' => 'string', 'description' => 'Search term to filter contacts by name or email.'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'perPage'    => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the list contacts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id, search, page, perPage).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $accountId = $args['account_id'] ?? null;
            $search    = $args['search'] ?? null;
            $page      = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage   = isset($args['perPage']) ? (int) $args['perPage'] : 25;

            $result = $this->service->listContacts($accountId, $search, $page, $perPage);

            $contacts = $result['data'] ?? $result['contacts'] ?? [];
            $total    = $result['total'] ?? count($contacts);

            return ToolResult::success([
                'contacts' => $contacts,
                'count'    => count($contacts),
                'total'    => $total,
                'page'     => $page,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
