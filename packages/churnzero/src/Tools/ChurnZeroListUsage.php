<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Usage.
 *
 * Lists usage data in ChurnZero with optional filtering by account ID,
 * feature/module name, and pagination support. Usage data tracks how
 * customers interact with your product.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroListUsage implements Tool
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
        return 'churnzero_list_usage';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List usage data in ChurnZero — track how customers engage with your product features. Filter by account ID or specific feature/module name. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'description' => 'Filter usage data by account ID.'],
            'feature'    => ['type' => 'string', 'description' => 'Filter by feature or module name.'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'perPage'    => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the list usage tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id, feature, page, perPage).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $accountId = $args['account_id'] ?? null;
            $feature   = $args['feature'] ?? null;
            $page      = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage   = isset($args['perPage']) ? (int) $args['perPage'] : 25;

            $result = $this->service->listUsage($accountId, $feature, $page, $perPage);

            $usage  = $result['data'] ?? $result['usage'] ?? [];
            $total  = $result['total'] ?? count($usage);

            return ToolResult::success([
                'usage'  => $usage,
                'count'  => count($usage),
                'total'  => $total,
                'page'   => $page,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
