<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\Integrations\ChurnZero\ChurnZeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List Alerts.
 *
 * Lists alerts in ChurnZero with optional filtering by account ID,
 * alert status, and pagination support. Alerts represent important
 * notifications and risk signals for customer accounts.
 *
 * @see https://support.churnzero.net/hc/en-us/articles/360009701791-ChurnZero-API
 */
class ChurnZeroListAlerts implements Tool
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
        return 'churnzero_list_alerts';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'List alerts in ChurnZero — risk signals, usage drops, renewal reminders, and other notifications. Filter by account ID or alert status. Supports pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'account_id' => ['type' => 'string', 'description' => 'Filter alerts by account ID.'],
            'status'     => ['type' => 'string', 'description' => 'Filter by alert status. Common values: "open", "dismissed", "snoozed".'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'perPage'    => ['type' => 'integer', 'description' => 'Number of results per page (default: 25, max: 100).'],
        ];
    }

    /**
     * Execute the list alerts tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (account_id, status, page, perPage).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $accountId = $args['account_id'] ?? null;
            $status    = $args['status'] ?? null;
            $page      = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage   = isset($args['perPage']) ? (int) $args['perPage'] : 25;

            $result = $this->service->listAlerts($accountId, $status, $page, $perPage);

            $alerts = $result['data'] ?? $result['alerts'] ?? [];
            $total  = $result['total'] ?? count($alerts);

            return ToolResult::success([
                'alerts' => $alerts,
                'count'  => count($alerts),
                'total'  => $total,
                'page'   => $page,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
