<?php

namespace OpenCompany\Integrations\Stripe\Tools;

use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Stripe customers with optional filtering.
 *
 * Supports filtering by email and pagination with limit and starting_after cursor.
 */
class StripeListCustomers implements Tool
{
    /**
     * @param  StripeService  $service  The Stripe API client
     */
    public function __construct(
        private StripeService $service,
    ) {}

    public function name(): string
    {
        return 'stripe_list_customers';
    }

    public function description(): string
    {
        return <<<'MD'
        List Stripe customers with optional filtering.
        Supports filtering by email, pagination with limit and starting_after cursor.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'description' => 'Filter by customer email address.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of customers to return (1–100, default 10).'],
            'starting_after' => ['type' => 'string', 'description' => 'Cursor for pagination — customer ID to start after.'],
        ];
    }

    /**
     * List Stripe customers with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (email, limit, starting_after)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Stripe integration is not configured.');
            }

            $params = [];

            if (isset($args['email'])) {
                $params['email'] = $args['email'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['starting_after'])) {
                $params['starting_after'] = $args['starting_after'];
            }

            $result = $this->service->listCustomers($params);

            $customers = array_map(function (array $c) {
                return [
                    'id' => $c['id'] ?? '',
                    'name' => $c['name'] ?? '',
                    'email' => $c['email'] ?? '',
                    'phone' => $c['phone'] ?? null,
                    'created' => $c['created'] ?? null,
                ];
            }, $result['data'] ?? []);

            return ToolResult::success([
                'customers' => $customers,
                'has_more' => $result['has_more'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
