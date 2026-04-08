<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for listing PayPal payments.
 *
 * Retrieves a list of payments from the PayPal Payments API
 * with optional filtering by count, start ID, or date range.
 */
class PayPalListPayments implements Tool
{
    /**
     * Create a new PayPalListPayments tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'paypal_list_payments';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'List PayPal payments. Returns payment IDs, states, amounts, and transaction details. Use filters to narrow results by count or date range.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Number of payments to return (default: 10, max: 20).'],
            'start_id' => ['type' => 'string', 'description' => 'The ID of the first payment to return. Used for pagination.'],
            'start_time' => ['type' => 'string', 'description' => 'Start time for filtering (ISO 8601, e.g., "2025-01-01T00:00:00Z").'],
            'end_time' => ['type' => 'string', 'description' => 'End time for filtering (ISO 8601, e.g., "2025-12-31T23:59:59Z").'],
            'sort_by' => ['type' => 'string', 'description' => 'Sort field: "create_time" or "update_time".'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort direction: "asc" or "desc".'],
        ];
    }

    /**
     * Execute the list payments request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            $params = [];
            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['start_id'])) {
                $params['start_id'] = $args['start_id'];
            }
            if (isset($args['start_time'])) {
                $params['start_time'] = $args['start_time'];
            }
            if (isset($args['end_time'])) {
                $params['end_time'] = $args['end_time'];
            }
            if (isset($args['sort_by'])) {
                $params['sort_by'] = $args['sort_by'];
            }
            if (isset($args['sort_order'])) {
                $params['sort_order'] = $args['sort_order'];
            }

            $result = $this->service->listPayments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
