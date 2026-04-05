<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe invoices with optional filtering.
 *
 * Supports filtering by customer, status, and pagination.
 */
class StripeListInvoices implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_list_invoices';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe invoices with optional filtering.
        Supports filtering by customer, status, and pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'customer' => ['type' => 'string', 'description' => 'Filter by customer ID.'],
            'status' => ['type' => 'string', 'description' => 'Filter by status: "draft", "open", "paid", "uncollectible", or "void".'],
            'limit' => ['type' => 'integer', 'description' => 'Number of invoices to return (1–100, default 10).'],
            'starting_after' => ['type' => 'string', 'description' => 'Cursor for pagination — invoice ID to start after.'],
        ];
    }

    /**
     * List Stripe invoices with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer, status, limit, starting_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $params = [];

            if (isset($args['customer'])) {
                $params['customer'] = $args['customer'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }

            $result = $this->service->listInvoices($params);

            $invoices = array_map(function (array $inv) {
                return [
                    'id' => $inv['id'] ?? '',
                    'number' => $inv['number'] ?? null,
                    'customer' => $inv['customer'] ?? '',
                    'status' => $inv['status'] ?? '',
                    'total' => $inv['total'] ?? 0,
                    'currency' => $inv['currency'] ?? '',
                    'paid' => $inv['paid'] ?? false,
                    'created' => $inv['created'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'invoices' => $invoices,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
